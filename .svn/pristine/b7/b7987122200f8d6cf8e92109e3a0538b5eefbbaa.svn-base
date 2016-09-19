<?php
namespace Ip;

class IP
{

    public static function getRandIp($num)
    {
        $ip_long = array(
            array(
                '607649792',
                '608174079'
            ),
            array(
                '1038614528',
                '1039007743'
            ),
            array(
                '1783627776',
                '1784676351'
            ),
            array(
                '2035023872',
                '2035154943'
            ),
            array(
                '2078801920',
                '2079064063'
            ),
            array(
                '-1950089216',
                '-1948778497'
            ),
            array(
                '-1425539072',
                '-1425014785'
            ),
            array(
                '-1236271104',
                '-1235419137'
            ),
            array(
                '-770113536',
                '-768606209'
            ),
            array(
                '-569376768',
                '-564133889'
            )
        );
        for ($i = 0; $i < $num; $i ++) {
            $rand_key = mt_rand(0, 9);
            $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
            $ips[] = $ip;
        }
        return $ips;
    }
}