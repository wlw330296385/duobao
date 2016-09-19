<?php
// 用户
namespace DuoBao\Controller;

use Common\Controller\AdminBase;
use Think\Model;

class ManagerController extends AdminBase
{

    protected $activitysDB = null;

    protected $goodsDB = null;

    protected $ordersDB = null;

    protected $winningDB = null;

    protected $showsDB = null;

    protected $pay_ordersDB = null;
    // 会员数据库对象
    protected $memberDb = NULL;

    protected $point_logDB = NULL;
    // 初始化
    protected function _initialize()
    {

        parent::_initialize();
        $this->activitysDB = M('duobao_activitys');
        $this->goodsDB = M('duobao_goods');
        $this->ordersDB = M('duobao_orders');
        $this->winningDB = M('duobao_winning');
        $this->showsDB = M('duobao_shows');
        $this->memberDb = D('Member/Member');
        $this->pay_ordersDB = M('duobao_pay_orders');
        $this->point_logDB = M('point_log');
    }

    /**
     * 基础设定
     */
    public function setting()
    {
        $this->display();
    }

    /**
     * 商品管理
     */
    public function goods()
    {
//         $field = 'gid,user_count,money_sum,goods.id,name,money,atime,thumb,putstatus,typename,orgprice';
//         $qurey = 'SELECT  '.$field.' from  `s_duobao_goods`  as goods LEFT JOIN (SELECT gid, count(uid) as user_count, SUM(`money`) as money_sum  FROM `s_duobao_orders` where uid not IN (select userid from s_member where islock=1) and status=1 GROUP BY gid) as sum_count on goods.id=sum_count.gid LEFT JOIN s_duobao_goods_type as type on goods.typeid=type.id';
//         $model = new Model();
//         $data = $model->query($qurey);
// //		echo $model->getLastSql();
//         foreach ($data as $key => $value) {
//             $user_count[$key] = $value['user_count'];
//             $money_sum[$key] = $value['money_sum'];
//         }

//         $sort = I('post.sort', 1, 'intval');
//         $order = $sort ? $sort : 2;

//         switch ($order) {
//             case 1:
//                 array_multisort($user_count, SORT_DESC, $data);
//                 break;
//             case 2:
//                 array_multisort($money_sum, SORT_DESC, $data);
//                 break;
//         }
//         $this->assign('sort', $sort);
		$data = $this->goodsDB->select();
        $this->assign('type', M('duobao_goods_type')->select());
        $this->assign('data', $data);
        $this->display();
    }
    

