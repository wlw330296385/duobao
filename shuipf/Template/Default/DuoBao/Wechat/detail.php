<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,user-scalable=no" />
	<title>{$data.goods.name}</title>
	<meta name="format-detection" content="telephone=no"/>
	<link rel="stylesheet" type="text/css" href="/statics/css/wechat_detail.css">
	<link href="//cdn.bootcss.com/Swiper/3.3.1/css/swiper.min.css" rel="stylesheet">
	
</head>
<body>
	<div id="about"><a href="http://mp.weixin.qq.com/s?__biz=MzA4Njc2MDU1Nw==&mid=503027130&idx=1&sn=3cc5a6adbfa8d987d2dd243321e35101#rd">点击关注公众号抢更多商品</a></div>
	<div class="swiper-container">
	    <div class="swiper-wrapper">
	    	<volist name="data.goods_pics" id="vo">
	        <div class="swiper-slide"><img src="{$vo.path}" width="100%"></div>
	        </volist>
	    </div>
	    <div class="swiper-pagination"></div>	 
	</div>
	<div id="info">
		<div class="box_p15">
			<div id="name"><span class="pstatus">进行中</span>{$data.goods.name}</div>
			<div>
				<div>第 {$data.new_activity.section} 期</div>
				<div id="pressbox">
					<div id="press" style="width:{$data.new_activity.press}%; "></div>
				</div>
				<div>总需{$data.new_activity.money}人次
				<span style="float: right;" id="surplus">剩余{$data.new_activity.surplus}</span></div>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="btn_group">
		<ul>
			<li><a href="{:U('content',array('id'=>$data['goods']['id']))}">图文详情<small>( 建议在wifi下查看 )</small></a></li>
			<li><a href="{:U('APP/winningList',array('gid'=>$data['goods']['id']))}">往期揭晓</a></li>
			<li><a href="{:U('APP/showsList',array('gid'=>$data['goods']['id']))}">晒单分享</a></li>
		</ul>
	</div>
	<div class="line"></div>
	<div id="order_list">
		<h3>所有参与记录 <a href="http://mp.weixin.qq.com/s?__biz=MzA4Njc2MDU1Nw==&mid=402050349&idx=1&sn=f27904bb69b62f5f4a0df659dec871b5#rd" style="float: right; font-size: 12px; color: #999; text-decoration:underline;">夺宝规则？</a></h3>
		<div>
			<ul id="olists"></ul>
			<div id="load_more">点击加载更多</div>
		</div>
		<script id="tpl" type="text/html">
		<ul>
		    <%for(var i = 0; i < list.length; i++) {%>
		    <li data-time="<%:=list[i].atime%>" class="<%:=list[i].new%>">
		    <img src="<%:=list[i].userpic%>" style="float: left;">
		    <div class="nt1"><span class="oname"><%:=list[i].nickname%></span> (<%:=list[i].ip%>)</div>
		    <div>参与了<span class="odeal"> <%:=list[i].deal%> </span>次 <span class="otime"><%:=list[i].adate%></span></div>
		    <div class="cl"></div>
		    </li>
		    <%}%>
		</ul>
		</script>
	</div>
	<div style="height: 68px"></div>
	<div id="want_bottom">
		<a href="javascript:;" id="btn_want" class="btn_red">1块参与</a>
	</div>
	<div id="gotobuy">
		
	</div>
	<div id="buybox">
		<div class="tit">参与人次</div>
		<input type="number" id="amount" value="10"  size="10" style="ime-mode:disabled; text-align: center; padding: 8px 0" onKeyUp="this.value=this.value.replace(/[^\.\d]/g,'');this.value=this.value.replace('.','');" />
		<div id="fast_money">
			<span data-amount="20">20</span>
			<span data-amount="30">30</span>
			<span data-amount="50">50</span>
			<span data-amount="100">100</span>
		</div>
		<div><a id="btn_order" href="javascript:;" class="btn_red">开始夺宝</a></div>
	</div>
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		var config  = {
	        appId: '{$js_sign["appId"]}',
	        timestamp: '{$js_sign["timestamp"]}',
	        nonceStr: '{$js_sign["nonceStr"]}',
	        signature: '{$js_sign["signature"]}',
	        jsApiList: [
	            'checkJsApi',
	            'onMenuShareTimeline',
	            'onMenuShareAppMessage',
	            'onMenuShareQQ',
	            'onMenuShareWeibo',
	            'chooseWXPay'
	        ]
	    };
	    wx.config(config);
	    var shareData = {
	        title: '1块钱抢到{$data.goods.name}！！', // 分享标题
	        link: 'http://duobao.nntzd.com/shop/gid/{$data.goods.id}?openid={$Think.session.openid}', // 分享链接
	        imgUrl: '{$data.goods.thumb}',
	        desc: '快来和我一起夺宝！{$data.goods.name}，真的是1块钱就抢到！！',
	        fail: function(res) {
	            alert('share:'+JSON.stringify(res));
	        }
	    };
	    wx.ready(function() {
	        wx.onMenuShareAppMessage(shareData);
	        wx.onMenuShareTimeline(shareData);
	        wx.onMenuShareQQ(shareData);
	        wx.onMenuShareWeibo(shareData);
	    });

	    wx.error(function(res) {
	        alert('error:'+JSON.stringify(res))
	    });
	</script>

	<script type="text/javascript" src="http://apps.bdimg.com/libs/zepto/1.1.4/zepto.min.js"></script>
	<script src="//cdn.bootcss.com/Swiper/3.3.1/js/swiper.min.js"></script>
	<script src="//cdn.bootcss.com/template_js/0.7.1/template.min.js"></script>
	<script type="text/javascript">
		var p = 1,aid={$data.new_activity.id};
		var mySwiper = new Swiper ('.swiper-container', {
		    pagination: '.swiper-pagination'
		});      
		function wxPay(){
			var total = $('#amount').val()<=0?1:$('#amount').val();
			$.getJSON("/wxpay/",{aid:aid,total:total},function(data){
				if(data == 400001){
					alert
				}
				wx.chooseWXPay({
				    timestamp: data.timeStamp, 
				    nonceStr: data.nonceStr, 
				    package: data.package,
				    signType: 'MD5',
				    paySign:  data.paySign, 
				    success: function (res) {
				        // 支付成功后的回调函数
				    }
				});
			})
		}
		function getOrderList(){
			$.getJSON("{:U('Index/getOrdersList')}",{aid:aid,p:p},function(data) {
				if(data){
					var tpl = document.getElementById('tpl').innerHTML;
					var html = template(tpl, {list:data});
					$('#olists').append(html);
					p++;
				}
			})
		}
		function getNewOrders() {
			var lasttime = $('#olists li').eq(0).attr('data-time');
			if(!lasttime){
				lasttime = 0;
			}
			$.getJSON("{:U('Index/getOrdersListByLastTime')}",{aid:aid,lasttime:lasttime},function(data) {
				if(data){
					if(data.list){
						for (var i = data.list.length - 1; i >= 0; i--) {
							data.list[i].new = 'neworder';
						}
						var tpl = document.getElementById('tpl').innerHTML;
						var html = template(tpl, data);
						$('#olists').prepend(html);
						$('#surplus').html('剩余'+data.now.surplus);
						$('#press').css('width',data.now.press + '%');
						if(data.now.status == 0){
							if(confirm('第'+data.now.section+'期已经结束，快去公众号查看开奖结果')){
								window.location.href = 'http://mp.weixin.qq.com/s?__biz=MzA4Njc2MDU1Nw==&mid=503027130&idx=1&sn=3cc5a6adbfa8d987d2dd243321e35101#rd';
							}else{
								window.location.reload();
							}
						}
					}
				}
			})
		}
		$(function(){
			getOrderList();
			setInterval('getNewOrders()',1000);
			$('#btn_order').click(function(){
				wxPay();
				$('#gotobuy').hide();
				$('#buybox').hide();
				$('#want_bottom').show();
			})
			$('#gotobuy').click(function(){
				$('#gotobuy').hide();
				$('#buybox').hide();
				$('#want_bottom').show();
			})
			$('#btn_want').click(function(){
				$('#want_bottom').hide();
				$('#gotobuy').show();
				$('#buybox').show();
			})
			$('#fast_money span').click(function(){
				var total = $(this).attr('data-amount');
				$('#amount').val(total);
			})
			$('#load_more').click(function(){
				getOrderList();
			})

		})
	</script>
</body>
</html>