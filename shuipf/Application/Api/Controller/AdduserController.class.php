<?php

namespace Api\Controller;

use Think\Controller;

class AdduserController extends Controller
{
    public function add()
    {
    	if(get_client_ip(0, true) != '121.41.86.132'){
            echo 'error';
            exit;
        }
        $data = M('new_member3')->limit(3000)->select();
        if (!empty($data)) {
            foreach ($data as $row) {
                $ids[] = $row['userid'];
            }
            $c   = count($data);
            $ips = \Ip\IP::getRandIp($c);
            $tn  = time();
            foreach ($data as $key => $value) {
                $user = array(
                    'username'    => genRandomString(11),
                    'password'    => genRandomString(32),
                    'encrypt'     => genRandomString(6),
                    'checked'     => 0,
                    'sex'         => 0,
                    'about'       => '',
                    'heat'        => 0,
                    'theme'       => '',
                    'praise'      => 0,
                    'attention'   => 0,
                    'fans'        => 0,
                    'share'       => 0,
                    'nickname'    => $value['nickname'],
                    'userpic'     => $value['userpic'],
                    'regdate'     => $tn,
                    'lastdate'    => $tn,
                    'regip'       => $ips[$key],
                    'lastip'      => $ips[$key],
                    'loginnum'    => 1,
                    'email'       => 'rb_' . genRandomString(11) . '@nntzd.com',
                    'groupid'     => 0,
                    'areaid'      => 0,
                    'amount'      => 0.00,
                    'point'       => 0,
                    'modelid'     => 1,
                    'message'     => 0,
                    'islock'      => 1,
                    'vip'         => 0,
                    'overduedate' => 0,
                    'pro_code'    => '',
                    'credit'      => 0,
                    'master_uid'  => 0
                );
                $users[] = $user;
            }
            $rs = M('member')->addAll($users);
            if ($rs !== false) {
                $cond['userid'] = array('in', $ids);
                dump(M('new_member3')->where($cond)->delete());
            }
        }
    }
}