    /**
     * 商品管理
     */
    public function goods_add()
    {
        if (IS_POST) {

            $putstatus = I('post.putstatus',0);
            $single = I('post.single',1);
            $autopay = I('post.autopay',0);
            $sid = I('post.sid',0);
            $name = I('post.name');
            $money = intval(I('post.money'));
            $thumb = I('post.thumb');
            $typeid = I('post.typeid');
            $detail = I('post.detail', '', 'htmlspecialchars');
            $orgprice = I('post.orgprice', 0.0, 'floatval');
            $paynum = I('post.paynum',0);
            // 新增商品
            $goodData = array(
                'name' => $name,
                'money' => $money,
                'orgprice' => $orgprice,
                'thumb' => $thumb,
                'typeid' => $typeid,
                'atime' => time(),
                'detail' => $detail,
                'putstatus' => $putstatus,
                'single' => $single,
                'paynum' => $paynum,
                'preset' => 0,
                'sid' => $sid
            );
            
            $gid = M('duobao_goods')->data($goodData)->add();
            
            if($autopay == 1){
                $activityData = array(
                    'gid' => $gid,
                    'section' => 1,
                    'money' => $money,
                    'nowmoney' => 0,
                    'hot' => 0,
                    'seq' => 0,
                    'atime' => time(),
                    'etime' => 0,
                    'status' => 1
                );
                $aid = M('duobao_activitys')->data($activityData)->add();
                $pics = I('post.pic');
                foreach ($pics as $key => $value) {
                    $picData[] = array(
                        'path' => $value,
                        'gid' => $gid
                    );
                }
                M('duobao_goods_pic')->addAll($picData);
                $this->addCodes($aid, $money);
                $this->success('添加成功，第一场已经开始', U('Manager/goods'));
            }else{
                $this->success('商品添加成功', U('Manager/goods'));
            }
            
            
        } else {
            $this->assign('type', M('duobao_goods_type')->select());
            $this->assign('shops', M('duobao_shop')->select());
            $this->display();
        }
    }
	//启动商品活动期数
	public function goods_start(){
		$id = I('get.id');
		$w['id'] = $id;
		$goods = $this->goodsDB->where($w)->find();
        $isstart = M('duobao_activitys')->where('status=1 and gid='.$id)->count(1);
        if($isstart == 0){
            $activityData = array(
                'gid' => $id,
                'section' => 1,
                'money' => $goods['money'],
                'nowmoney' => 0,
                'hot' => 0,
                'seq' => 0,
                'atime' => time(),
                'etime' => 0,
                'status' => 1
            );
            $aid = M('duobao_activitys')->data($activityData)->add();
            $this->addCodes($aid, $goods['money']);
            $this->success('启动成功', U('Manager/goods'));
        }else{
            $this->error('启动失败，有正在进行的活动', U('Manager/goods'));
        }
		
		
		
	}
    public function goods_edit()
    {
        $id = I('get.id');
        $w['id'] = $id;
        if (IS_POST) {
            
            $saveData = array(
                'name' => I('post.name'),
                'money' => I('post.money'),
                'thumb' => I('post.thumb'),
                'typeid' => I('post.typeid'),
                'detail' => I('post.detail', '', 'htmlspecialchars'),
                'orgprice' => I('post.orgprice', 0.0, 'floatval')
            );
            $up = M('duobao_goods')->where($w)->save($saveData);
            
            $pics = I('post.pic');
            $pids = I('post.pid');
            foreach ($pics as $key => $value) {
                $picData = array(
                    'path' => $value,
                    'gid' => $gid
                );
                $ws['id'] = $pids[$key];
                M('duobao_goods_pic')->where($ws)->save($picData);
            }
            $this->success('保存成功', U('Manager/goods'));
        } else {
            $this->assign('type', M('duobao_goods_type')->select());
            $data = M('duobao_goods')->where($w)->find();
            $wg['gid'] = $id;
            $data['pic'] = M('duobao_goods_pic')->where($wg)->select();
            $this->assign('data', $data);
            $this->display();
        }
    }

    public function goods_delete()
    {
        $id = I('get.id');
        // 删除商品
        $this->goodsDB->delete($id);
        $adid['gid'] = $id;
        // 删除活动
        $alists = $this->activitysDB->where($adid)->select();
        $ODB = M('duobao_orders');
        $PODB = M('duobao_pay_orders');
        $TPODB = M('duobao_tmp_codes');
        $CDB = M('duobao_codes');
        foreach ($alists as $key => $av) {
            $this->activitysDB->delete($av['id']);
            $ow['aid'] = $av['id'];
            $ODB->where($ow)->delete();
            $PODB->where($ow)->delete();
            $TPODB->where($ow)->delete();
            $CDB->where($ow)->delete();
        }
    }

    /**
     * 商品类型
     */
    public function goods_type()
    {
        $typeDB = M('duobao_goods_type');
        $this->assign('types', $typeDB->order('sort asc')
            ->select());
        $this->display();
    }
	/**
     * 设置商品上架状态
     */
    public function goods_putstatus()
    {
        $id = I('get.id');
        $status = I('get.status');
        $w['id'] = $id;
        $data['putstatus'] = $status;
        $this->goodsDB->where($w)
            ->data($data)
            ->save();
        $this->success("设置成功！", U("Manager/goods"));
    }
    /**
     * 删除商品类型
     */
    public function del_type()
    {
        $id = $_GET['id'] ? I('get.id', null, 'intval') : ($_POST['id'] ? I('post.id') : null);
        if (isset($id)) {
            if (! is_array($id)) {
                $id = array(
                    $id
                );
            }
            $gw['typeid'] = $w['id'] = array(
                'in',
                $id
            );
            
            if ($this->goodsDB->where($gw)->getField()) {
                $this->error('存在该类型的商品，请先删除该类型下的商品');
                exit();
            }
            if (M('duobao_goods_type')->where($w)->delete()) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('至少要选择一条数据');
        }
    }

