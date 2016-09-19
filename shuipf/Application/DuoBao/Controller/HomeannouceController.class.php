<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 系统权限配置，用户角色管理
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace DuoBao\Controller;

use Common\Controller\AdminBase;

class HomeannouceController extends AdminBase {

    public function index(){//前台公告列表
      $model = D('homeAnnouce');
      $this->list = $model->order('atime desc')->select();
      $this->display();
    }

    public function annouce_add(){//添加公告
            if (IS_POST) {
            	$data = I('post.');
              
              $data['atime'] = $_SERVER['REQUEST_TIME'];
            	$model = M('homeAnnouce');
              
            	$rows  = $model->data($data)->add();
               $this->remain($rows,'添加');

            }else{

             $this->display();
            }

    	

    }
    public function annouce_delete(){//删除前台公告
      $model = D('homeAnnouce');
      if (IS_POST) {//多条删除
      	$_id = I('post.');
      	if (empty($_id)) {
      		$this->error('至少选择一条');
      	}
      	foreach ($_id as $key => $value) {
         $str = '';
         foreach ($value as $k => $val) {
          		$str.=$val.',';
          	} 	
      	}
      	$str = substr($str, 0,-1);
      	$rows = $model->where('id in '.'('.$str.')')->delete();
        $this->remain($rows);
      }
      if (IS_GET) {//删除一条
      	$_id = I('get.id',0,int);

      	$row = $model->where('id='.$_id)->delete();
      	$this->remain($row);
      }


    }
    public function annouce_edit(){//修改公告
       $model = D('homeAnnouce');
       if (IS_POST) {
        $data = I('post.');
        
        unset($data['pic']);
        $data['content'] = explode(';', $data['editorValue']);
        $data['content'] =  str_replace('&lt', '', $data['content'][2]);
       
        
        foreach ($data as $key => $value) {
        	if (empty($data[$key])) {
        		unset($data[$key]);
        	}
        	
        }
        unset($data['editorValue']);
        unset($data['upload']);
        $data['atime'] = $_SERVER['REQUEST_TIME'];
        
        $rows=$model->where('id='.$data['id'])->save($data);
        $this->remain($rows,'修改');
       }else{
	       $_id = I('get.id',0,int);
	       $this->one = $model->where('id='.$_id)->find();
	       $this->assign('id',$_id);
	       $this->display();
       }
       

    }

    public function remain($row,$word='删除'){//操作后的跳转
   		if ($row>=0) {
      		$this->success($word.'成功',U('Homeannouce/index'));
      	}
      	else{
      		$this->error('非法操作',U('Homeannouce/index'));
      	}
    }


}
