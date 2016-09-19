<?php

//用户

namespace DuoBao\Controller;

class MemberController extends MemberbaseController {

	protected $addressDB;
	protected function _initialize() {
        parent::_initialize();
		$this->addressDB = M('duobao_address');
    }
    //首页
    public function getInfo() {
        $this->check_member();
    	$ret = $this->userinfo;

    	$ret = array(
    		'userid'=> $this->userinfo['userid'],
    		'encrypt'=> $this->userinfo['encrypt'],
    		'username'=> $this->userinfo['username'],
    		'point'=> $this->userinfo['point'],
    		'credit'=> $this->userinfo['credit'],
    		'nickname'=> $this->userinfo['nickname'],
    		'userpic'=> $this->userinfo['userpic'],
    		'pro_code'=> $this->userinfo['pro_code'],
    		'email'=> $this->userinfo['email'],
    		'modelid'=> $this->userinfo['modelid'],
    		'master_uid'=> $this->userinfo['master_uid']
    	);

		$cond['uid'] = $this->userid;
		$addr =$this->addressDB->where($cond)->find();
		if($addr){
			$ret['addressarea'] = $addr['area']; 
			$ret['addressdetail'] = $addr['detail']; 
			$ret['addressname'] = $addr['name']; 
			$ret['addresstel'] = $addr['tel']; 
			$ret['alipay'] = $addr['alipay']; 
		}
		
		die(json_encode($ret));
    }
	
	//修改用户资料
	public function editUser() {
	    $this->check_member();
		$ret['status'] = -1;
		
		$userpic = I('post.userpic');
		$nickname = I('post.nickname');
		if($userpic){
			$data['userpic'] = $userpic;
		} 
		if($nickname){
			$data['nickname'] = $nickname;
		}
		if($data){
			$w['userid'] = $this->userid;
			$this->memberDb->where($w)->data($data)->save();
			$ret['status'] = 1;
		}
		die(json_encode($ret));
	}
	
	//修改收货地址
	public function editAddress() {
	    $this->check_member();
		$ret['status'] = -1;
		$name = I('post.name');
		$tel = I('post.tel');
		$area = I('post.area');
		$detail = I('post.detail');
		$alipay = I('post.alipay');
		$w['uid'] = $this->userid;
		$address = $this->addressDB->where($w)->find();
	
		$data = array(
			'uid'=>$this->userid,
			'detail'=>$detail,
			'name'=>$name,
			'area'=>$area,
			'tel'=>$tel,
		    'alipay'=>$alipay
		);
		if(empty($address)){
			$this->addressDB->data($data)->add();
		}else{
			$this->addressDB->where($w)->save($data);
		}
		$ret['status'] = 1;
		die(json_encode($ret));
	}
	
	/**
     * 获取我的订单
     * @param type $p 分页
     * @return JSON
     */
    public function getOrdersList() {
    	//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$w['g.versionfettle'] = 1;
		}
		
