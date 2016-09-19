<?php
namespace DuoBao\Controller;

use Common\Controller\Base;
import('Vendor.wxpay.JsApiPay');
import('Vendor.wxpay.Notify');
class WxPayController extends Base {
	
	protected $ordersDB;
	protected $activitysDB;
	protected $codesDB;
	protected $winningDB;
	protected $goodsDB;
	protected $openid = null;
	function _initialize() {
		parent::_initialize ();
		$this->ordersDB = M('duobao_orders');
		$this->activitysDB = M('duobao_activitys');
		$this->codesDB = M('duobao_codes');
		$this->goodsDB = M('duobao_goods');
		$this->goodsPicDB = M('duobao_goods_pic');
		$this->winningDB = M('duobao_winning');
		header("Access-Control-Allow-Origin:*");
	}

	public function index(){
		// $this->openId = 'obTr8t2nyxiE77QqJ_rPweL5WYfU';
		$this->openId = session('openid');
		if(empty($this->openId)){
			die(400001);
		}
		$aid = I('get.aid',0);
		if($aid == 0){
			die(410001);
		}
    	$total = I('get.total',1);
    	if($total<1){
    		$total = 1;
    	}
    	$total = round($total*100);
    	$tools = new \JsApiPay();
    	$input = new \WxPayUnifiedOrder();
		$input->SetBody("1块夺宝");

		//所购买商品ID，IP信息
		$attach['aid'] = $aid;
		$attach['ip'] = get_client_ip(0, true);
		$input->SetAttach(implode(',',$attach));
		$input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee($total);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("1块夺宝");
		$input->SetNotify_url("http://duobao.nntzd.com/wxpay/notify/");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($this->openId);
		$order = \WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		die($jsApiParameters);
	}
	
	public function notify(){
		$notify = new PayNotifyCallBack();
		$notify->Handle(false);
	}
}

class PayNotifyCallBack extends \WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new \WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = \WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	
	//重写回调处理函数
	public function NotifyProcess($data, &$msg)
	{
		$notfiyOutput = array();
		
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		$mw['username'] = $data["openid"];
		$mw['modelid'] = 3;
		$userid = M('member')->where($mw)->getField('userid');
		$attach = explode(',',$data['attach']);
		$aid = $attach[0];
		$gid = M('duobao_activitys')->where('id='.$aid)->getField('gid');
		$ip = $attach[1];
		$deal = $data['total_fee']/100;
		//增加pay_orders
		$payData = array (
				'uid' => $userid,
				'ch_id' => $data['transaction_id'],
				'aid'=>$aid,
				'deal' => $deal,
				'order_no' => $data['out_trade_no'],    //商户订单号
				'amount' => $data['total_fee'],     //订单总金额
				'channel' => 'wxpay',					//支付使用的第三方支付渠道
				'currency' => $data['fee_type'],				//三位 ISO 货币代码，目前仅支持人民币 cny
				'client_ip' => $ip,	//发起支付请求终端的 IP 地址
				'subject' => 'duobao',				//商品的标题
				'body' => 'duobao',					//商品的描述
				'atime' => time(),
				'paytime' => time(),
				'status'=>1
		);
		$po_ins_id = M('duobao_pay_orders')->data($payData)->add();

		//增加用户积分
		M('member')->where('userid='.$userid)->setInc('point',$deal);
		//生成订单AddOrder
		$order_no = $data['out_trade_no'];
		$order = array(
			'aid'=>$aid,
			'gid'=>$gid,
			'deal'=>$deal,
			'money'=>$deal,
			'ordernumber'=>$order_no,
			'uid'=>$userid
		);
		$Pay = A('Pay');
		$Pay->addOrder($order);
		return true;
	}
}