    /**
     * 排序类型
     */
    public function sort_type()
    {
        foreach ($_POST['listorders'] as $k => $v) {
            $w['id'] = $k;
            $w['sort'] = $v;
            M('duobao_goods_type')->save($w);
        }
        $this->success('排序成功');
    }

    /**
     * 添加类型
     */
    public function add_type()
    {
        if (IS_POST) {
            $type = M('duobao_goods_type');
            
            if ($type->create()) {
                $type->add() ? $this->success('添加成功') : $this->error('添加失败');
            } else {
                $this->error($type->getError());
            }
        } else {
            $this->display();
        }
    }

    /**
     * 编辑类型
     */
    public function edit_type()
    {
        if (IS_POST) {
            $type = M('duobao_goods_type');
            
            if ($type->create()) {
                $type->save() !== FALSE ? $this->success('修改成功') : $this->error('修改失败');
            } else {
                $this->error($type->getError());
            }
        } else {
            $id = I('get.id', null, 'intval');
            if (isset($id)) {
                $this->assign('type', M('duobao_goods_type')->where('id=' . $id)
                    ->find());
            }
            $this->display();
        }
    }

    /**
     * 活动管理
     */
    public function activitys()
    {
        $gid = I('get.gid');
        $w['gid'] = $gid;
        $count = $this->activitysDB->where($w)->count();
        $page = $this->page($count, 10);
        $data = $this->activitysDB->alias('a')
            ->join('left join __MEMBER__ m on m.userid=a.wuid')
            ->join('left join __DUOBAO_CODES__ c on c.id=a.wid')
			->join('left join __PRESET__ p on p.aid=a.id')
            ->where($w)
            ->field('a.*,m.nickname,m.islock,c.codenumber,p.id as pid')
            ->order('status desc,section desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
    }
	//活动订单列表
	public function activitys_order(){
		$aid = I('get.id');
        $w['o.aid'] = $aid;
		// $w['m.islock'] = 0;
		$dw['o.aid'] = $aid;
		// $dw['m.islock'] = 0;
        $count = $this->ordersDB->alias('o')
		            ->join('left join __MEMBER__ m on m.userid=o.uid')
		            ->where($w)
		            ->count();
        $page = $this->page($count, 15);
        $data = $this->ordersDB->alias('o')
            ->join('left join __MEMBER__ m on m.userid=o.uid')
            ->where($dw)
            ->field('o.uid,o.deal,o.money,o.aid,o.atime,m.nickname,m.islock,sum(o.deal) as adeal,(select sum(deal) from s_duobao_orders oo where oo.uid=m.userid and oo.status=1) as cdeal')
			->group('o.uid')
            ->order('o.atime desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
		
		
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
	}
    public function activitys_delete()
    {
        $av['id'] = I('get.id');
        $this->activitysDB->delete($av['id']);
        $ow['aid'] = $av['id'];
        $ODB = M('duobao_orders');
        $PODB = M('duobao_pay_orders');
        $TPODB = M('duobao_tmp_codes');
        $CDB = M('duobao_codes');
        
        $ODB->where($ow)->delete();
        $PODB->where($ow)->delete();
        $TPODB->where($ow)->delete();
        $CDB->where($ow)->delete();
    }
	public function activitys_preset()
    {
    	$aid = I('get.id');
		$uid = I('get.uid');
		$data = array(
			'aid'=>$aid,
			'uid'=>$uid,
			'atime'=>time()
		);
		M('preset')->data($data)->add();
		$this->success('操作成功');
	}
    /**
     * 订单管理
     */
    public function orders()
    {
        $p = I('get.p', 1, 'intval');
        $page = $this->page(500, 15);
        $data = $this->ordersDB->alias('o')
            ->join('left join __MEMBER__ m on m.userid=o.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=o.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=o.gid')
			// ->join('left join __PRESET__ ps on ps.uid=o.uid and ps.aid=o.aid')
			
            ->field('o.id,o.aid,o.atime,o.uid,o.deal,m.nickname,m.userid,g.name,a.money,a.status,a.section,a.gid')
            ->order('o.atime desc')
			->where('m.islock=0 and o.status=1')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
    }

    /**
     * 中奖管理
     */
    public function winning()
    {
        $p = I('get.p', 1, 'intval');
        $count = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->where('m.islock=0')
            ->count();
        $page = $this->page($count, 15, 0, array(
            'jump' => 'input'
        ));
        
        $data = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('m.islock, m.nickname,m.userid,g.name,a.money,w.status,a.section,c.codenumber,w.atime,w.id,w.isshows')
            ->order('w.status asc ,w.atime desc')
            ->where('m.islock=0 and (w.status=0 or w.status=1)')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign('robot', 0);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
    }
    /**
     * 中奖用户管理
     */
    public function winning_user()
    {
        $p = I('get.p', 1, 'intval');
        $userid = I('get.userid');

        $w['m.islock'] = 0;
        $w['m.userid'] = $userid;
        // $w['w.status'] = 0;
        $count = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->where($w)
            ->count();
        $page = $this->page($count, 20, 0, array(
            'jump' => 'input'
        ));
        
        $data = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('m.islock, m.nickname,m.userid,g.name,g.orgprice,a.money,w.status,a.section,c.codenumber,w.atime,w.id,w.isshows')
            ->order('w.atime desc')
            ->where($w)
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));

        $pw['uid'] = $userid;
        $pw['status'] = 1;
        $paynum = $this->pay_ordersDB->where($pw)->sum('deal');
        $this->assign('paynum', $paynum);

        $ow['uid'] = $userid;
        $ow['status'] = 1;
        $ordernum = $this->ordersDB->where($ow)->sum('deal');
        $this->assign('ordernum', $ordernum);

        $memberinfo = $this->memberDb->where('userid='.$userid)->find();
        $this->assign('memberinfo', $memberinfo);

        $master_memberinfo = $this->memberDb->where('userid='.$memberinfo['master_uid'])->find();
        $this->assign('master_memberinfo', $master_memberinfo['nickname']);
        $ww['w.uid'] = $userid;
        $ownum = $this->winningDB->alias('w')
                 ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
                 ->where($ww)
                 ->sum('g.orgprice');
        $this->assign('ownum', $ownum);

        $mnw['master_uid'] = $userid;
        $mnum = $this->memberDb->where($mnw)->count(1);
        $this->assign('mnum', $mnum);

        $this->display();
    }
    /**
     * 中奖管理
     */
    public function winning_send()
    {
        $id = I('get.id');
        $w['w.id'] = $id;
            
        $winning = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ADDRESS__ ad on ad.uid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('w.uid,m.nickname,m.username,ad.detail,ad.area,ad.name as addressname,ad.tel,a.section,a.money,g.name,c.codenumber, ad.alipay')
            ->where($w)
            ->find();
        if (IS_POST) {
            $data = array(
                'status' => 1,
                'sendnumber' => $sendnumber,
                'sendname' => $sendname
            );
            $wup['id'] = $id;
            $this->winningDB->where($wup)->save($data);


            //发送中奖短信
            $content = '您的第'.$winning['section'].'期'.$winning['name'].'已经发货.http://t.cn/RGNWfRE【1块夺宝】';
            $tel = M('duobao_address')->where('uid='.$winning['uid'])->getField('tel');
            sendSMS($tel, $content);     

            $this->success('发货成功', U('Manager/winning'));


        } else {
            
            $this->assign('winning', $winning);
            $this->display();
        }
    }
    public function winning_pl(){
        $ids = I('post.id');

        foreach ($ids as $key => $id) {
            $data['status'] = 1;
            $this->winningDB->where('id='.$id)->data($data)->save();
        }

        $ww['w.id'] = array('in',$ids);
        $data = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('w.uid,m.islock, m.nickname,m.userid,g.name,g.orgprice,a.money,w.status,a.section,c.codenumber,w.atime,w.id,w.isshows,m.username')
            ->where($ww)
            ->select();
        foreach ($data as $key => $value) {
            $content = '您的第'.$value['section'].'期'.$value['name'].'已经发货.http://t.cn/RGNWfRE【1块夺宝】';
            $tel = M('duobao_address')->where('uid='.$value['uid'])->getField('tel');
            sendSMS($tel, $content);   
        }
        


        $this->success("设置成功！");
    }
    /**
     * 晒单管理
     */
    public function shows()
    {
        $p = I('get.p', 1, 'intval');
        $count = $this->showsDB->count();
        $page = $this->page($count, 15);
        $data = $this->showsDB->alias('s')
            ->join('left join __MEMBER__ m on m.userid=s.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=s.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=s.gid')
            ->field('s.id,s.des,s.atime,s.status as s_status,s.photos,m.nickname,m.userid,g.name,a.money,a.status,a.section,m.islock')
            ->order('s.atime desc')
            ->where('g.single = 0')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
    }

