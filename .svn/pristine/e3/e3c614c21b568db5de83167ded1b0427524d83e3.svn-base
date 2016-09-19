<?php
namespace DuoBao\Controller;

use Common\Controller\Base;

use Think\Model;

/**
 * 积分消耗、积分记录
 *
 * @author Xzz
 *        
 */
class CreditController extends Base
{

    protected $creditDB = null;

    protected $userId = 0;

    protected $memberDb = null;
    protected $userinfo = array();

    /**
     * 初始化
     */
    function _initialize()
    {
        parent::_initialize();
        $this->creditDB = M('credit_log');
        $this->memberDb = D('Member/Member');
        header('content-type:text/html;charset=utf-8');
    }

    /**
     * 积分兑换抢币
     */
    function exchange()
    {
        $this->check_member();
    }

    /**
     * 积分记录
     */
    function credit_log()
    {
//         $this->check_member();
        $logs = $this->creditDB->select();
        echo $this->creditDB->getLastSql();
        dump($logs);
    }

    /**
     * 检查用户
     */
    final public function check_member()
    {
        if (! I('get.uid')) {
            die('need uid');
        }
        if (! I('get.encrypt')) {
            die('need encrypt');
        }
        $w['userid'] = I('get.uid');
        $w['encrypt'] = I('get.encrypt');
        dump($w);
        dump($this->memberDb);
        $this->userinfo = $this->memberDb->where($w)->find();
        dump($this->userinfo);
        echo $this->memberDb->getLastSql();
        if ($this->userinfo) {
            $this->userId = $this->userinfo['userid'];
        } else {
            die('user does not exist');
        }
    }
}