<?php
namespace DuoBao\Controller;

use Common\Controller\Base;
import('OSS.sdk');

class UploadController extends Base
{

    protected function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 上传图片
     */
    public function index($str = 'upload')
    {
        $ufile = $this->upload_to_oss($str);
        if ($str == 'upfilesss') {
            return $ufile;
        } else {
            die(json_encode($ufile));
        }
    }

    /**
     * 上传图片到阿里云oss
     * 
     * @param string $input_name
     *            input_file的名称
     * @param string $folder
     *            要保存到的字符串
     * @return unknown $path 绝对路径
     */
    private function upload_to_oss(string $input_name, $folder = 'sys', $bucket = 'filesrv')
    {
        $oss_sdk_service = new \ALIOSS();
        $type_arr = explode('.', $_FILES[$input_name]['name']);
        $type = $type_arr[1];
        $filename = $this->get_rand_str(10) . '.' . $type;
        $path = 'duobao/' . $folder . '/' . date('Y-m-d') . '/' . $filename;
        
        // if ( $_FILES [$input_name] ["type"] == "image/png"
        // || $_FILES [$input_name] ["type"] == "image/jpeg"
        // || $_FILES [$input_name] ["type"] == "image/pjpeg"
        // || $_FILES [$input_name] ["type"] == "image/gif" ) {
        // 文件上传错误码
        if ($_FILES[$input_name]["error"] > 0) {
            $value = array(
                'info' => 'files error code:' . $_FILES[$input_name]["error"],
                'status' => 0,
                'error_code' => - 206
            );
            die(json_encode($value));
            
            // 开始上传到oss
        } else {
            $content = '';
            $length = 0;
            $fp = fopen($_FILES[$input_name]["tmp_name"], 'r');
            if ($fp) {
                $f = fstat($fp);
                $length = $f['size'];
                while (! feof($fp)) {
                    $content .= fgets($fp, 8192);
                }
            }
            $upload_file_options = array(
                'content' => $content,
                'length' => $length
            );
            $response = $upload_file_by_content = $oss_sdk_service->upload_file_by_content($bucket, $path, $upload_file_options);
            if ($response->isOk()) {
                $value['status'] = 1;
                $value['path'] = C('img_domain') . $path;
            }
        }
        // } else {
        // $value = array (
        // 'info' => 'wrong image type',
        // 'status' => 0,
        // 'error_code' => -204
        // );
        // }
        return $value;
    }

    /**
     * 返回随机十个字符的字符串
     * 
     * @param int $len            
     * @return string $output
     */
    private function get_rand_str($len)
    {
        $chars = array(
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "0"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);
        $output = "";
        for ($i = 0; $i < $len; $i ++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }
}
