<?php
namespace Api\Controller;

use Common\Controller\Base;

class ActivityController extends Base {

	protected $userid = null;
	protected $userinfo = null;
	protected $ALDB = null;
	protected function _initialize() {
		parent::_initialize();
		header("Access-Control-Allow-Origin:*");
		$this->checkuser();
		$this->ALDB = M('duobao_activity_lottery');
	}

	private function checkuser(){
		if(!I('get.uid')){
			die('need uid');
		}
		if(!I('get.encrypt')){
			die('need encrypt');
		}
		$uid =  I('get.uid');
		$w['userid'] = $uid;
		$w['encrypt'] = I('get.encrypt');
		$this->userinfo = M('member')->where($w)->field('uid')->count(1);
		if($this->userinfo){
			$this->userid = $uid;
		}else{
			die(json_encode(array('code'=>-99)));
		}
	}
	private function gettimew(){
		$t = time();
		$start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
		$end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
		return array(array('gt',$start),array('lt',$end));
	}
	//获得抽奖次数
	private function getnum(){

		
		$timew = $this->gettimew();
		$w['uid'] = $this->userid;
		$w['atime'] = $timew;
		$w['type'] = 1;
		//获取今日签到次数
		//
		$cinum = $this->ALDB->where($w)->find();

		//获取今日分享次数
		//
		$w['status'] = 0;
		$w['type'] = 2;
		$snum = $this->ALDB->where($w)->count(1);

		//获取充值100的次数
		unset($w['atime']);
		$w['status'] = 0;
		$w['type'] = 3;
		$pnum = $this->ALDB->where($w)->count(1);

		$lnum = 0;
		if($cinum){
			if($cinum['status'] == 0){
				$lnum ++;
			}
		}else{
			$cidata = array(
				'uid'=>$this->userid,
				'paynum'=>0,
				'giftnum'=>0,
				'atime'=>time(),
				'status' => 0,
				'type'=>1
				);
			$this->ALDB->data($cidata)->add();
			$lnum ++;
		}

		if($snum == 1){
			$lnum ++;
		}
		$lnum += $pnum;
		
		return $lnum;
	}
	public function loadinfo(){
		$uid = $this->userid;
		$data['remain'] = $this->getnum();

		$lucklist = $this->ALDB->alias('al')
							->join('left join __MEMBER__ m on m.userid=al.uid')
							->field('m.nickname,al.giftnum')
							->where('status=1')
				            ->order('al.atime desc')
				            ->limit(20)
				            ->select();
		foreach ($lucklist as $key => $value) {
				$rewards[] = array(
					'nickname'=>$value['nickname'],
					'value'=>'抽到了 '.$value['giftnum'] .'抢币'
				);
		}
		$data['rewards'] = $rewards;

		$data['code'] = 0;
		die(json_encode($data));
	}
	//抽奖
	//  -99 缺少用户信息
	//   0 正常
	//   -1 次数用完
	public function lottery(){


		$data['code'] = -1;

		$lnum = $this->getnum();
		if($lnum == 0){
			$data['code'] = -1;
			die(json_encode($data));
		}

		//减少次数
		$timew = $this->gettimew();

		$w['uid'] = $this->userid;
		$w['status'] = 0;
		$w['atime'] = $timew;
		$w['type'] = 1;
		//获取今日签到次数
		//
		$isok = FALSE;
		$setid = 0;
		//优先判断是否未签到
		$setid = $this->ALDB->where($w)->getField('id');
		if($setid){
			//设置签到为已使用
			$isok = true;
			$dotype = 1;
		}else{
			//是否有分享
			$w['status'] = 0;
			$w['type'] = 2;
			$setid = $this->ALDB->where($w)->getField('id');
			if($setid){
				//设置今天分享的次数为已使用
				$isok = true;
				$dotype = 2;
			}else{
				//是否有未使用的充值记录
				//获取充值100的次数
				unset($w['atime']);
				$w['type'] = 3;
				$setid = $this->ALDB->where($w)->getField('id');
				if($setid){
					//设置最早充值的那次机会为已使用
					$isok = true;
					$dotype = 3;
				}
			}
		}
		if($isok){
			//已消耗掉
			//
			if($dotype != 0){
				$indexnum = 0;
				$giftnum = 1;
				//随机抽奖
				$rnum = rand(0,100);
				if($rnum>95){
					$indexnum = 2;
					$giftnum = 3;
				}
				// if($rnum>98){
				// 	$indexnum = 4;
				// 	$giftnum = 5;
				// }
				$data['index'] = $indexnum;
				$data['giftnum'] = $giftnum;
				$data['info'] = '恭喜你抽到了 '.$giftnum.' 抢币！';

				$uw['id'] = $setid;

				$udata = array('status'=>1,'gtime'=>time(),'giftnum'=>$giftnum);
				$this->ALDB->where($uw)->data($udata)->save();
				$w_memUP['userid'] = $this->userid;
				M('member')->where($w_memUP)->setInc('point',$giftnum);
				$pointlog_data = array(
					'uid'=>$this->userid,
					'point'=>$giftnum,
					'atime'=>time(),
					'type'=>5,
					'des'=> 'lottery_'.$dotype
					);
				M('point_log')->data($pointlog_data)->add();

				$data['code'] = 0;
			}
			
		}
		$data['remain'] = $this->getnum();
		die(json_encode($data));
	}

	public function share(){
		$timew = $this->gettimew();
		$w['uid'] = $this->userid;
		$w['atime'] = $timew;
		$w['type'] = 2;

		$snum = $this->ALDB->where($w)->count(1);

		if($snum==0){
			$sdata = array(
				'uid'=>$this->userid,
				'paynum'=>0,
				'giftnum'=>0,
				'atime'=>time(),
				'status' => 0,
				'type'=>2
				);
			$this->ALDB->data($sdata)->add();
		}
		$data['remain'] = $this->getnum();
		die(json_encode($data));
	}
}
