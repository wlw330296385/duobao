<?php

//用户


namespace DuoBao\Controller;

use Common\Controller\Base;
class IndexController extends Base {
	
	protected $activitys = null;
	//初始化
    protected function _initialize() {
    	parent::_initialize();
		header("Access-Control-Allow-Origin: *");
    	$this->activitys = M('duobao_activitys');
		
	}
	//获取首页数据
    public function index() {
    	//顶部广告
    	$banners = M('duobao_banner')->order('id desc')->where('status=1')->limit(3)->select();
		$data['banner'] = $banners;
		//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$where_recom['g.versionfettle'] = 1;
			$where_new['g.versionfettle'] = 1;
		}
		//最新揭晓
		$where_new['a.status'] = 0;
		$where_new['g.sid'] = 0;
		$where_new['g.id'] = array('neq',80);
    	$data['new'] = $this->activitys
				    	->alias('a')
				    	->join('left join __DUOBAO_GOODS__ g on g.id=a.Gid')
				    	->join('left join __MEMBER__ m on a.wuid=m.userid')
						->where($where_new)
						->field('a.Id as Aid,Gid,Name,Thumb,Status,section,etime,m.nickname')
						->order('Etime desc')
						->limit(3)
				    	->select();
		$data['nowtime'] = time(); 
		//人气推荐
		$where_recom['status'] = 1;
		$where_recom['g.putstatus'] = 1;
		$where_recom['g.sid'] = 0;
    	$data['recom'] = $this->activitys
				    	->alias('a')
				    	->group('Gid')
				    	->join('left join __DUOBAO_GOODS__ as g on g.id=a.Gid')
						->where($where_recom)
						->field('a.Id as Aid,Gid,Name,Thumb,Status,a.Money,a.NowMoney,a.Seq,section, a.NowMoney / a.Money * 100 as p')
						->order('g.hot desc')
//						->limit(10)
				    	->select();
		
