<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
  		<li><a href="{:U('winning')}">中奖管理</a></li>
  		<li class="current"><a href="#">晒单</a></li>
  	</ul>
</div>
  <form name="myform" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  		<input type="hidden" name="wid" value="{$winning.id}">
		<tr>
			<th width="120">用户</th> 
			<td><input type="text" class="input" id="name" value="{$winning.nickname}"/></td>
		</tr>
		<tr>
			<th width="120">商品</th> 
			<td><input type="text" class="input" id="money" value="{$winning.name}[{$winning.section}期]"/ style="width:300px"></td>
		</tr>
		<tr>
			<th width="120">晒单时间</th> 
			<td><input type="text"  id="atime" name="atime" value=""  size="21" class="input length_3 J_datetime  date" />
			</td>
		</tr>
		<tr>
			<th width="120">晒单内容</th> 
			<td><textarea rows="5" cols="100" name="des"></textarea></td>
		</tr>

		<tr class="upfileBox">
			<th width="120">图1</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" /><div class="imgshow"></div></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">图2</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" /><div class="imgshow"></div></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">图3</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" />
				<div class="imgshow"></div>
				</td>
		</tr>
		<tr class="upfileBox">
			<th width="120">图4</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" /><div class="imgshow"></div></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">图5</th> 
			<td><input type="text" name="pic[]"  class="input" style="width: 300px;"/> 
				<input type="file" name="upload" value="" />
				<div class="imgshow"></div>
				</td>
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
<script src="{$config_siteurl}statics/js/common.js"></script>
</body>
</html>