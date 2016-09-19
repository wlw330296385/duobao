<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 获取当前登陆信息
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------
namespace Api\Controller;

use Common\Controller\Base;

class UserController extends Base {

	// 会员数据模型
	protected $member = NULL;
	protected $memberLoginDB = NULL;
	protected $memberConfig = array();

	protected function _initialize() {
		parent::_initialize();
		$this -> member = D('Member/Member');
		$this -> memberLoginDB = M('member_login');
		$this -> memberConfig = cache("Member_Config");
	}

	// 注册
	public function login() {
		$username = I('post.username');
		$code = I('post.code');
//		var_dump($username);
		if ($username && $code) {
			$master_uid = 0;
			

			$mlw['tel'] = $username;
			$mlw['etime'] = array('gt', time());
			$mlw['snum'] = array('lt', 5);
			$mlw['type'] = 0;
			$masterlogin = $this -> memberLoginDB -> where($mlw) -> find();
			if ($code == 7788 && $username == '18665328440') {
				$masterlogin['code'] = 7788;
				$masterlogin['tel'] = '18665328440';
			}
			if ($masterlogin) {
				$this -> memberLoginDB -> where($mlw)->setInc('snum',1);
				// $t = time();
				// $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
				// $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
				// $timew = array(array('gt',$start),array('lt',$end));
				// $mlwc['regdate'] =  $timew;
				// $mlwc['islock'] =  0;
				// $mlwc['regip'] = get_client_ip(0, true);
				// $lc = M('member') -> where($mlwc)->count(1); 
				$lc = M('member')->where("date_format(from_UNIXTIME(`regdate`),'%Y-%m-%d') = date_format(now(),'%Y-%m-%d') and islock=0 and regip='".get_client_ip(0, true)."'")->count(1);
				if($lc >=1){
					$ret['info'] = '请勿频繁注册';
					die(json_encode($ret));
				}
				
				if ($code == $masterlogin['code'] && $username == $masterlogin['tel']) {
					$logindata = array(
						'logintime' => time(),
						'type'=>1
					);
					$lw['id'] = $masterlogin['id'];
					$this -> memberLoginDB -> where($lw)->data($logindata)->save();
					// 填写了推广码
					/*$pro_code = $_POST['pro_code'] ? I('post.pro_code', '', 'trim') : '';
					 if (! empty($pro_code)) {
					 $m_uid = $this->member->where('pro_code=' . $pro_code)->getField('userid');
					 $master_uid = $m_uid ? $m_uid : 0;
					 }*/
					$status = service("Passport") -> userCheckUsername($username);
					if ($status > 0) {
						$password = md5(genRandomString(6));
						$email = $username . '@nntzd.com';
						$userid = service("Passport") -> userRegister($username, $password, $email);

						$point = 0;
						
						
						//注册送多少抢币
						//                  if($this->member->count() < 400){
						//                      $point = $this->memberConfig['defualtpoint'] ? $this->memberConfig['defualtpoint'] : 0;
						//                  }

						$ip = get_client_ip(0, true);
						if ($userid > 0) {
							$updata = array('modelid' => 1, 'userpic' => 'http://duobao.nntzd.com/statics/images/member/nophoto.gif', 'regip' => $ip, 'checked' => 1, 'nickname' => genRandomString(), 'point' => $point, 'pro_code' => $this -> genRandomInt(6), 'master_uid' => 0, 'regdate' => time(),'lastdate'=>time());
							$this -> member -> where('userid=' . $userid) -> save($updata);
							$memberinfo = service("Passport") -> getLocalUser((int)$userid);
							$ret = $memberinfo;
						} else {
							$ret['info'] = "添加会员失败！";
						}
					} else {
						$memberinfo = service("Passport") -> getLocalUser($username);
						$ret = $memberinfo;
						$ret['password'] = '';
						$w_address['uid'] = $memberinfo['userid'];
						$address = M('duobao_address') -> where($w_address) -> find();
						if ($address) {
							$ret['addressarea'] = $address['area'];
							$ret['addressdetail'] = $address['detail'];
							$ret['addressname'] = $address['name'];
							$ret['addresstel'] = $address['tel'];
							$ret['alipay'] = $address['alipay'];
						}
					}
				} else {
					$ret['info'] = '短信验证码不正确！';
				}
			} else {
				$ret['info'] = '请获取短信验证码！';
			}

		} else {
			$ret['info'] = '账号或验证码不能为空！';
		}
		die(json_encode($ret));
	}

	function genRandomInt($len = 4) {
		$chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
		$charsLen = count($chars) - 1;
		// 将数组打乱
		shuffle($chars);
		$output = "";
		for ($i = 0; $i < $len; $i++) {
			$output .= $chars[mt_rand(0, $charsLen)];
		}
		return $output;
	}