    /**
     * 设置晒单状态管理
     */
    public function shows_status()
    {
        $id = I('get.id');
        $status = I('get.status');
        $w['Id'] = $id;
        $data['status'] = $status;
        $this->showsDB->where($w)
            ->data($data)
            ->save();
        if($status == 1){
                $shows = $this->showsDB->where($w)->find();

                $this->memberDb->where('userid='.$shows['uid'])->setInc('point',1);  
                $pointlog_data = array(
                 'uid'=>$shows['uid'],
                 'point'=>1,
                 'atime'=>time(),
                 'type'=>2
                 );
                M('point_log')->data($pointlog_data)->add();     
        }
        $this->success("设置成功！", U("Manager/shows"));
    }

    /**
     * 删除晒单
     */
    public function shows_del()
    {
        $id = I('get.id');
        $w['Id'] = $id;
        $this->showsDB->where($w)->delete();
        $this->success("删除成！", U("Manager/shows"));
    }
    
    // 生成兑换码
    private function addCodes($aid, $num)
    {
        M()->execute('call duobao_addcodes('.$num.','.$aid.')');

    }

    public function pay_orders()
    {
        $p = I('get.p', 1, 'intval');
        $count = $this->pay_ordersDB->count();
        $page = $this->page($count, 15);
        $data = $this->pay_ordersDB->alias('po')
            ->join('left join __MEMBER__ m on m.userid=po.uid')
            ->field('po.id,po.ch_id,po.order_no,m.nickname,po.amount,po.channel,po.atime,po.status,po.uid')
            ->order('po.atime desc')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $pow['channel'] = 'wx';
        $pow['status'] = 1;
        $wxcount = $this->pay_ordersDB->where($pow)->sum('deal');
        $pow['channel'] = 'alipay';
        $alipaycount = $this->pay_ordersDB->where($pow)->sum('deal');
        $aw['status'] = 1;
        $allcount = $this->pay_ordersDB->where($aw)->sum('deal');
        
        $this->assign('wxcount', $wxcount);
        $this->assign('alipaycount', $alipaycount);
        $this->assign('allcount', $allcount);
        
        $this->assign('data', $data);
        $this->assign("Page", $page->show('Admin'));
        $this->display();
    }