		$p = I('get.p',1,'intval');
		$w['o.uid'] = I('get.uid', 0, 'intval');//$this->userid;不用传递encrypt
//		$w['c.id'] = array('exp','IS NOT NULL');
		$orders = M('duobao_orders');
		$data = $orders
				->alias('o')
				->join('left join __DUOBAO_GOODS__ g on g.id = o.gid')
				->join('left join __DUOBAO_ACTIVITYS__ a on a.id = o.aid')
				->join('left join __DUOBAO_CODES__ c on c.id = a.wid')
				->join('left join __MEMBER__ wm on wm.userid = a.WUid')
				->where($w)
				->field('o.id as oid,o.Deal,o.aid,o.gid,o.atime,g.name,g.Thumb,a.Money,a.nowmoney,wm.nickname,a.Section,a.etime,a.status,(select sum(ow.Deal) from '.$orders->getTableName().'  as ow where ow.aid = o.aid and ow.uid=wm.userid ) as WDeal,c.CodeNumber')
				->order('o.atime desc')
				->limit(10)
				->page($p)
		    	->select();
		foreach ($data as $key => $value) {
			$data[$key]['nowtime'] = time();
		}
		die(json_encode($data));
    }
	/**
     * 获取我的徒弟列表
     * @param 用户验证数据
     * @return JSON
     */
	public function getMasterList(){
		$this->check_member();
		$w['master_uid'] = $this->userid;
		$p = I('get.page');
		if($p == ''){
			$p = 1;
		}
		$data = $this->memberDb->alias('m')
				->where($w)
				->field('m.nickname,m.regdate,(select sum(deal) from s_duobao_pay_orders where uid=m.userid and status=1) d')
				->order('m.regdate desc,d desc')
				->limit(10)
				->where('islock = 0')
				->page($p)
				->select();
		die(json_encode($data));
	}
	/**
     * 获取我的中奖记录
     * @param type $p 分页
     * @return JSON
     */
    public function getWinningList() {
    	//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$w['g.versionfettle'] = 1;
		}
		$p = I('get.p',1,'intval');
		$w['w.uid'] = I('get.uid',0, 'intval');//$this->userid;不用传递encrypt
		$w['a.etime'] = array('LT',time());
		$winning = M('duobao_winning');
		$data = $winning
				->alias('w')
				->join('left join __DUOBAO_GOODS__ g on g.id = w.gid')
				->join('left join __DUOBAO_ACTIVITYS__ a on a.id = w.aid')
				->join('left join __DUOBAO_CODES__ c on c.id = w.cid')
				->join('left join __DUOBAO_ORDERS__ o on o.id = c.oid')
				->where($w)
				->field('w.id as wid,c.oid,w.gid,w.aid,g.name,w.isshows,g.Thumb,a.Money,a.Section,a.etime,w.status,(select sum(ow.Deal) from '.M('duobao_orders')->getTableName().'  as ow where ow.aid = o.aid and ow.uid=w.uid ) as Deal,c.CodeNumber')
				->order('w.atime desc')
				->limit(10)
				->page($p)
		    	->select();
		foreach ($data as $key => $value) {
			if($data[$key]['gid'] == 80){
				$data[$key]['status'] = 2;
				$data[$key]['isshows'] = 1;
			}	
		}
		die(json_encode($data));
    }
	
	

	/**
     * 提交晒单信息
	 * @param type $wid 中奖ID
     * @param type $des 描述
	 * @param type $photos 照片JSON格式数据
     * @return JSON
     */
    public function subShows() {
        $this->check_member();
    	$ret['status'] = -1;
		$wid = I('post.wid',0,'intval');
		$des = I('post.des');
		$photos = I('post.photos');
		
		$ww['id'] = $wid;
		$winning = M('duobao_winning')->where($ww)->find();
		
		$showDB = M('duobao_shows');
		
		//检测是否中奖人
		if($winning['uid'] == $this->userid){
			
			//检测是否已经晒过单
			$sagainWhere['uid'] = $this->userid;
			$sagainWhere['aid'] = $winning['aid'];
			if($showDB->where($sagainWhere)->count(1)){
				$ret['status'] = 0;
			}else{
				$data = array(
					'gid'=>$winning['gid'],
					'aid'=>$winning['aid'],
					'uid'=>$this->userid,
					'wid'=>$wid,
					'des'=>$des,
					'photos'=>$photos,
					'status'=>0,
					'atime'=> time()
				);
				$ins_id = $showDB->add($data);
//				if($winning['gid'] != 80 || $winning['gid'] != 27 || $winning['gid'] != 28 || $winning['gid'] != 29){
					//晒单获得1抢币
					// $this->memberDb->where('userid='.$this->userid)->setInc('point',1);	
					// $pointlog_data = array(
					// 	'uid'=>$this->userid,
					// 	'point'=>1,
					// 	'atime'=>time(),
					// 	'type'=>2
					// 	);
					// M('point_log')->data($pointlog_data)->add();			
//				}
				
				
				$wwup['id'] = $wid;
				M('duobao_winning')->where($wwup)->setField('isshows',1);
				if($ins_id){
					$ret['status'] = 1;
					$ret['sid'] = $ins_id;
				}
			}
			
		}
		
		die(json_encode($ret));
    }

    /**
     * 提交邀请码
     */
    public function pro_code()
    {
        $this->check_member();
        $pro_code = I('get.pro_code', '', 'trim');
        $ret['status'] = 0;
        if (! empty($pro_code)) {
            $w['pro_code'] = array(
                'eq',
                $pro_code
            );
            $master_uid = $this->memberDb->where($w)->getField('userid');
            if (empty($master_uid)) {
                $ret['msg'] = '不存在这个邀请码';
                die(json_encode($ret));
            }
            
            if($master_uid == $this->userid){
                $ret['msg'] = '不能填写自己的推广码';
                die(json_encode($ret));
            }
            if($this->userinfo['master_uid'] == 0){
	            $this->userinfo['master_uid'] = $master_uid;
				$sdb['master_uid'] = $master_uid;
				$swh['userid'] = $this->userid;
	            if ($this->memberDb->where($swh)->save($sdb) != false) {
	            	$plw['uid'] = $this->userid;
					$plw['type'] = 3;
	            	$sc = M('point_log')->where($plw)->count(1);
	            	if($sc<=0){
	            		$this->memberDb->where('userid=' . $this->userid)->setInc('point', 2);
		                $pointlog_data = array(
							'uid'=>$this->userid,
							'point'=>2,
							'atime'=>time(),
							'type'=>3
							);
						M('point_log')->data($pointlog_data)->add();
		                $ret['status'] = 1;
	            	}
	            } else {
	                $ret['msg'] = '提交失败';
	            }
			}else{
				$ret['msg'] = '您已经领取过抢币了，快下载APP夺宝开始吧！';
			}
        } else {
            $ret['msg'] = '邀请码不能为空';
        }
        die(json_encode($ret));
    }

    /**
     * 兑换元宝
     */
    public function ex_point()
    {
        $this->check_member();
        if ($this->userinfo['credit'] >= 1000) {
            $point = floor($this->userinfo['credit'] / 1000);
            $pass_point = I('get.point', 0, 'intval');

            $expoint = $pass_point > 0 ? min($point, $pass_point) : max($point, $pass_point);
            $credit = $expoint * 1000;

            $this->userinfo['credit'] -= $credit;
            $this->userinfo['point'] += $expoint;

            if ($this->memberDb->save($this->userinfo) !== false) {

            	$pointlog_data = array(
					'uid'=>$this->userid,
					'point'=>$expoint,
					'atime'=>time(),
					'type'=>4
					);
				M('point_log')->data($pointlog_data)->add();

				$creditlog_data = array(
					'master_uid'=>$this->userid,
					'get_credit'=>$credit,
					'lv'=>0,
					'atime'=>time(),
					'type'=>2
				);
				M('credit_log')->data($creditlog_data)->add();

                $ret['status'] = 1;
            } else {
                $ret['status'] = 0;
                $ret['msg'] = '兑换失败';
            }
        } else {
            $ret['status'] = 0;
            $ret['msg'] = '元宝不足，不能兑换';
        }
        die(json_encode($ret));
    }
    
    /**
     * 获取徒弟个数
     */
    function disciple_num() {
        $this->check_member();
        $w['master_uid'] = $this->userid;
//      $disciples = $this->memberDb->where($w)->field('pro_code')->select();
//      
//      $disciples_n = 0;
//      if(!empty($disciples)){
//          $disciples_n += count($disciples);
//          foreach ($disciples as $k => $v){
//              $cond['pro_code'] = $v['pro_code'];
//              $master_uid = $this->memberDb->where($cond)->getField('userid');
//              if(!empty($master_uid)){
//                  $master_uids[] = $master_uid;
//              }
//          }
//          if(!empty($master_uids)){
//              $where['master_uid'] = array('in', $master_uids);
//              $disciples_n += $this->memberDb->where($where)->count(1);
//          }
//      }
//      $arr = array('dnum'=>$disciples_n);
		$num['dnum'] = $this->memberDb->where($w)->count(1);
        die(json_encode($num));
    }
}
