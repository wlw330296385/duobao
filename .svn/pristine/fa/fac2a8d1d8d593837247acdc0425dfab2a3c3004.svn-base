<?php
namespace Api\Controller;

use Think\Controller;

class GonggaoController extends Controller
{

    public function index()
    {
        $this->assign('content', M('home_annouce')->where('id=' . I('get.id', 0, 'intval'))
            ->getField('content'));
        $this->display();
    }
}