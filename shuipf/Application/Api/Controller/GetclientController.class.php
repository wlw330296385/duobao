<?php
namespace Api\Controller;

use Think\Controller;

class GetclientController extends Controller
{
    protected $appid     = 'wxf1d79112b87ce476';
    protected $appsecret = 'b43661c51fdc2522bb6b8aa5f5f8320e';
    protected $access_token; //基础支持的token
    protected $code;

    public function _initialize()
    {
        header("Access-Control-Allow-Origin:*");
    }

    public function index()
    {
        header('location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this->appid . '&redirect_uri=' . urlencode("http://duobao.nntzd.com/index.php?g=Api&m=Getclient&a=getInfo") . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
    }

    public function getInfo()
    {
        $code = I('get.code'); //获取用户授权code

        $oauth_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $web_token = $this->httpGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->appsecret . '&code=' . $code . '&grant_type=authorization_code');
        $web_token = json_decode($web_token, true);

        $web_access = $web_token['access_token']; //获取网页授权的access_token

        $openid = $web_token['openid']; //获取微信用户唯一标识符

        if (!$openid) {
            die('Unexpected error');
        }
        $one = M('member')->field('encrypt,username,userpic,nickname')->where('username=' . "'" . $openid. "'")->find();
        if (empty($one)) {

            $info      = $this->httpGet('https://api.weixin.qq.com/sns/userinfo?access_token=' . $web_access . '&openid=' . $openid . '&lang=zh_CN');
            $user_info = json_decode($info, true); //微信用户基本信息

            if ($user_info['openid']) {
//保存用户信息到数据库
                $add = array(
                    'username' => $user_info['openid'],
                    'password' => md5($this->createEncrypt(rand(6, 10))),
                    'encrypt'  => $encrypt = $this->createEncrypt(6),
                    'about'    => '',
                    'theme'    => '',
                    'islock'   => 0,
                    'modelid'  => 3,
                    'point'  => 1,
                    'nickname' => $nickname = $user_info['nickname'],
                    'userpic'  => $user_info['headimgurl'],
                    'regdate'  => time(),
                    'lastdate' => time(),
                    'regip'    => $this->getClientIP(),
                    'lastip'   => $this->getClientIP(),
                    'email'    => 'wx_'.$user_info['openid']. '@nntzd.com',
                    'pro_code' => $this->createEncrypt(6, 9),
                    'checked'  => 1,
                    'loginnum' => 1
                );
                $rows                   = M('member')->add($add);
                $_SESSION['uopenid']    = substr($user_info['openid'], 8, 13);
                $_SESSION['headimgurl'] = $user_info['headimgurl'];
                $_SESSION['encrypt']    = $encrypt; 
                $pointlog_data = array(
                    'uid'=>$rows,
                    'point'=>1,
                    'atime'=>time(),
                    'type'=>5
                    );
                M('point_log')->data($pointlog_data)->add();
            } else {
                // header('location:'.$oauth_url);
            }
        } else {
            
            $loginnum = M('member')->where('username=' . "'" . $openid . "'")->getField('loginnum');

            $data['lastip'] = $this->getClientIP();
            $data['lastdate'] = time();
            $data['loginnum'] = $loginnum+1;

            M('member')->where('username=' . "'" . $openid . "'")->data($data)->save();

            $username               = $one['username'];
            $encrypt                = $one['encrypt'];
            $userpic                = $one['userpic'];
            $nickname               = $one['nickname'];

        }

        $profileUrl = 'http://duobao.nntzd.com/wx/user/user.html' . '?encrypt=' . $encrypt . '&openid=' . $openid;

        header('location:' . $profileUrl);

    }

    public function checkOpenid() //检测openid是否存在，即是否已经为注册用户

    {
        // var_dump($_SESSION);exit;
        if (!empty($_SESSION['uopenid'])) {
            $res['status']   = 1;
            $arr             = M('member')->field('encrypt,nickname,userpic')->where('username=' . "'" . $_SESSION['uopenid'] . "'")->find();
            $res['encrypt']  = $arr['encrypt'];
            $res['nickname'] = $arr['nickname'];
            $res['openid']   = $_SESSION['uopenid'];
        } else {
            $res['status'] = 0;
        }
        die(json_encode($res));
    }

    public function getAll()
    {
        $openid = I('get.openid');
        $encrypt = I('get.encrypt');

        if (empty($openid)) {
            die(json_encode(array('status' => -1, 'state' => 'openid not found')));
        }
        if (empty($encrypt)) {
            die(json_encode(array('status' => -1, 'state' => 'encrypt not found')));
        }

        $map['username'] = array('eq', $openid);
        $map['encrypt'] = array('eq', $encrypt);

        $info = M('member')
            ->where($map)
            ->find();

        if (empty($info)) {
            die(json_encode(array('status' => -99, 'state' => 'user not found')));
        }
        die(json_encode($info));
    }

    public function signPackage()
    {
        $jssdk       = new JSSDK('wxf1d79112b87ce476', 'b43661c51fdc2522bb6b8aa5f5f8320e');
        $signPackage = $jssdk->GetSignPackage();
        die(json_encode($signPackage));
    }

    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    public function getClientIP() //获取微信用户ip

    {
        global $ip;
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "Unknow";
        }

        return $ip;
    }

    public function createEncrypt($len, $count = '')
    {
        $str = '';
        $arr = array(
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g',
            'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E',
            'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
            'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
        );
        $num = empty($count) ? count($arr) : $count;
        for ($i = 0; $i < $len; $i++) {
            $str .= $arr[rand(0, $num)];
        }
        return $str;
    }

}
