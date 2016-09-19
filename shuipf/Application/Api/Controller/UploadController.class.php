<?php

namespace Api\Controller;

use Think\Controller;

class UploadController extends Controller
{
    public function uploadMusic()
    {
    	$upload = new \Vendor\Upload('uploadFile');
    	$res = $upload->ossUpload();
    	if($res['status'] == 1){
    		$ret = array('state'=>'SUCCESS', 'objUrl'=>$res['objUrl']);
    	}else{
    		$ret = array('state'=>'FAIL', 'msg'=>$res['errMsg']);
    	}
		die(json_encode($ret));
    }

    public function uploadPic(){
        $upload = new \Vendor\Upload('upload', 'pic/');
        $res = $upload->ossUploadPic();
        if($res['status'] == 1){
            $ret = array('state'=>'SUCCESS', 'objUrl'=>$res['objUrl']);
        }else{
            $ret = array('state'=>'FAIL', 'msg'=>$res['errMsg']);
        }
        die(json_encode($ret));
    }
}
