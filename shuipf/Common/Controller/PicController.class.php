<?php
namespace Common\Controller;

use Think\Controller;
import('OSS.sdk');

class PicController extends Controller
{

    /**
     * 上传图片到OSS
     *
     * @param $input 上传表单file类型的name            
     * @param $folder 保存到哪个文件夹
     *            默认'yuena/'
     * @param $bucket 保存到哪个bucket
     *            默认'filesrv'
     */
    public function picUpload($input, $folder = 'duobao_user_avt/', $bucket = 'filesrv')
    {
        $ret['status'] = 0;
        // 是否是上传文件
        if (! is_uploaded_file($_FILES[$input]['tmp_name'])) {
            $ret['errMsg'] = '不是上传文件';
            return json_encode($ret);
        }
        $oss_sdk_service = new \ALIOSS();
        $imgArr = getimagesize($_FILES[$input]['tmp_name']);
        $object = $folder . date('Y-m-d') . '/' . genRandomString(10);
        // 第三个元素 (索引值 2) 是图片的文件格式，其值 1 为 GIF 格式、 2 为 JPEG/JPG 格式、3 为 PNG 格式。
        switch (intval($imgArr[2])) {
            case 1:
                $object .= '.gif';
                break;
            case 2:
                $object .= '.jpg';
                break;
            case 3:
                $object .= '.png';
                break;
            default:
                $ret['errMsg'] = '请上传图片';
                return json_encode($ret);
        }
        
        // 文件大小、内容
        $content = '';
        $length = 0;
        $fp = fopen($_FILES[$input]["tmp_name"], 'r');
        if ($fp) {
            $f = fstat($fp);
            $length = $f['size'];
            while (! feof($fp)) {
                $content .= fgets($fp, 8192);
            }
        }
        // 上传文件选项
        $upload_file_options = array(
            'content' => $content,
            'length' => $length
        );
        // 上传
        $response = $oss_sdk_service->upload_file_by_content($bucket, $object, $upload_file_options);
        
        // 上传结果
        if ($response->isOk()) {
            $ret['status'] = 1;
            $ret['errMsg'] = '上传成功';
            $ret['objUrl'] = 'http://img.nntzd.com/' . $object;
        } else {
            $ret['errMsg'] = '上传失败';
        }
        return json_encode($ret);
    }
}