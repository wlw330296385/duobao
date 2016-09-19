<?php
namespace DuoBao\Controller;

use Common\Controller\Base;

class CartController extends Base
{

    protected $cartDB;

    protected $goodsDB;

    protected $userinfo = array();

    protected $memberDb;

    protected $activitysDB;

    function _initialize()
    {
        parent::_initialize();
        $this->cartDB = M('duobao_cart');
        $this->goodsDB = M('duobao_goods');
        $this->memberDb = M('member');
        $this->activityDB = M('duobao_activitys');
    }

    /**
     * 我的购物车
     */
    function cart()
    {
        // 每次都要检查是否过期，并且返回是否过期1未过期0过期。。。
        $this->check_member();
        $w['uid'] = $this->userid;
        $field = 'c.*, g.name, g.thumb, a.money, a.nowmoney, a.status';
        $data = $this->cartDB->table($this->cartDB->getTableName() . ' as c')
            ->join($this->goodsDB->getTableName() . ' as g on c.gid=g.id', 'left')
            ->join($this->activityDB->getTableName() . ' as a on c.section=a.section and c.gid=a.gid', 'left')
            ->field($field)
            ->where($w)
            ->select();
        
        foreach ($data as $k => $v) {
            if ($v['status'] == 1) {
                // 没有过期
                $left = $v['money'] - $v['nowmoney'];
                if ($v['num'] > $left) {
                    $data[$k]['num'] = $left;
                    $this->cartDB->save($data[$k]);
                }
            } else {
                // 过期、修改期数
                // 当前该商品的是第几期？
                $where['gid'] = $v['gid'];
                $where['status'] = 1;
                $nowact = $this->activityDB->where($where)
                    ->order('id desc, atime desc')
                    ->find();
                $data[$k]['section'] = $nowact['section'];
                $data[$k]['money'] = $nowact['money'];
                $data[$k]['nowmoney'] = $nowact['nowmoney'];
                $left = $nowact['money'] - $nowact['nowmoney'];
                if ($v['num'] > $left) {
                    $data[$k]['num'] = $left;
                }
                $this->cartDB->save($data[$k]);
            }
        }
        die(json_encode($data));
    }

    /**
     * 删除购物车item
     */
    function del()
    {
        $this->check_member();
        $w['id'] = I('get.cid', 0, 'intval');
        $w['uid'] = $this->userid;
        if ($this->cartDB->where($w)->delete()) {
            $ret['status'] = 1;
            $ret['msg'] = '删除成功';
        } else {
            $ret['status'] = 0;
            $ret['msg'] = '不存在该商品';
        }
        die(json_encode($ret));
    }

    /**
     * 添加到购物车
     */
    function add()
    {
        $this->check_member();
        $ret['status'] = 0;
        $aid = I('get.aid', 0, 'intval');
        if (empty($aid)) {
            $ret['msg'] = 'need aid';
            die(json_encode($ret));
        }
        // 活动信息
        $w['id'] = $aid;
        $act_info = $this->activityDB->where($w)->find();
        // 该期活动结束
        if (empty($act_info)) {
            $ret['msg'] = '活动不存在';
            die(json_encode($ret));
        }
        
        $data['uid'] = $this->userid;
        $data['gid'] = $act_info['gid'];
        
        // 是否已经存在
        $cart_info = $this->cartDB->where($data)->find();
        
        if ($cart_info) {
            $ret['status'] = 1;
            $ret['msg'] = '添加成功';
            die(json_encode($ret));
        } else 
            if ($act_info['status'] == 0) {
                $ret['msg'] = '活动已结束';
                die(json_encode($ret));
            }
        
        $data['num'] = 1;
        $data['section'] = $act_info['section'];
        $data['atime'] = time();
        
        if ($this->cartDB->add($data)) {
            $ret['status'] = 1;
            $ret['msg'] = '添加成功';
        } else {
            $ret['msg'] = '添加失败';
        }
        die(json_encode($ret));
    }

    /**
     * 修改购物车数量
     */
    function edit()
    {
        $this->check_member();
        $ret['status'] = 0;
        $num = I('get.num', 0, 'intval');
        if (empty($num)) {
            $ret['msg'] = '数量不能为0';
            die(json_encode($ret));
        }
        $w['id'] = I('get.cid', 0, 'intval');
        $w['uid'] = $this->userid;
        $d['num'] = $num;
        if ($this->cartDB->where($w)->save($d) != false) {
            dump($this->cartDB->getLastSql());
            $ret['status'] = 1;
            $ret['msg'] = '修改成功';
        } else {
            $ret['msg'] = '修改失败';
        }
        die(json_encode($ret));
    }

    /**
     * 验证用户
     */
    public function check_member()
    {
        if (! I('get.uid')) {
            die('need uid');
        }
        if (! I('get.encrypt')) {
            die('need encrypt');
        }
        $w['userid'] = I('get.uid');
        $w['encrypt'] = I('get.encrypt');
        $this->userinfo = $this->memberDb->where($w)->find();
        if ($this->userinfo) {
            $this->userid = $this->userinfo['userid'];
            return true;
        } else {
            die('user does not exist');
        }
    }
}