    /**
     * 机器人晒单
     */
    public function robot_share()
    {
        if (IS_POST) {
            foreach ($_POST['pic'] as $key => $val) {
                if (! empty($val)) {
                    $photo[] = $val;
                }
            }
            if (empty($_POST['des']) || count($photo) < 1) {
                $this->error('请填写晒单内容、上传至少一张至多五张图片');
                exit();
            }
            $atime = strtotime(I('post.atime'));
            if($atime == FALSE){
                 $atime = time();
            }
            $winning = $this->winningDB->where('id=' . $_POST['wid'])->find();
            $photos = implode('|', $photo);
            $data = array(
                'gid' => $winning['gid'],
                'aid' => $winning['aid'],
                'uid' => $winning['uid'],
                'wid' => $winning['id'],
                'des' => $_POST['des'],
                'photos' => $photos,
                'status' => 1,
                'atime' => $atime
            );
            if ($this->showsDB->add($data)) {
                $this->winningDB->where('id=' . $_POST['wid'])->setField('isshows', 1);
                $this->success('晒单成功', U('winning'));
            } else {
                $this->error('机器人晒单失败');
            }
        } else {
            $data = $this->winningDB->alias('w')
                ->join('left join __MEMBER__ m on m.userid=w.uid')
                ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
                ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
                ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
                ->field('m.islock, m.nickname,m.userid,g.name,a.money,w.status,a.section,c.codenumber,w.atime,w.id,w.isshows')
                ->where('w.id=' . $_GET['id'])
                ->find();
            $this->assign('winning', $data);
            $this->display();
        }
    }