		die(json_encode($data));
    }
    
    /**
     * 获取首页列表，分页
     */
    public function getRecom(){
        $p = I('get.p', 1, 'intval');
        $n = I('get.n', 10, 'intval');
        $cat = I('get.cat', 1, 'intval');
        switch ($cat){
            case 1:
                $order = 'g.hot desc';
                break;
            case 2:
                $order = 'a.atime desc';
                break;
            case 3:
                $order = 'p desc';
                break;
            case 4:
                $order = 'a.money desc';
                break;
			default:
				$order = 'g.hot desc';
				break;
        }
        $where_recom['status'] = 1;
        $where_recom['g.putstatus'] = 1;
        $where_recom['g.sid'] = 0;
		//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$where_recom['g.versionfettle'] = 1;
		}
        $data = $this->activitys
        ->alias('a')
        ->group('Gid')
        ->join('left join __DUOBAO_GOODS__ as g on g.id=a.Gid')
        ->where($where_recom)
        ->field('a.Id as Aid,Gid,Name,Thumb,Status,a.Money,a.NowMoney,a.Seq,section, a.NowMoney / a.Money * 100 as p, a.money - a.nowmoney as leftmoney,g.hot')
        ->order($order)
        ->limit($n)
        ->page($p)
        ->select();
        die(json_encode($data));
    }
	
	//获取最新揭晓数据
    public function newList() {
    	//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$w['g.versionfettle'] = 1;
		}
    	$p = I('get.p',1,'intval');
		$w['status'] = 0;
		$w['g.id'] = array('neq',80);
		$w['g.sid'] = 0;
		$data = $this->activitys
		    	->alias('a')
		    	->join('left join __DUOBAO_GOODS__ g on g.id=a.gid')
				->join('left join __MEMBER__ m on m.userid = a.wuid')
				->where($w)
				->field('a.Id as Aid,a.Gid,a.section,a.etime,g.Name,g.Thumb,Status,a.Money,a.NowMoney,a.Seq,m.nickname,(select sum(ow.Deal) from '.M('duobao_orders')->getTableName().'  as ow where ow.aid = a.id and ow.uid=a.wuid ) as Deal')
				->order('a.Etime desc')
				->limit(10)
				->page($p)
		    	->select();
		foreach ($data as $key => $value) {
			$data[$key]['nowtime'] = time();
		}
		
    	die(json_encode($data));
	}
	/**
     * 根据商品ID获取最新一期的资料
     * @param type $gid 商品ID
     * @return JSON
     */
    public function getNewActivityByGId() {
    	$gid = I('get.gid',0,'intval');
		if($gid){
			$w['gid'] = $gid;
			$w['status'] = 1;
			$data = $this->activitys->where($w)->getField('id');
		}
    	die(json_encode($data));
	}
	/**
     * 获取活动详情
     * @param type $aid 活动ID
     * @return JSON
     */
    public function getActivity() {
    	
    	$aid = I('get.aid',0,'intval');
		if($aid){
			$w['a.id'] = $aid;
			$data = $this->activitys
			    	->alias('a')
			    	->join('left join __DUOBAO_GOODS__ g on g.id=a.Gid')
					->join('left join __MEMBER__ m on m.userid = a.WUid')
					->join('left join __DUOBAO_WINNING__ w on w.Id = a.Wid')
					->join('left join __DUOBAO_CODES__ c on c.Id = w.Cid')
					->join('left join __DUOBAO_ORDERS__ o on o.Id = c.Oid')
					->where($w)
					->field('a.Id as Aid,a.Gid,a.Section,a.Etime,a.Status,a.Money,a.NowMoney,a.Seq,a.WUid,g.Name,g.Thumb,m.nickname,m.userpic,c.CodeNumber,o.IP,(select sum(ow.Deal) from '.M('duobao_orders')->getTableName().'  as ow where ow.aid = a.id and ow.uid=a.wuid ) as Deal')
			    	->find();
			if(intval($data['status']) == 0){
				$NW['gid'] = $data['gid'];
				$NW['status'] = 1;
				$newAct = $this->activitys->where($NW)->field('id,section')->order('atime desc')->find();
				if($newAct){
					$data['nid'] = $newAct['id'];
					$data['nsection'] = $newAct['section'];
				}
			}else{
				$OW['a.gid'] = $data['gid'];
				$OW['a.status'] = 0;
				
				$luck = $this->activitys
			    				->alias('a')
						    	->join('left join __DUOBAO_GOODS__ g on g.id=a.Gid')
								->join('left join __MEMBER__ m on m.userid = a.WUid')
								->join('left join __DUOBAO_WINNING__ w on w.Id = a.Wid')
								->join('left join __DUOBAO_CODES__ c on c.Id = w.Cid')
								->join('left join __DUOBAO_ORDERS__ o on o.Id = c.Oid')
								->where($OW)
								->order('a.section desc')
								->field('a.id,a.etime,m.userid, m.nickname,m.userpic,c.CodeNumber,o.IP,(select sum(ow.Deal) from '.M('duobao_orders')->getTableName().'  as ow where ow.aid = a.id and ow.uid=a.wuid ) as Deal')
						    	->find();
				$data['lastid'] = $luck['id'];
				$data['nickname'] = $luck['nickname'];
				$data['userpic'] = $luck['userpic'];
				$data['codenumber'] = $luck['codenumber'];
				$data['ip'] = $luck['ip'];
				$data['deal'] = $luck['deal'];
				$data['etime'] = $luck['etime'];
				$data['wuid'] = $luck['userid'];
			}

			$w_pic['gid'] = $data['gid'];
			$data['slider'] = M('duobao_goods_pic')->where($w_pic)->cache('cache_goods_'.$data['gid'],60)->getField('path',true);
			$data['nowtime'] = time();
			
			$uphotw['id'] = $data['gid'];
			M('duobao_goods')->where($uphotw)->setInc('hot',1);		
		}
    	die(json_encode($data));
	}
	/**
     * 获取晒单列表
     * @param type $aid 活动ID
	 * @param type $p 分页
     * @return JSON
     */
    public function getShowsList() {
    	//版本内容控制，针对iPhone的内容审查
		if(I('get.version') == C('version')){
			$w['g.versionfettle'] = 1;
		}


		$gid = I('get.gid',0,'intval');
		$p = I('get.p',1,'intval');
		$shows = M('duobao_shows');
		if($gid){
			$w['s.gid'] = $gid;
		}
		$w['s.status'] = 1;
		$w['g.sid'] = 0;
		$data = $shows
					->alias('s')
					->join('left join __MEMBER__ m on m.userid = s.Uid')
					->join('left join __DUOBAO_GOODS__ g on g.id = s.gid')
					->join('left join __DUOBAO_ACTIVITYS__ a on a.id = s.aid')
					->where($w)
					->field('s.Uid,s.Aid,s.des,s.atime,s.photos,m.nickname,m.userpic,g.name,a.section')
					->order('atime desc')
					->limit(10)
					// ->cache('cache_shows_p'.$p,60)
					->page($p)
			    	->select();
		die(json_encode($data));
    }
	
	/**
     * 获取往期活动中奖列表
     * @param type $gid 商品ID
	 * @param type $p 分页
     * @return JSON
     */
    public function getWinningList() {
		$gid = I('get.gid',0,'intval');
		$p = I('get.p',1,'intval');
		if($gid){
			$w['a.gid'] = $gid;
			$w['g.sid'] = 0;
			$w['a.status'] = array('neq',1);
			$w['a.etime'] = array('LT',time());
			$data = $this->activitys
					->alias('a')
					->join('left join __DUOBAO_GOODS__ g on g.id=a.Gid')
					->join('left join __MEMBER__ m on m.userid = a.WUid')
					->join('left join __DUOBAO_WINNING__ w on w.Id = a.Wid')
					->join('left join __DUOBAO_CODES__ c on c.Id = w.Cid')
					->join('left join __DUOBAO_ORDERS__ o on o.Id = c.Oid')
					->where($w)
					->field('a.id as aid,a.section,a.WUID,m.nickname,m.userpic,o.IP,c.CodeNumber,o.Deal,a.etime')
					->order('Etime desc')
					->limit(10)
					->page($p)
			    	->select();
			die(json_encode($data));
		}
    }

	/**
     * 获取活动订单列表
     * @param type $aid 活动ID
	 * @param type $p 分页
     * @return JSON
     */
    public function getOrdersList() {
		$aid = I('get.aid',0,'intval');
		$p = I('get.p',1,'intval');
		if($aid){
			$w['o.aid'] = $aid;
			$w['o.status'] = array('eq',1);
			$data = M('duobao_orders')
					->alias('o')
					->join('left join __MEMBER__ m on m.userid = o.Uid')
					->where($w)
					->field("m.nickname,m.userpic, m.userid as uid,o.id as oid,o.IP,o.Deal,o.atime,FROM_UNIXTIME(o.atime,'%Y-%m-%d %H:%i:%s') adate")
					->order('atime desc')
					->limit(10)
					->page($p)
			    	->select();
			die(json_encode($data));
		}
    }
	/**
     * 获取根据最后订单ID获得最新订单列表
     * @param type $aid 活动ID
     * @param type $lasttime 活动ID
     * @return JSON
     */
    public function getOrdersListByLastTime() {
		$aid = I('get.aid',0,'intval');
		$lasttime = I('get.lasttime',0,'intval');
		if($aid && $lasttime){
			$w['o.aid'] = $aid;
			$w['o.atime'] = array('gt',$lasttime);
			$w['o.status'] = array('eq',1);
			$list = M('duobao_orders')
					->alias('o')
					->join('left join __MEMBER__ m on m.userid = o.Uid')
					->where($w)
					->field("m.nickname,m.userpic, m.userid as uid,o.id as oid,o.IP,o.Deal,o.atime,FROM_UNIXTIME(o.atime,'%Y-%m-%d %H:%i:%s') adate")
					->order('atime desc')
			    	->select();
			$data['list'] = $list;
			
			if($list){
				$new_activity = M('duobao_activitys')->where('id='.$aid)->field('id,section,money,nowmoney,status')->order('id desc')->find();
	        	$data['now'] = $new_activity;
	        	$data['now']['press'] = floor($new_activity['nowmoney'] / $new_activity['money'] * 100);
	        	$data['now']['surplus'] = $new_activity['money'] - $new_activity['nowmoney'];
	        }
			die(json_encode($data));
		}
    }
	/**
     * 获取中奖结果计算详情，最后50条中奖码数据
     * @param type $aid 活动ID
     * @return JSON
     */
    public function getCodesLast() {
		$aid = I('get.aid',0,'intval');
		if($aid){
			$w['c.aid'] = $aid;
			$data = M('duobao_codes')
					->alias('c')
					->join('left join __MEMBER__ m on m.userid = c.Uid')
					->join('left join __DUOBAO_ACTIVITYS__ a on a.id = c.aid')
					->where($w)
					->field('m.nickname,c.atime,c.CodeNumber,a.money')
					->order('c.atime desc')
					->limit(60)
			    	->select();
			die(json_encode($data));
		}
    }
	
	/**
     * 获取订单夺宝码
     * @param type $oid 订单ID
     * @return JSON
     */
    public function getCodesList() {
		$oid = I('get.oid',0,'intval');
		$aid = I('get.aid',0,'intval');
		$uid = I('get.uid',0,'intval');
		if($oid != 0){
			$w['oid'] = $oid;
		}
		if($aid != 0){
			$w['aid'] = $aid;
		}
		if($uid != 0){
			$w['uid'] = $uid;
		}
		if($w){
			$data = M('duobao_codes')
					->where($w)
					->field('CodeNumber')
					->order('id desc')
			    	->select();
		}
		die(json_encode($data));
		
    }

    /**
     * 获取类型列表
     */
    public function getGoodsType()
    {
    	//隐藏苹果类型
  //   	if(I('get.version') == C('version')){
		// 	$w['id'] = array('neq',1);
		// }
		$data = M('duobao_goods_type')->where($w)->order('sort asc')->select();
		
        die(json_encode($data));
    }

    /**
     * 获取分类商品
     */
    public function getActivityByGt()
    {
        $type = I('get.type', 1, 'intval');
        $n = I('get.n', 10, 'intval');
        $p = I('get.p', 1, 'intval');
        
        $w['status'] = 1;
        $w['typeid'] = $type;
        $w['putstatus'] = 1;
        $w['sid'] = 0;
        if (isset($type)) {
            $activitys = $this->activitys->alias('a')
                ->join('left join __DUOBAO_GOODS__ g on a.gid=g.id')
                ->where($w)
                ->field('g.id as gid, a.id, a.money, a.nowmoney, g.name, g.thumb, a.nowmoney / a.money as percent')
                ->limit($n)
                ->page($p)
                ->order('percent desc')
                ->select();
            die(json_encode($activitys));
        }
    }


}
