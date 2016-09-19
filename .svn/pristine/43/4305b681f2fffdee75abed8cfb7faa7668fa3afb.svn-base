<?php

//用户


namespace DuoBao\Controller;

use Common\Controller\Base;

class APPController extends Base {
	
	protected $ordersDB;
	protected $activitysDB;
	protected $codesDB;
	protected $winningDB;
	protected $goodsDB;
	
	function _initialize() {
		parent::_initialize ();
		$this->ordersDB = M('duobao_orders');
		$this->activitysDB = M('duobao_activitys');
		$this->codesDB = M('duobao_codes');
		$this->goodsDB = M('duobao_goods');
		$this->winningDB = M('duobao_winning');
		
	}
	public function wjseta(){
		$content = '发货通知：您中得的第 '.$winning['section'].' 期 '.$winning['name'].'，已经发货了，实物请留意快递。http://t.cn/RGNWfRE 下载APP，1元抢iPhone宝马奔驰【1块夺宝】';
	        sendSMS($winning['tel'], $content);
	}
	public function getConfig(){
		$ret['pay'] = array(
			array(
				'channel'=>'alipay',
				'status'=>1
			),
			array(
				'channel'=>'wx',
				'status'=>1
			),
			array(
				'channel'=>'alipay_wap',
				'status'=>0
			),
		);
		die(json_encode($ret));
	}
	//晒单分享
    public function showsList() {
    	$gid = I('get.gid',0,'intval');
    	$this->assign('gid', $gid);
    	$this->display();
    }
	//往期回顾
    public function winningList() {
    	$gid = I('get.gid',0,'intval');
    	$this->assign('gid', $gid);
    	$this->display();
    }
	//中奖计算结果
    public function luckResults() {
    	$aid = I('get.aid',0,'intval');
		if($aid){
			$w['aid'] = $aid;
			$w_act['id'] = $aid;
			$adata = $this->activitysDB->where($w_act)->field('money,etime')->find();
			
			$data = M('duobao_overs')
					->where($w)
					->field('nickname,atime')
					->order('atime desc')
			    	->select();
			$resA = 0;
			$newData = array_slice($data,4,54);
			foreach ($newData as $key => $value) {
					$resA += intval(getTimestamp($value['atime']));
			}
			$resB = intval($adata['money']);
			
			$result = fmod($resA,$resB) + 10000001;
			if(time()<$adata['etime']){
				$result = '等待揭晓'; 
			}
			$this->assign('resA', $resA);
			$this->assign('resB', $resB);
			$this->assign('result', $result);
			$this->assign('list', $data);
		}
    	$this->display();
    }

}
