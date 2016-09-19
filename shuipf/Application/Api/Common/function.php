<?php
	//返回计算时间戳
	function getTimestamp($utimestamp) {
       $timestamp = substr($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return date('His',$timestamp).$m;
	}
	//返回毫秒时间戳
	function getMillisecond() {
		list($t1, $t2) = explode(' ', microtime());
		return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}
	//全格式
	function getDateF($utimestamp) {
       $timestamp = substr($utimestamp,0,10);
       $m = substr($utimestamp,10,13);
       return date('Y-m-d H:i:s',$timestamp).'.'.$m;
    }

    function genRandInt($len = 4) {
	    $chars = array(
	        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
	    );
	    $charsLen = count($chars) - 1;
	    // 将数组打乱 
	    shuffle($chars);
	    $output = "";
	    for ($i = 0; $i < $len; $i++) {
	        $output .= $chars[mt_rand(0, $charsLen)];
	    }
	    return $output;
	}
	 