<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li><a href="{:U('Manager/winning')}" >中奖管理</a></li>
        <li  class="current"><a href="#" >发货</a></li>
      </ul>
</div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  		<tr>
  			<th width="120">获奖信息</th>
  			<td>
  				奖品：第【{$winning[section]}】期，{$winning[name]}<br />
  				幸运码：{$winning[codenumber]}<br />
  				昵称：{$winning[nickname]}<br />
  				用户名：{$winning[username]}<br />
  				收货信息：{$winning[area]} {$winning[detail]} <br />
  				收货人：{$winning[addressname]} <br />
  				收货电话：{$winning[tel]}<br />
  				支付宝账号：{$winning[alipay]}<br />
  				</td>
  		</tr>
		<tr>
			<th width="120">快递单号</th> 
			<td><input type="text" name="sendnumber"  class="input" id="sendnumber"/></td>
		</tr>
		<tr>
			<th width="120">快递公司</th> 
			<td><input type="text" name="sendname"  class="input" id="sendname"/></td>
		</tr>
	</table>
  </div>
   <div class="">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>