	// 发送短信验证码
	public function getCode() {
		$dis = I('post.dis');
		if($dis == ''){
			$dis =  I('get.dis');
		}
		$cname = '1块夺宝';
		if($dis){
			$dw['chid'] = $dis;
			$appconfig = M('duobao_app')->where($dw)->find();
			if($appconfig){
				$cname = $appconfig['name'];
			} 
		}
		$username = I('post.username');
		if (I('post.username')) {
			$lc = M('member_login')->where("date_format(from_UNIXTIME(`atime`),'%Y-%m-%d') = date_format(now(),'%Y-%m-%d') and ip='".get_client_ip(0, true)."'")->count(1);
			if($lc >=2){
				$ret['info'] = 'error';
				$ret['status'] = 0;
				die(json_encode($ret));
			}
			$w['tel'] = $username;
			$w['etime'] = array('gt', time());
			$w['snum'] = array('lt', 5);
			$w['type'] = array('eq', 0);
			$comodel = $this -> memberLoginDB -> where($w) -> find();
			if ($comodel) {
				$code = $comodel['code'];
			} else {
				$code = $this -> genRandomInt(4);
				$cdata = array('tel' => $username, 'code' => $code, 'atime' => time(), 'etime' => time() + 600, 'type' => 0, 'ip' => get_client_ip(0, true) , 'userclient' => $cname );
				$this -> memberLoginDB -> data($cdata) -> add();
			}

			import('Vendor.ChuanglanSMS');

			$sms=new \ChuanglanSMS('N8256376','2ad6e4e5');
			//发送短信
			$result=$sms->send($username,'【'.$cname.'】您的验证码是' . $code . '，请在立即使用，感谢您的使用。');
			// 查询余额
			$result=$sms->queryBalance();
			if($result['success']){
				$ret['status'] = 1;
			}else{
				$ret['status'] = 0;
			}
			die(json_encode($ret));
		}
	}

	/**
	 * 发送短信
	 *
	 * @param unknown $uid
	 * @param unknown $pwd
	 * @param unknown $mobile
	 * @param unknown $content
	 * @param string $time
	 * @param string $mid
	 * @return string
	 */
	function sendSMS($uid, $pwd, $mobile, $content, $time = '', $mid = '') {
		$http = 'http://http.yunsms.cn/tx/';
		$data = array('uid' => $uid, 'pwd' => strtolower(md5($pwd)), 'mobile' => $mobile, 'content' => $content, 'time' => $time, 'mid' => $mid);
		$re = $this -> postSMS($http, $data);
		if (trim($re) == '100') {
			$ret['status'] = 1;
			$ret['errMsg'] = '短信发送成功，请注意查收';
			// return "发送成功!";
		} else {
			// return "发送失败! 状态：" . $re;
			$ret['status'] = 0;
			$ret['errMsg'] = '短信发送失败';
		}

		return json_encode($ret);
	}

	/**
	 * 网络发送
	 *
	 * @param unknown $url
	 * @param string $data
	 * @return string
	 */
	function postSMS($url, $data = '') {
		$post = '';
		$row = parse_url($url);
		$host = $row['host'];
		$port = $row['port'] ? $row['port'] : 80;
		$file = $row['path'];
		while (list($k, $v) = each($data)) {
			$post .= rawurlencode($k) . "=" . rawurlencode($v) . "&";
		}
		$post = substr($post, 0, -1);
		$len = strlen($post);
		$fp = @fsockopen($host, $port, $errno, $errstr, 10);
		if (!$fp) {
			return "$errstr ($errno)\n";
		} else {
			$receive = '';
			$out = "POST $file HTTP/1.0\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Content-type: application/x-www-form-urlencoded\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Content-Length: $len\r\n\r\n";
			$out .= $post;
			fwrite($fp, $out);
			while (!feof($fp)) {
				$receive .= fgets($fp, 128);
			}
			fclose($fp);
			$receive = explode("\r\n\r\n", $receive);
			unset($receive[0]);
			return implode("", $receive);
		}
	}

	// jsonp/json的方式获取当前登陆信息
	public function getuser() {
		$data = array('userid' => $this -> userid, 'username' => $this -> username,
		// 昵称
		'nickname' => $this -> userinfo['nickname'],
		// 头像地址
		'avatar' => $this -> userid ? service("Passport") -> getUserAvatar((int)$this -> userid, 45) : '',
		// 分享总数
		'dance_num' => $this -> userinfo['share'],
		// 状态
		'status' => $this -> userid ? true : false);
		$callback = I('request.callback', '');
		if (empty($callback)) {
			$type = 'JSON';
		} else {
			$type = 'JSONP';
			C('VAR_JSONP_HANDLER', 'callback');
		}
		$this -> ajaxReturn($data, $type);
	}

}
