<?php
namespace Api\Controller;

use Common\Controller\Base;

class AppController extends Base {
	public function get_update(){
		$chId = I('get.chId');
		if(empty($chId)){
			die(json_encode(array('status'=>0)));
		}
		$w['chid'] = $chId;
		$data = M('duobao_app')->where($w)->find();
		if(!$data){
			$data['status'] = 0;
		}
		die(json_encode($data));
	}
	function getTimestamp($utimestamp) {
       $timestamp = substr($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return date('His',$timestamp).$m;
	}
	//全格式
	function getDateF($utimestamp) {
       $timestamp = substr($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return date('Y-m-d H:i:s',$timestamp).'.'.$m;
    }
    //时间戳转全格式数字时间
	function getDateAllF($utimestamp) {
       $timestamp = substr($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return date('YmdHis',$timestamp).'.'.$m;
    }
    //全格式数字时间转时间戳
	function getTampAllF($utimestamp) {
       $timestamp = strtotime($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return $timestamp.$m;
    }
    
	public function getLuck($aid){
		$gaw['id'] = $aid;
		$atv = M('duobao_activitys')->where($gaw)->find();
		$w['aid'] = $atv['id'];
		$all_time = M('duobao_orders')
							->alias('o')
							->join('left join __MEMBER__ m on m.userid = o.uid')
							->order('o.mstime desc')
							->field('m.nickname,o.mstime')
							->limit(60)
							->select();

		$num_a = 0;
		$old_time = array_slice($all_time,4,54);
		foreach ($old_time as $key => $value) {
				$num_a += intval(getTimestamp($value['mstime']));
		}
		$num_b = intval($atv['money']);
		
		$code = fmod($num_a,$num_b) + 10000001;

		$ocw['aid'] = $atv['id'];
		$ocw['codenumber'] = $code;
		$ocdb = M('duobao_codes')->where($ocw)->find();
		$ocmw['userid'] = $ocdb['uid'];
		$ocm = M('member')->where($ocmw)->find();

		$ret['id'] = $ocdb['id'];
		$ret['uid'] = $ocm['userid'];

		if($ocm['islock'] == 0){
			//判断是否别无选择
			
			$cw['aid'] = $atv['id'];
			$cw['codenumber'] = array('neq',$code);
			//查询该码是否属于自己的
			$newdata = M()->query('SELECT c.id,c.codenumber,m.userid,c.oid,m.islock,ABS(c.codenumber-'.$code.') as a from s_duobao_codes c LEFT JOIN s_member m on c.uid = m.userid where m.islock = 1 and c.aid='.$atv['id'].' and c.codenumber <> '.$code.' ORDER BY a asc LIMIT 1');
			if($newdata){
				$ret['id'] = $newdata[0]['id'];
				$ret['uid'] = $newdata[0]['userid'];
				$new_code = $newdata[0]['codenumber'];
				$x = $new_code-$code;
				$y = abs($x);
				for ($i=0; $i < $y ; $i++) { 
					foreach ($old_time as $key => $value) {

						if($x <0){
							$nt = $value['mstime']-1;
						}else{
							$nt = $value['mstime']+1;
						}
						$old_time[$key]['mstime'] = $nt;	

						if($i<=$y){
							break;
						}
					}
				}

				$oi = 0;
				for ($i=4; $i < 54; $i++) { 
					$all_time[$i] = $old_time[$oi];
					$oi++;
				}
			}
		}
		$overs = array();
		foreach ($all_time as $key => $value) {
			$overs[] = array(
				'atime'=>$value['mstime'],
				'nickname'=>$value['nickname'],
				'aid'=>$aid
			);
		}
		M('duobao_overs')->addAll($overs);
		return $ret;
	}
}
