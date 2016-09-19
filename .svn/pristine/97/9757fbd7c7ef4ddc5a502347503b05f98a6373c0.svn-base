<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>计算结果</title>
		<meta name="format-detection" content="telephone=no"/>
		<style type="text/css">
			*{margin: 0; padding: 0;}
			body{font-size: 12px; background: #f9f9f9; }
			.wp{padding: 10px; border-bottom: 1px solid #f1f1f1; line-height: 20px;}
			h3{ font-size: 14px;}
			.des{color: #999;}
			#about_box{ background: #FF4040; color: #fff; margin: 10px; border-radius: 5px; font-size: 14px;}
		</style>
		<script src="{$model_extresdir}js/jquery.js"></script>
		
	</head>
	<body>
		<div id="about_box">
			<div id="" style="padding: 10px;">
				计算公式?
			<p style="text-align: center;">（数值A &divide; 数值B） 取余数 + 10000001</p>
				
			</div>
		</div>
		<div id="" style="background: #fff;">
			<div class="wp">
				<h3>数值A</h3>
				<p class="des">=截止该奖品最后购买时间点前最后55条全站参与记录的前50条参与时间</p>
				<p>=<span style="color: red;">{$resA}</span>
					<span style="float: right; color: #23aaff; font-size: 14px;" id="showlast">展开↓</span>
					<div class="" style="clear: both;">
						
					</div>
					</p>
				<div class="" id="last_box" style="display: none;">
					<table border="0" cellspacing="0" cellpadding="0" width="100%">
						<tr><th>夺宝时间</th><th>用户账户</th></tr>
						<volist name="list" id="vo">
						<tr style="color: #999;">
							<td>{$vo.atime|getDateF} &gt;
								<span <gt name="i" value="5"><lt name="i" value="56"> style=" color:red"</lt></gt>> 
								{$vo.atime|getTimestamp}
								</span>
								</td>
							<td>{$vo.nickname}</td>
						</tr>
						</volist>
					</table>
				</div>
			</div>
			<div class="wp">
				<h3>数值B</h3>
				<p class="des">=奖品所需人次</p>
				<p>=<span style="color: red;">{$resB}</span></p>
			</div>
			<div class="wp">
				<h3>计算结果</h3>
				<p class="des">幸运号码  = <span style="color: red;">{$result}</span></p>
			</div>
		</div>
		<script type="text/javascript">
			var last_box = document.getElementById('last_box');
			document.getElementById('showlast').addEventListener('touchstart',function(){
				if(last_box.style.display == 'none'){
					last_box.style.display = 'block'
				}else{
					last_box.style.display = 'none'
				}
			})
		</script>
	</body>
</html>