<?php
namespace Api\Controller;

use Think\Controller;

class GoodsController extends Controller
{

    public function index()
    {
        $this->assign('detail', M('duobao_goods')->where('id=' . I('get.id', 0, 'intval'))
            ->getField('detail'));
        $this->display();
    }
}