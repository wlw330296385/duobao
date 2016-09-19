<?php
namespace Vendor;

class Upload {

    private $inputName = '';

    private $category = '';

    public function __construct($inptName, $category = 'audio/') {
        $this->inputName = $inptName;
        $this->category = $category;
    }

    public function ossUpload() {
        if ($_FILES[$this->inputName]['tmp_name']) {
            $ossClient = new \OSS\OssClient('qHpg6MyqrVHao0nX', 'vJ4neZYfFcPITtawuhc0r13Mr6pub4', 'oss-cn-hangzhou.aliyuncs.com');
            $bucket = 'filesrv';
            $object = 'and_nntzd_com/' . $this->category . date('Y-m-d') . '/';
            $filePath = $_FILES[$this->inputName]['tmp_name'];
            // 获取文件后缀
            // $finfo = finfo_open(FILEINFO_MIME);
            // $mimetype = finfo_file($finfo, $_FILES[$this->inputName]['tmp_name']);
            // finfo_close($finfo);
            // if (stripos($mimetype, 'audio') === false) {
            //     $res = array(
            //         'status' => -1,
            //         'errMsg' => 'error audio type',
            //     );
            //     return $res;
            // }
            $suffix = pathinfo($_FILES[$this->inputName]['name'], PATHINFO_EXTENSION);
            $object .= genRandomString(10) . '.' . $suffix;
            try {
                $ossClient->uploadFile($bucket, $object, $filePath);
            } catch (\OSS\Core\OssException $e) {
                $res = array(
                    'status' => -1,
                    'errMsg' => 'upload failed'
                );
                return $res;
            }
            $res = array(
                'status' => 1,
                'objUrl' => 'http://img1.nntzd.com/' . $object
            );
            return $res;
        } else {
            $res = array(
                'status' => 0,
                'objUrl' => '没有上传文件'
            );
        }
    }

    public function ossUploadPic() {

        if ($_FILES[$this->inputName]['tmp_name']) {
            $ossClient = new \OSS\OssClient('qHpg6MyqrVHao0nX', 'vJ4neZYfFcPITtawuhc0r13Mr6pub4', 'oss-cn-hangzhou.aliyuncs.com');
            $bucket = 'filesrv';
            $object = 'and_nntzd_com/' . $this->category . date('Y-m-d') . '/';
            $filePath = $_FILES[$this->inputName]['tmp_name'];
            $suffix = pathinfo($_FILES[$this->inputName]['name'], PATHINFO_EXTENSION);
            $object .= genRandomString(10) . '.' . $suffix;
            try {
                $ossClient->uploadFile($bucket, $object, $filePath);
            } catch (\OSS\Core\OssException $e) {
                $res = array(
                    'status' => -1,
                    'errMsg' => 'upload failed'
                );
                return $res;
            }
            $res = array(
                'status' => 1,
                'objUrl' => 'http://img1.nntzd.com/' . $object
            );
            return $res;
        } else {
            $res = array(
                'status' => 0,
                'objUrl' => '没有上传文件'
            );
        }

    }
}
