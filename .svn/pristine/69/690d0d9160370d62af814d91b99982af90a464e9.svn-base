<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta charset="UTF-8">
		<title>1块夺宝520</title>
		<link rel="stylesheet" href="/statics/h5/love520/css/banner.css?v=201605191115" />

		<style type="text/css">
			@media screen and (max-width: 320px) {
				#title {
					font-size: 16px !important;
				}
				body {
					font-size: 10px;
				}
			}
		</style>
		<style type="text/css">
			* {
				margin: 0;
				padding: 0;
				font-family: "微软雅黑";
			}
			
			html,
			body {
				width: 100%;
				height: 100%;
				margin: 0;
				padding: 0;
				font-family: "微软雅黑";
				background: url(/statics/h5/love520/img/bg.jpg) no-repeat;
				background-size: 100% 100%;
			}
			/*#p_3 {
				background: url(img/boythree-.png) no-repeat;
				background-size: 100% 100%;
			}*/
			
			#p_3 .figcaption {
				width: 20%;
				background: url(/statics/h5/love520/img/fraction.png) no-repeat;
				background-size: 100% 100%;
				top: 0;
				left: 0;
			}
			
			#p_4 {
				background: url(/statics/h5/love520/img/bg2.jpg) no-repeat;
				background-size: 100% 100%;
				text-align: center;
			}
			
			#prot {
				/*width: 18%;
				height: 7%;*/
				font-size: 22px;
				padding: 16px 16px;
				text-align: center;
				background: url(/statics/h5/love520/img/pace.png) no-repeat;
				background-size: 100% 100%;
				color: #FFFFFF;
				position: absolute;
				/*bottom: 10%;*/
				left: 5%;
				top: 2%;
			}
			
			#title {
				text-align: left;
				width: 69%;
				margin-top: 15%;
				margin-left: 18%;
				color: #060606 !important;
			}
			#share_box{display:none ; position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 999}
		</style>
		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
		<script type="text/javascript">
			//  document.addEventListener('touchmove', function(event) {
			//      event.preventDefault();
			//  }, false);
			//  $.getJSON("http://game.nntzd.com/index.php?g=api&m=WxOauth&a=chkOpenid", {
			//      type: 'userinfo',
			//      project:'jinjiang'
			//  }, function(ret) {
			//      if (ret.status == 1) {
			//          // $('body').show();
			//      } else {
			//          window.location.href = ret.url + "&url=" + encodeURIComponent(window.location.href);
			//      }
			//  });
			var shareData = {
				title: "这次的520，竟然是这个东西最热门..",
				link: 'http://duobao.nntzd.com/index.php?g=DuoBao&m=wechat&a=love',
				imgUrl: 'http://img1.nntzd.com/static/duobao/h5/love520.jpg',
				desc: '没PAPA过，别戳叫正青春！翻滚吧，骚年',
				success: function() {
					$("#share").hide();
					$("#mm").show();
				}
			};
			var score = 0,
				nowitem = 0;
			var lists = [{
				title: "1.你觉得通常“菊花”是比喻什么的？",
				say: [{
					t: "A.老奶奶的笑脸",
					s: 20
				}, {
					t: "B.嘟起来的嘴唇",
					s: 10
				}, {
					t: "C.揉皱的卫生纸",
					s: 15
				}, {
					t: "D.臀眼",
					s: 5
				}, ],
				bg: "/statics/h5/love520/img/problem_01.png"
			}, {
				title: "2.当你第一眼看到“干”和“操”这两个多音字时，你脑里的读音是：",
				say: [{
					t: "A.干读第一声、操读第一声",
					s: 15
				}, {
					t: "B.干读第四声、操读第一声",
					s: 20
				}, {
					t: "C.干读第一声、操读第四声",
					s: 10
				}, {
					t: "D.干读第四声、操读第四声",
					s: 5
				}, ],
				bg: "/statics/h5/love520/img/problem_01.png"
			}, {
				title: "3.什么样的情景最能勾起你的PAPAPA？",
				say: [{
					t: "A看电影",
					s: 10
				}, {
					t: "B说情话",
					s: 5
				}, {
					t: "C角色扮演",
					s: 20
				}, {
					t: "D吵架",
					s: 15
				}, ],
				bg: "/statics/h5/love520/img/problem_01.png"
			}, {
				title: "4.他的什么状态更容易引起你的欲望？",
				say: [{
					t: "A楚楚可怜",
					s: 5
				}, {
					t: "B干劲儿十足",
					s: 20
				}, {
					t: "C卖萌发嗲",
					s: 10
				}, {
					t: "D痛不欲生",
					s: 15
				}, ],
				bg: "/statics/h5/love520/img/problem_01.png"
			}, {
				title: "5.你喜欢和TA什么时段爱爱？",
				say: [{
					t: "A清晨",
					s: 10
				}, {
					t: "B睡前",
					s: 5
				}, {
					t: "C半夜三点定闹钟",
					s: 15
				}, {
					t: "D时段不是问题，视频才是关键",
					s: 20
				}, ],
				bg: "/statics/h5/love520/img/problem_01.png"
			}];

			function bindList(o) {
				if (nowitem == 5) {
					/*show显示hide隐藏*/
				}
				if (nowitem < lists.length) {
					$("#title").html(o.title);
					$("#say").html('');
					$('#picture').attr('src', o.img);
					// $("#picture").css('display', 'none');
					var says = o.say;
					for (var i = 0; i < says.length; i++) {
						$("#say").append('<div data-score="' + says[i].s + '" onclick="nextitem(this)">' + says[i].t + '</div>');
					}
					$("#p_2").css('background', 'url(' + o.bg + ') no-repeat');
					$("#p_2").css('background-size', '100% 100%');
				} else {
					$("#p_2").hide();
					$("#p_3").show();
					//判断分数结果算出分数总和
					var a = '';
					var sex = sessionStorage.getItem('sex');
					if (sex == 1) {
						a = showOverboy();
					}
					if (sex == 2) {
						a = showOvergirl();
					}
					$('#num').html(a);
				}
			}
			//显示结果页的逻辑处理
			function showOverboy() {
				var num = 0;
				if (score >= 0 && score <= 25) {
					$("#home").attr('src', "/statics/h5/love520/img/boy1.png");
					num += 1;
					$('#num').html(num)
				}
				if (score >= 26 && score <= 50) {
					$("#home").attr('src', "/statics/h5/love520/img/boy2.png");
					num += 2;
					$('#num').html(num)
				}
				if (score >= 51 && score <= 75) {
					$("#home").attr('src', "/statics/h5/love520/img/boy3.png");
					num += 3;
					$('#num').html(num)
				}
				if (score >= 76 && score <= 100) {
					$("#home").attr('src', "/statics/h5/love520/img/boy4.png");
					num += 4;
					$('#num').html(num)
				}
				return score;
			}
			//显示结果页的逻辑处理
			function showOvergirl() {
				var num = 0;
				if (score >= 0 && score <= 25) {
					$("#home").attr('src', "/statics/h5/love520/img/girl1.png");
					num += 1;
					$('#num').html(num)
				}
				if (score >= 26 && score <= 50) {
					$("#home").attr('src', "/statics/h5/love520/img/girl2.png");
					num += 2;
					$('#num').html(num)
				}
				if (score >= 51 && score <= 75) {
					$("#home").attr('src', "/statics/h5/love520/img/girl3.png");
					num += 3;
					$('#num').html(num)
				}
				if (score >= 76 && score <= 100) {
					$("#home").attr('src', "/statics/h5/love520/img/girl4.png");
					num += 4;
					$('#num').html(num)
				}
				return score;
			}
			//进度条
			function nextitem(o) {
				score += parseInt($(o).attr('data-score'));
				nowitem++;
				$("#now").html(nowitem + 1);
				bindList(lists[nowitem]);
				var proVal = nowitem / lists.length * 100;
				$("#pro").css('width', proVal + '%');
			}
			$(function() {
				$("#btn_start").on('click', function() {
					$("#p_1").hide();
					$("#p_4").show();
					//处理P2的题目绑定
				})
				$("#one").on('click', function() {
					sessionStorage.setItem('sex', 1);
					$("#p_4").hide();
					$("#p_2").show();
					//处理P2的题目绑定
					score = 0;
					nowitem = 0;
					$("#pro").css('width', 0);
					bindList(lists[0])
				})
				$("#two").on('click', function() {
					sessionStorage.setItem('sex', 2);
					$("#p_4").hide();
					$("#p_2").show();
					//处理P2的题目绑定
					score = 0;
					nowitem = 0;
					$("#pro").css('width', 0);
					bindList(lists[0])
				})
				$("#buy").on('click', function() {
					$('#p_3').hide();
					$('#p_4').show();
					//处理P2的题目绑定
					score = 0;
					nowitem = 0;
					$("#pro").css('width', 0);
					$("#now").html(nowitem + 1);
					bindList(lists[0])
				})
				$("#have").on('click', function() {
					//          $(this).hide();
					$('#share').hide();
					$('#logoBox').show();
				})
				$("#btn_next").on('click', function() {
					$('#logoBox').hide();
					$('#share').show();
				})
				$("#out").on('click', function() {
					$('#share').show();
					$('#logoBox').hide();
				})
			})
		</script>

	</head>

	<body>
	<div id="share_box"><img src="http://img1.nntzd.com/static/share_tip.png" width="100%" /></div>
	<div class="page" id="p_1">
			<img src="/statics/h5/love520/img/content.png" style="width: 100%;" class="animated bounceInRight" />
			<div id="shuru">
				<div id="btn_start" class="animated bounceIn"><img src="/statics/h5/love520/img/button.png" style="width:50%!important ;" /></div>
			</div>
		</div>
		<div class="page" id="p_4">
			<img src="/statics/h5/love520/img/content2.png" style="width: 100%;" class="animated bounceInRight" />
			<div id="shuru">
				<div id="btn_start" class="animated bounceIn">
					<img src="/statics/h5/love520/img/one.png" id="one" />
					<img src="/statics/h5/love520/img/two.png" id="two" />
				</div>
			</div>
		</div>
		<section style="display: block;">
			<div class="page" id="p_2">
				<div class="bo">
					<h1 id="title"></h1>
					<img id="picture" style="border:0px ;" />
					<div class="" id="say"></div>

				</div>
				<div id="prot"><span id="now">1</span>/5</div>
			</div>
			</div>

			<div class="page" id="p_3">
				<img src="/statics/h5/love520/img/boy1.png" id="home" />
				<div id="shuru">
					<div id="btn_start" class="animated bounceIn">
						<img src="/statics/h5/love520/img/buy.png" id="buy" />
						<img src="/statics/h5/love520/img/buy1.png" id="out" />
					</div>
				</div>
			</div>
			<div id="logoBox">
				<img src="/statics/h5/love520/img/logo.png" width="40%" class="logo" border="0" onclick="stop()" />
			</div>

			<div id="result" class="page" style="display: none; position: relative;">
				<img src="/statics/h5/love520/img/prize1.png" width="100%" id="prize" style="margin-top: 50px"  />
				<div id="box" style="position: absolute;top:40%; left: 0; width: 100%; text-align: center;">
					<div style="width: 60%; margin: 0 auto;">


						<div id="entry" style="display: none;">
							<div style="margin-bottom: 15px">请填写邮寄地址</div>
							<div class="inp">
								<input type="text" name="name" id="name" value="" placeholder="姓名" />
							</div>
							<div class="inp">
								<input type="tel" name="tel" id="tel" value="" placeholder="电话" />
							</div>
							<div class="inp">
								<input type="address" name="address" id="address" value="" placeholder="地址" />
							</div>
							<div class="inp" style="color: #000; font-size: 12px;">
								(填写真实姓名电话,便于后期领奖，仅限200名，每人领取1次，2016年5月20号下午17点开始，线上中奖不再发货，最终权归活动主办方所有)
							</div>
							<a href="javascript:;" id="bb" class="btn">立即领取</a>
						</div>
						<!--/end input-->
						<div id="luck" style="display: none">
							<div id="text">恭喜你中得</div>
							<div><img src="/statics/h5/love520/img/gold.png" id="pic" width="30%" style="margin: 20px 0" /></div>
							<div>
								<a href="javascript:;" id="cc" class="btn">立即使用</a>
								<a href="javascript:;" id="gun" class="btn">告诉好友来抢</a>
							</div>
						</div>
					</div>
				</div>				
			</div>
			</div>

			<script>
				var goods = 1;
				$("#out").on('touchstart', function() {
					$('#p_3').hide();
					$('#result').show();
					$.getJSON('http://duobao.nntzd.com/index.php?g=DuoBao&m=wechat&a=luck', {
						// debug: 1
					}, function(data) {
						var pz = '';
						if(data){
							if(data.lv){
								switch (parseInt(data.lv)) {
									case 1:
										pz = '1个抢币';
										$("#pic").attr('src', "/statics/h5/love520/img/gold.png");
										break;
									case 2:
										pz = '3个抢币';
										$("#pic").attr('src', "/statics/h5/love520/img/gold.png");
										break;
									case 3:
										pz = '5个抢币';
										$("#pic").attr('src', "/statics/h5/love520/img/gold.png");
										break;
									case 4:
										pz = '冈本套套1盒';
										$("#pic").attr('src', "/statics/h5/love520/img/okamoto.png");
										goods = 4;
										break;
								}
							}
							$('#luck').show();
							if (data.status == 1) {
								$("#prize").attr('src', "/statics/h5/love520/img/prize1.png");
								$("#text").html("恭喜您！抽中了" + pz + "！");
							} else if (data.status == 100) {
								$("#text").html("你已经中过"+pz+"！");
							}
						}else{
							alert('error:001');
						}
					});
				});
				$(function() {
					$('#gun').on('touchstart', function() {
						$('#share_box').show();
					})
					$('#share_box').on('touchstart', function() {
						$('#share_box').hide();
					})

					$("#bb").on('touchstart', function() {
						var name = $("#name").val();
						var tel = $("#tel").val();
						var address = $("#address ").val();
						if (name == '' || tel == '' || address == '') {
							alert('请填写测试信息')
							return false;
						} else {
							$.post('http://duobao.nntzd.com/index.php?g=DuoBao&m=wechat&a=saveinfo', {
								name: name,
								tel: tel,
								address: address
							}, function(data) {$('#share_box').show();alert('提交成功，请注意查收快递')})
						}
					})
					$("#cc").on('touchstart', function() {
						if(goods == 4){
							$('#entry').show();
							$('#luck').hide();
						}else{
							window.location.href = "http://duobao.nntzd.com/wx/?f=520";
						}
					})
				})
				document.write('<audio id="video" autoplay="autoplay" loop style="display:none;"><source src="/statics/h5/love520/img/music.mp3" id="video_url_mp3" type="audio/mpeg"></audio>');
				/*音乐播放控制*/
				var isaoto = 0;

				function stop() {
					var myVideo = document.getElementById("video");
					if (!myVideo.paused) {
						myVideo.pause();
						//          document.getElementById('play_img').src = "/statics/h5/love520/img/music_stop.png";
					} else {
						myVideo.play();
						//          document.getElementById('play_img').src = "/statics/h5/love520/img/music_play.png";
					}
				}

				function play() {
					var myVideo = document.getElementById("video");
					myVideo.play();
				}
				document.ontouchstart = function(e) {
						if (isaoto == 0) {
							play();
							isaoto = 1;
						}
					}
					//			setTimeout(play, 1000);
					//				$(document).ready(function() {
					//					$(".fakeloader").fakeLoader({
					//						timeToHide: 1200,
					//						bgColor: "#1abc9c",
					//						spinner: "spinner6",
					//					});
					//				});
			</script>
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
			wx.ready(function() {
				wx.onMenuShareAppMessage(shareData);
				wx.onMenuShareTimeline(shareData);
				wx.onMenuShareQQ(shareData);
				wx.onMenuShareWeibo(shareData);
			});
			wx.error(function(res) {
				alert(res.errMsg);
			});
		</script>
		<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?1ae2bf3e81df474afe7b96df997e2bf0";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
		</script>

	</body>

</html>