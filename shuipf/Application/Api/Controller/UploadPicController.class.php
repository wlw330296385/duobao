<?php
namespace Api\Controller;

use Think\Controller;

class UploadPicController extends Controller
{

    public function upload_pic()
    {
        if ($_FILES['pic']) {
            $pic = new \Common\Controller\PicController();
            $retData = json_decode($pic->picUpload('pic'));
            
            if ($retData->status) {
                $ret = array(
                    'status' => 1,
                    'path' => $retData->objUrl
                );
                die(json_encode($ret));
            }
        }else{
            die(json_encode(array('status'=>0, 'errMsg'=>'请上传头像')));
        }
    }
}