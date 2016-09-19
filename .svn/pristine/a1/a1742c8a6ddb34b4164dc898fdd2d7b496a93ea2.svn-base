<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
<div class="nav">
    <ul class="cc">
        <li><a href="{:U('Manager/goods_type')}" >商品类型</a></li>
        <li class="current"><a href="{:U('Manager/add_type')}" >添加类型</a></li>
      </ul>
</div>
  <form name="myform" action="{:U('Manager/add_type')}" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  	
		<tr>
			<th width="120">名称</th> 
			<td><input type="text" name="typename"  class="input" id="name"/></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">类型图标：</th>
				<td><input type="text" name="icon" class="input"
								 placeholder="" /> <input type="file"
								name="upload" value="" />
				<div class="imgshow"></div></td>
		</tr>
		<tr>
			<th width="120">排序</th> 
			<td><input type="number" name="sort"  class="input" id="money"/></td>
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
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="{$config_siteurl}statics/js/common.js"></script>
<script src="./statics/js/jquery.ajaxfileupload.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(function() {
	
		$('.upfileBox input[type="file"]').ajaxfileupload({
			'action': '/?g=DuoBao&m=Upload',
			'onComplete': function(response) {
				
				if(response.status == 1){
					
					$(this).parent().find('.input').val(response.path);
					$(this).parent().find('.imgshow').html('<img src="'+response.path+'" height="40"/>');
				}else{
					alert('上传失败，请联系管理员')
				}
				
			}
		});
	})
</script>
</body>
</html>