<?php
namespace DuoBao\Controller;

use Common\Controller\Base;
import('Vendor.wxpay.JsApiPay');
class WechatController extends Base {
	
	protected $ordersDB;
	protected $activitysDB;
	protected $codesDB;
	protected $winningDB;
	protected $goodsDB;
	protected $openid;
	function _initialize() {
		parent::_initialize ();
		header("Access-Control-Allow-Origin:*");
		// session('wx_openid',null);
		// session('openid','obTr8t2nyxiE77QqJ_rPweL5WYfU');
		// if(I('get.debug') == 1){
		// 	session('openid','obTr8t2nyxiE77QqJ_rPweL5WYfU');
			// session('member',M('member')->where("username='obTr8t2nyxiE77QqJ_rPweL5WYfU'")->find());
		// }
		$tools = new \JsApiPay();
		$this->openid = session('openid');
		$userinfo = session('member');

		if(empty($this->openid)){
			$userinfo = $tools->GetUserInfo();	
		}
		$this->GetMember($userinfo);
		$js_sign = $tools->GetJsapi_ticket();
		$this->assign('js_sign',$js_sign);
		$this->ordersDB = M('duobao_orders');
		$this->activitysDB = M('duobao_activitys');
		$this->codesDB = M('duobao_codes');
		$this->goodsDB = M('duobao_goods');
		$this->goodsPicDB = M('duobao_goods_pic');
		$this->winningDB = M('duobao_winning'); 
		
	}

	//520活动页面
	public function love(){
		$this->display();
	}
	//520活动返回抽奖数据
	public function luck(){
		$ret['status'] = 0;
		$w['openid'] = $this->openid;
		$loveluck = M('love_luck')->where($w)->find();
		if($loveluck){
			$ret['lv'] = $loveluck['lv'];
			$ret['status'] = 100;
		}else{
			$lc = M('love_luck')->where('lv=4')->count(1);
			
				$lv = 1;//1抢币
				$r = rand(1,100);
				// if($lc<= 200){	//名额有限，先到先得
					if($r > 40){
						$lv = 4;//套套
					}
				// }
				 
				if($r > 90){
					$lv = 2;//3抢币
				}
				if($r > 95){
					$lv = 3;//5抢币
				}
				
				$data = array('openid' => $this->openid,'lv'=> $lv ,'atime' => time(),'status'=>0);


				//增加用户抢币
				$point = 0;
				switch ($lv) {
					case 1:
						$point = 1;
						break;
					case 2:
						$point = 3;
						break;
					case 3:
						$point = 5;
						break;
				}
				if($point != 0){
					$data['isend'] = 1;
					$w_memUP['username'] = $this->openid;
					$member = M('member')->where($w_memUP)->find();
					if($member){
						M('member')->where('userid='.$member['userid'])->setInc('point',$point);
						$pointlog_data = array(
							'uid'=>$member['uid'],
							'point'=>$point,
							'atime'=>time(),
							'type'=>5
							);
						M('point_log')->data($pointlog_data)->add();
					}
				}
				M('love_luck')->data($data)->add();
				$ret['status'] = 1;
				$ret['lv'] = $lv;
			
		}
		die(json_encode($ret));
	}
	//520活动保存用户数据
	public function saveinfo(){
		$ret['status'] = 0;
		$tel = I('post.tel');
		$name = I('post.name');
		$address = I('post.address');
		$data = array('tel' =>$tel , 'name' =>$name , 'address' =>$address , 'status' =>1);
		$w['openid'] = $this->openid;
		$ok = M('love_luck')->where($w)->data($data)->save();
		if($ok){
			$ret['status'] = 1;
		}
		die(json_encode($ret));
	}

	public function GetMember($userinfo){
		if(!empty($userinfo)){
			$mw['username'] = $userinfo['openid'];
			$mw['modelid'] = 3;
			$member = M('member')->where($mw)->getField('userid');
			$ip = get_client_ip(0, true);
			if(empty($member)){
				$memberdata = array(
	                'username' => $userinfo['openid'],
	                'password' => md5('fuck'),
	                'encrypt'  => getRandStr(6),
	                'about'    => 'shop user',
	                'theme'    => '',
	                'islock'   => 0,
	                'modelid'  => 3,
	                'point'  => 0,
	                'nickname' => $userinfo['nickname'],
	                'userpic'  => $userinfo['headimgurl'],
	                'regdate'  => time(),
	                'lastdate' => time(),
	                'regip'    => $ip,
	                'lastip'   => $ip,
	                'email'    => 'wx_'.$userinfo['openid']. '@nntzd.com',
	                'pro_code' => getRandStr(6,9),
	                'checked'  => 1,
	                'loginnum' => 1
	            );
	            $ins_userid = M('member')->data($memberdata)->add();
			}else{
				$udata = array('lastip' => $ip, 'lastdate'=> time() );
				M('member')->where($mw)->data($udata)->save();
				M('member')->where($mw)->setInc('loginnum',1);
			}
		}else{
			die('userinfo is null');
		}
	}
	/**
	 * 展示商品
	 * @param  [type] $id [商品GID]
	 * @return [type]     [description]
	 */
	public function detail(){

		$id = I('get.id');
		$gw['putstatus'] = 1;
		// $gw['sid'] = array('neq',0);;//平台商品
		$gw['id'] = $id;
		$goods = $this->goodsDB->where($gw)->field('id,name,paynum,thumb,sid')->find();
		if($goods['sid'] == 0){
			$this->display('pulloff');
			die();
		}
		$data['goods'] = $goods;
		$data['goods_pics'] = $this->goodsPicDB->where('gid='.$id)->field('path')->select();

		//验证场次是否已经完结
		//获取最新一期信息
		$actw['gid'] = $id;
		$actw['status'] = 1;
		$new_activity = $this->activitysDB->where($actw)->field('id,section,money,nowmoney')->order('id desc')->find();
		if($new_activity){
        	$data['new_activity'] = $new_activity;
        	$data['new_activity']['press'] = floor($new_activity['nowmoney'] / $new_activity['money'] * 100);
        	$data['new_activity']['surplus'] = $new_activity['money'] - $new_activity['nowmoney'];
        }

		//获取上期中奖信息
		$actw['status'] = 0;
		$last_activity = $this->activitysDB->alias('a')
            ->join('left join __MEMBER__ m on m.userid=a.wuid')->where($actw)->field('a.id,a.section,a.etime,m.nickname,m.userpic')->order('a.id desc')->find();
        if($last_activity){
        	$data['last_activity'] = $last_activity;
        }


        $this->assign('data',$data);
        // var_dump($data);
		$this->display();
	}

	public function content()
	{
		$id = I('get.id');
		$data = M('duobao_goods')->where('id='.$id)->getField('detail');
		$this->assign('data',$data);
		$this->display();
	}

	public function userCenter(){
		$this->display();
	}

	
}
