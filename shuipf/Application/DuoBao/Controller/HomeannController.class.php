<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 系统权限配置，用户角色管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------
namespace DuoBao\Controller;

use Think\Controller;

class HomeannController extends Controller
{
    // 前台公告列表
    public function announce_list()
    {
        $model = D('homeAnnouce');
        $list = $model->order('atime desc')->select();

        foreach ($list as $key => $value) {
            $list[$key]['content'] = htmlspecialchars_decode($list[$key]['content']);
        }
        die(json_encode($list));
    }

    public function announce_detail()
    {
        $model = M('homeAnnouce');

        $_id = I('get.id', 0, 'intval');

        $one = $model->where('id=' . $_id)->find();

        $one['content'] = htmlspecialchars_decode($one['content']);
        
        die(json_encode($one));
    }
}
