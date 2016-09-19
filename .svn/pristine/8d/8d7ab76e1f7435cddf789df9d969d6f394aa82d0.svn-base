<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
<div class="nav">
    <ul class="cc">
        <li><a href="{:U('Banner/index')}">轮播列表</a></li>
        <li class="current"><a href="{:U('Banner/banner_add')}">添加轮播</a></li>
      </ul>
</div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
  <div class="table_full">
  <table width="100%" class="table_form">
  	
		<tr>
			<th width="120">标题:</th> 
			<td><input type="text" name="title"  class="input" id="name"/></td>
		</tr>
		<tr>
			<th width="120">类型:</th> 
			<td>
				网页<input type="radio" name="type" value="web" checked="checked" index="1" id="oo" />&nbsp&nbsp
				文章<input type="radio" name="type" value="acticle" index="2"  />&nbsp&nbsp
				商品<input type="radio" name="type" value="goods" index="3"  />&nbsp&nbsp
				其他<input type="radio" name="type" value="others" index="4" />&nbsp&nbsp
		    </td>
		</tr>
		<tr>
			<th width="120" class="type">网页地址:</th> 
			<td><input type="text" name="param"  class="input" id="name"/></td>
		</tr>
		<tr class="upfileBox">
			<th width="120">轮播图:</th>
				<td><input type="text" name="path" class="input"
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
<script type="text/javascript">
  $('input[type=radio]').click(function(){
  	var index = $(this).attr('index');
  	switch (index) {
            	case '1':
            		$('.type').text('网页地址:')
            		break;
            	case '2':
            	   $('.type').text('文章id:')
            		break;
            	case '3':
            	   $('.type').text('商品id:')
            		break;	
            	default:
            		$('.type').text('参数:')
            		break;
            }
  })
</script>
</body>
</html>