    /**
     * 机器人中奖页面
     */
    public function robot_winning()
    {
        $p = I('get.p', 1, 'intval');
        $count = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->where('(m.islock=1 AND w.isshows=0)')
            ->count();
        $page = $this->page($count, 15, 0, array(
            'jump' => 'input'
        ));
        
        $data = $this->winningDB->alias('w')
            ->join('left join __MEMBER__ m on m.userid=w.uid')
            ->join('left join __DUOBAO_ACTIVITYS__ a on a.id=w.aid')
            ->join('left join __DUOBAO_GOODS__ g on g.id=w.gid')
            ->join('left join __DUOBAO_CODES__ c on c.id=w.cid')
            ->field('m.islock, m.nickname,m.userid,g.name,a.money,w.status,a.section,c.codenumber,w.atime,w.id,w.isshows')
            ->order('w.atime desc')
            ->where('(m.islock=1 AND w.isshows=0 AND g.single=0)')
            ->limit($page->firstRow . ',' . $page->listRows)
            ->select();
        $this->assign('data', $data);
        $this->assign('robot', 1);
        $this->assign("Page", $page->show('Admin'));
        $this->display('winning');
    }

    public function banner_list()
    {
        $banner = M('duobaoBanner')->select();
        $this->assign('banner', $banner);
        $this->display();
    }
   /*
    * 添加轮播
    * /
    public function banner_add()
    {
        if (IS_POST) {
            $data = I('post.');
            
            $rule = array(
                array(
                    'title',
                    'require',
                    '标题不能为空'
                ),
                array(
                    'type',
                    'require',
                    '类型不能为空'
                ),
                array(
                    'param',
                    'require',
                    '参数不能为空'
                )
            );
            $banner = M('duobaoBanner');
            
            if (! $banner->validate($rule)->create()) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($banner->getError());
            } else {
                $rows = $banner->add($data);
                $rows >= 0 ? $this->success('添加成功') : $this->error('非法操作');
            }
        } else {
            
            $this->display();
        }
    }

    /**
     * 修改轮播
     */
    public function banner_edit()
    {
        $model = D('duobaoBanner');
        if (IS_POST) {
            $data = I('post.');
            $rows = $model->where('id=' . $data['id'])->save($data);
            $rows >= 0 ? $this->success('修改成功', U('Manager/banner_list')) : $this->error('非法操作', U('Manager/banner_list'));
        } else {
            $_id = I('get.id', 0, 'intval');
            $data = $model->where('id=' . $_id)->find();
            $data['content'] = htmlspecialchars_decode($data['content']);
            $this->assign('one', $data);
            $this->assign('id', $_id);
            $this->display();
        }
    }

    /*
     * 删除轮播
     */
    public function banner_delete()
    {
        if (IS_GET) { // 删除一条
            $model = D('duobaoBanner');
            $_id = I('get.id', 0, 'intval');
            
            $row = $model->where('id=' . $_id)->delete();
            $rows >= 0 ? $this->success('删除成功', U('Manager/banner_list')) : $this->error('非法操作', U('Manager/banner_list'));
        } else
            $this->error('非法操作');
    }

