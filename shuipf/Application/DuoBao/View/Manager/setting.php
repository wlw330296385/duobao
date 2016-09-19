<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <form name="myform" action="{:U('Manager/setting')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  	
		<tr>
			<th width="120">PINTAPPID</th> 
			<td><input type="text" name="pingappid"  class="input" id="pingappid"/></td>
		</tr>
		<tr>
			<th width="120">PINGAPIKEY</th> 
			<td><input type="text" name="pingapikey"  class="input" id="pingapikey"/></td>
		</tr>
		<tr>
			<th width="120">揭晓倒计时</th> 
			<td><input type="text" name="etime"  class="input" id="etime"/> <span>分钟</span></td>
		</tr>
	</table>
  </div>
   <div class="">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">保存</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>