<?php

// 用户
namespace DuoBao\Controller;

use Common\Controller\AdminBase;

class BannerController extends AdminBase
{

    function _initialize()
    {
        parent::_initialize();
        $this->banner = M('duobao_banner');
    }

    public function index()
    { // banner列表
        $list = $this->banner->order('id desc')->select();
        $this->assign('list', $list);
        $this->display('Manager/banner_list');
    }

    public function banner_add()
    { // banner添加
        if (IS_POST) {
            $data = I('post.');
            
            $rules = array(
                
                array(
                    'type',
                    'require',
                    '类型不能为空'
                ),
                array(
                    'param',
                    'require',
                    '参数不能为空'
                ),
                array(
                    'path',
                    'require',
                    '轮播图不能为空'
                )
            )
            ;
            
            if (! $this->banner->validate($rules)->create()) {
                $this->error($this->banner->getError());
            } else {
                $rows = $this->banner->add($data);
                $this->remain($rows, '添加');
            }
        }
        $this->display('Manager/banner_add');
    }

    public function banner_edit()
    { // 轮播修改
        if (IS_GET) {
            $id = I('get.id', 0, 'intval');
            $map['id'] = array(
                'eq',
                $id
            );
            $one = $this->banner->where($map)->find();
            $this->assign('one', $one);
        }
        if (IS_POST) {
            $data = I('post.');
            $map['id'] = array(
                'eq',
                $data['id']
            );
            $rules = array(
                
                array(
                    'type',
                    'require',
                    '类型不能为空'
                ),
                array(
                    'param',
                    'require',
                    '参数不能为空'
                ),
                array(
                    'path',
                    'require',
                    '轮播图不能为空'
                )
            )
            ;
            
            if (! $this->banner->validate($rules)->create()) {
                $this->error($this->banner->getError());
            } else {
                $rows = $this->banner->save($data);
                
                $this->remain($rows, '修改');
            }
        }
        $this->display('Manager/banner_edit');
    }

    public function banner_delete()
    { // 轮播删除
        if (IS_GET) { // 单条删除
            $map['id'] = array(
                'eq',
                I('get.id', 0, 'intval')
            );
        }
        if (IS_POST) {
            $ids = I('post.');
            $id_str = implode(',', $ids['id']);
            $map['id'] = array(
                'in',
                $id_str
            );
        }
        $rows = $this->banner->where($map)->delete();
        $this->remain($rows);
    }
    public function status(){
        $w['id'] = I('get.id');
        $data['status'] = I('get.status');
        M('duobao_banner')->where($w)->data($data)->save();
        $this->success($word . '设置成功', U('Banner/index'));
    }
    public function remain($row, $word = '删除') // 操作后的跳转
    {
        if ($row >= 0) {
            $this->success($word . '成功', U('Banner/index'));
            exit();
        } else {
            $this->error('非法操作', U('Banner/index'));
            exit();
        }
    }
}