    public function statistics(){
        $t = time();
        $start = I('get.start');
        $end = I('get.end');
        if($start){
            $start = strtotime($start);
        }else{
            $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
        }
        if($end){
            $end = strtotime($end);
        }else{
            $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
        }
        
        $timew = array(array('gt',$start),array('lt',$end));

        $plw['atime'] = $timew;

        $plw['type'] = 0;    //充值

        $data['paynum'] = $this->point_logDB->where($plw)->sum('point');
        $data['pnum'] = $this->point_logDB->where($plw)->count(1);
        $pay_user = $this->point_logDB->where($plw)->group('uid')->field('uid')->select();
        $data['puser'] = count($pay_user);
        $plw['type'] = 1;    //消费
        $data['ordernum'] = $this->point_logDB->where($plw)->sum('point');
        $data['onum'] = $this->point_logDB->where($plw)->count(1);
        $plw['type'] = 5;    //活动赠送
        $data['giftnum'] = $this->point_logDB->where($plw)->sum('point');

        $pay_w['status'] = 1;
        $pay_w['paytime'] = $timew;
        $pay_w['channel'] = array('like','ali%');
        $data['alipay'] = $this->pay_ordersDB->where($pay_w)->sum('deal');

        $pay_w['channel'] = 'wx';
        $data['wx'] = $this->pay_ordersDB->where($pay_w)->sum('deal');

        unset($pay_w['channel']);
        $nopay_w['status'] = 0;
        $nopay_w['atime'] = $timew;
        $data['nopay'] = $this->pay_ordersDB->where($nopay_w)->sum('deal');

        $ww['m.islock'] = 0;
        $ww['w.atime'] = $timew;
        $ww['g.id'] = array('not in','80');
        $data['winnum'] = $this->winningDB
                  ->alias('w')
                  ->join('left join __DUOBAO_GOODS__ g on w.gid=g.id')
                  ->join('left join __MEMBER__ m on w.uid=m.userid')
                  ->where($ww)
                  ->sum('g.orgprice');
        $mw['islock'] = 0;
        $mw['regdate'] = $timew;
        $data['regnum'] = $this->memberDb->where($mw)->count('userid');

        $pw['islock'] = 0;
        $data['allpoint'] = $this->memberDb->where($pw)->sum('point');

        
        $mwl['type'] = 1;
        $mwl['atime'] = $timew;
        $app_data = M('member_login')->group('userclient')->where($mwl)->field('userclient,count(1) as c')->select();
        $this->assign('data', $data);
        
        $this->assign('app_data', $app_data);
        $this->display();
    }
 public function statistics_goods(){
    //开启商品排行
        $t = time();
        $start = I('get.start');
        $end = I('get.end');
        if($start){
            $start = strtotime($start);
        }else{
            $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
        }
        if($end){
            $end = strtotime($end);
        }else{
            $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
        }
        $timew = array(array('gt',$start),array('lt',$end));

        $goods_data = $this->goodsDB->where('putstatus=1')->field('id,name,hot')->select();

        foreach ($goods_data as $key => $value) {


            $g_ow['o.gid'] =  $value['id'];
            $g_ow['m.islock'] =  0;
            $g_ow['o.atime'] =  $timew;
            $goods_data[$key]['order'] = $this->ordersDB
                                         ->alias('o')
                                         ->join('left join __MEMBER__ m on o.uid=m.userid')
                                         ->where($g_ow)
                                         ->sum('o.deal');
            // $goods_data[$key]['oc'] = $this->ordersDB
            //                              ->alias('o')
            //                              ->join('left join __MEMBER__ m on o.uid=m.userid')
            //                              ->where($g_ow)
            //                              ->count(1);

            // $g_aw['gid'] =  $value['id'];
            // $g_aw['atime'] =  $timew;
            // $goods_data[$key]['start'] = $this->activitysDB
            //                              ->where($g_aw)
            //                              ->count(1);


            // $g_ww['w.gid'] =  $value['id'];
            // $g_ww['m.islock'] =  0;
            // $g_ww['w.atime'] =  $timew;
            // $goods_data[$key]['win'] = $this->winningDB
            //                              ->alias('w')
            //                              ->join('left join __MEMBER__ m on w.uid=m.userid')
            //                              ->where($g_ww)
            //                              ->count(1);



        }
        die(json_encode($goods_data));
 }
 public function statistics_charts(){
    $this->display();
 }
 public function charts(){
    $day = I('get.day',7,'intval');
    $login_data = M('member')
            ->group('days')
            ->order('days desc')
            ->field("FROM_UNIXTIME(regdate,'%Y-%m-%d') days,COUNT(userid) c")
            ->where('islock=0')
            ->limit(7)
            ->select();

    $pay_data = $this->pay_ordersDB
                    ->group('days')
                    ->order('days desc')
                    ->field("FROM_UNIXTIME(atime,'%Y-%m-%d') days,sum(deal) d")
                    ->where('status = 1')
                    ->limit($day)
                    ->select();

    $days = array ();
    for($i=0;$i<$day;$i++)
    {
        $days[] = date("Y-m-d", strtotime('-'. $i . 'day'));
    }
    sort($days);
    foreach ($days as $key => $value) {
        $data['days'][] = $value;

        $reg = 0;
        foreach ($login_data as $k => $v) {
            if($value == $v['days']){
                $reg = $v['c'];
            }
        }
        
        $data['reg'][] = $reg;
        
        $pay = 0;
        foreach ($pay_data as $k => $v) {
            if($value == $v['days']){
                $pay = $v['d'];
            }
        }
        
        $data['pay'][] = $pay;

    }
    die(json_encode($data));
 }
 public function changeDeal($arr)
    {
        $count = count($arr);
        
        if ($count <= 0) {
            return false;
        }
        
        for ($i = 0; $i < $count; $i ++) {
            
            for ($k = $count - 1; $k > $i; $k --) {
                
                if ($arr[$k][1] >= $arr[$k - 1][1]) {
                    $tmp = $arr[$k];
                    $arr[$k] = $arr[$k - 1];
                    $arr[$k - 1] = $tmp;
                }
            }
        }
        return $arr;
    }

public function changeGoods($arr)
    {
        $count = count($arr);
        
        if ($count <= 0) {
            return false;
        }
        
        for ($i = 0; $i < $count; $i ++) {
            
            for ($k = $count - 1; $k > $i; $k --) {
                
                if ($arr[$k]['deal'] >= $arr[$k - 1]['deal']) {
                    $tmp = $arr[$k];
                    $arr[$k] = $arr[$k - 1];
                    $arr[$k - 1] = $tmp;
                }
            }
        }
        return $arr;
    }

