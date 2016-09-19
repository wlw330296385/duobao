<?php
namespace DuoBao\Uninstall;//这里的Search也是和目录名一样
use Libs\System\UninstallBase;
class Uninstall extends UninstallBase {
    //卸载开始执行
    public function run() {
        return true;
    }
    //卸载完回调
    public function end() {
        return true;
    }
}