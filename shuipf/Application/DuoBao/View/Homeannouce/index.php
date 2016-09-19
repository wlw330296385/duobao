<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head" />
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">

		<div class="nav">
			<ul class="cc">
				<li class="current"><a href="{:U('Homeannouce/index')}">公告管理</a></li>
				<li><a href="{:U('Homeannouce/annouce_add')}">添加公告</a></li>
			</ul>
		</div>

		<form name="myform" action="{:U('Homeannouce/annouce_delete')}"
			method="post" class="J_ajaxForm">
			<div class="table_list">
				<table width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="10" align="center"><input type="checkbox"
								class="J_check_all" data-direction="x"
								data-checklist="J_check_x">全选</td>
							<td width="10" align="center">标题</td>
							<td width="70" align="center">内容</td>
							<td width="100" align="center">图标</td>

							<td width="100" align="center">管理操作</td>
						</tr>
					</thead>
					<tbody>
						<volist name="list" id="vo">
						<tr>
							<td align="center"><input type="checkbox" class="J_check"
								data-yid="J_check_y" data-xid="J_check_x" name="id[]"
								value="{$vo.id}" id="att_{$vo.id}" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

							<td align="center">{$vo.title}</td>
							<td align="center"><if condition="!empty($vo['content'])">已有内容<else />还未填写内容</if></td>
							<td align="center"><img
								src="{$vo.icon|default='http://img1.nntzd.com/gzq/temp/avt.jpg'}"
								style="height: 25px; width: 25px"></td>

							<td align="center"><a
								href="{:U('Homeannouce/annouce_edit',array('id'=>$vo['id']))}">修改</a>
								| <a
								href="{:U('Homeannouce/annouce_delete',array('id'=>$vo['id']))}">删除</a></td>
						</tr>
						</volist>
					</tbody>
				</table>
				<div class="p10">
					<div class="pages">{$Page}</div>
				</div>
			</div>
			<div class="btn_wrap">
				<div class="btn_wrap_pd">
					<input type="submit" value="删除" class="btn btn_submit"><span
						style="color: red" class="dd">！至少选择一项</span>
				</div>
			</div>
		</form>
	</div>
	<script src="{$config_siteurl}statics/js/common.js?v"></script>
	<script src="{$config_siteurl}statics/js/content_addtop.js?v"></script>
	<script type="text/javascript">
   $('.dd').hide()
   $('input[type=submit]').click(function(){
       var ch = 0;
        $('tbody input[type=checkbox]').each(function(){
          
           if ($(this).is(':checked')){
            ch = 1;
           } 
         })
        if (ch==0) {
           $('.dd').show()
           return false
         }
         if(!confirm('确定删除所选？')){
        return false
       }

   })


</script>

</body>
</html>