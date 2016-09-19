<?php

//用户

namespace DuoBao\Controller;

use Common\Controller\Base;

class MemberbaseController extends Base {
	
	//会员模型相关配置
    protected $memberConfig = array();
    //会员模型缓存
    protected $memberModel = array();
    //会有组缓存
    protected $memberGroup = array();
    //会员数据库对象
    protected $memberDb = NULL;
    //用户id
    protected $userid = 0;
    //用户信息
    protected $userinfo = array();
	
	
    protected function _initialize() {
        parent::_initialize();
		$this->memberConfig = cache("Member_Config");
        $this->memberGroup = cache("Member_group");
        $this->memberModel = cache("Model_Member");
        $this->memberDb = D('Member/Member');
        header("Access-Control-Allow-Origin:*");
        //dump(service("Passport")->userCheckUsername('admin'));exit;
        //登陆检测
//         $this->check_member();
		
	}
	/**
     * 检测用户是否已经登陆 
     */
    final public function check_member() {
    	if(!I('get.uid')){
			die('need uid');
		}
		if(!I('get.encrypt')){
			die('need encrypt');
		}
		$w['userid'] = I('get.uid');
		$w['encrypt'] = I('get.encrypt');
		$this->userinfo = $this->memberDb->where($w)->find();
		if($this->userinfo){
			$this->userid = $this->userinfo['userid'];
			return true;
		}else{
			die('user does not exist');
		}
	}
}
