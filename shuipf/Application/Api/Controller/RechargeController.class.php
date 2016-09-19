<?php
namespace Api\Controller;

use Think\Controller;

class RechargeController extends Controller
{

    protected $activitysDB = null;

    protected $goodsDB = null;

    protected $ordersDB = null;

    protected $winningDB = null;

    protected $showsDB = null;

    protected $pay_ordersDB = null;
    // 会员数据库对象
    protected $memberDb = NULL;
    // 初始化
    protected function _initialize()
    {
        $this->activitysDB = M('duobao_activitys');
        $this->goodsDB = M('duobao_goods');
        $this->ordersDB = M('duobao_orders');
        $this->winningDB = M('duobao_winning');
        $this->showsDB = M('duobao_shows');
        $this->memberDb = D('Member/Member');
        $this->pay_ordersDB = M('duobao_pay_orders');
    }

    /**
     * 手机获取中奖名单接口
     */
    public function tel_winning()
    {
        $data = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_ADDRESS__ ad on ad.uid=w.uid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->field('m.username, m.nickname,m.userid,g.name,a.money,a.section,w.atime,w.id, ad.alipay')
            ->order('w.atime desc')
            ->where('m.islock=0 and w.status=0')
            ->select();
        die(json_encode($data));
    }

    /**
     * 手机端设置已发货
     */
    public function tel_winning_send()
    {
        if (IS_POST) {
            $data = array(
                'status' => 1,
                'sendnumber' => I('post.sendnumber'),
                'sendname' => I('post.sendname')
            );
            $wup['id'] = I('post.id');
            if ($this->winningDB->where($wup)->save($data)) {
                $ret = array(
                    'status' => 1,
                    'msg' => '发货成功'
                );
            } else {
                $ret = array(
                    'status' => 0,
                    'msg' => '发货失败'
                );
            }
            die(json_encode($ret));
        }
    }

    /**
     * 获取中奖人信息
     */
    public function tel_winner_info()
    {
        $w['w.id'] = I('get.id');
        $winning = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ADDRESS__ ad on ad.uid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('m.nickname,m.username,ad.detail,ad.name as addressname,ad.tel,a.section,a.money,g.name,c.codenumber, ad.alipay')
            ->where($w)
            ->find();
        die(json_encode($winning));
    }
}
    