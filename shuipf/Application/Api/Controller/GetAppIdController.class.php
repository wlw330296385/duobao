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

import('Vendor.DuobaoJssdk');


class GetAppIdController extends Base {

    protected $appid = 'wxf1d79112b87ce476';

    protected $appsecret = 'b43661c51fdc2522bb6b8aa5f5f8320e';


    public function getAll(){

    	$jssdk = new \JSSDK($this->appid, $this->appsecret);
        $js_sign = $jssdk->GetSignPackage();
        
        die(json_encode($js_sign));

    }

}
