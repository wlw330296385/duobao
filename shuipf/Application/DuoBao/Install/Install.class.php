<?php
namespace DuoBao\Install;//这里的Search是你模块的目录名称，这点很重要
use Libs\System\InstallBase;
class Install extends InstallBase {
    //安装前进行处理
    public function run() {
        return true;
    }
    //基本安装结束后的回调
    public function end() {
        return true;
    }
}