 public function getColor($len)
    {
        $colorStr = '[';
        $colorList = array(
            '#AF0202',
            '#EC7A00',
            '#FCD200',
            '#AF0365',
            '#EC9401',
            '#FC0354'
        );
        
        for ($i = 0; $i < $len; $i ++) {
            $colorStr .= "'";
            $colorStr .= $colorList[rand(0, count($colorList) - 1)];
            $colorStr .= "'";
            $colorStr .= ',';
            // $colorStr
        }
        $colorStr = substr($colorStr, 0, strlen($colorStr) - 1);
        
        $colorStr .= ']';
        return $colorStr;
    }

 public function getNewArr($arr)
    {
        $i = 0;
        foreach ($arr as $key => $value) {
            $newArr[$i][0] = $key;
            $newArr[$i][1] = $value;
            $i ++;
        }
        
        return $newArr;
    }



public function getZero(){
    $y = date("Y");
    $m = date("m");
    $d = date("d");

    return $todayTime= mktime(0,0,0,$m,$d,$y);
}


public function delive($arr,$str1,$str2,$str3){

    if (! empty($arr)) {
        $val1 = substr(json_encode($arr), 1, strlen(json_encode($arr)) - 2);
        $val2 = $this->getColor(count($arr));
        if (count($arr)<=12) {
                $val3 = 600;
        }else{
            $val3 = (intval(count($arr)/12)+1)*600;
        }
            
    
    
    $this->assign("$str2",$val2);
    $this->assign("$str3",$val3);
    }else{
       $this->assign("$str3",600);
    }
    $this->assign("$str1",$val1);
}

}