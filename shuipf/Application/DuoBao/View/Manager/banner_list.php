<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head" />
<body class="J_scroll_fixed">
	<div class="wrap J_check_wrap">

		<div class="nav">
			<ul class="cc">
				<li class="current"><a href="{:U('Banner/index')}">轮播列表</a></li>
				<li><a href="{:U('Banner/banner_add')}">添加轮播</a></li>
			</ul>
		</div>

		<form name="myform" action="{:U('Banner/banner_delete')}"
			method="post" class="J_ajaxForm">
			<div class="table_list">
				<table width="100%" cellspacing="0">
					<thead>
						<tr>
							<td width="10" align="center"><input type="checkbox"
								class="J_check_all" data-direction="x"
								data-checklist="J_check_x">全选</td>
							<td  align="center">标题</td>
							<td  align="center">类型</td>
							<td  align="center">参数</td>
							<td width="100" align="center">轮播图</td>
							<td width="70" align="center">状态</td>
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
							<td align="center">{$vo.type}</td>
							<td align="center">{$vo.param}</td>
							<td align="center"><img
								src="{$vo.path|default='http://img1.nntzd.com/gzq/temp/avt.jpg'}"
								style="height: 70px;"></td>
							<td align="center">
							<eq name="vo.status" value="0"><a href="{:U('banner/status',array('id'=>$vo['id'],'status'=>1))}" style="color: red">已禁用</a></eq>
							<eq name="vo.status" value="1"><a href="{:U('banner/status',array('id'=>$vo['id'],'status'=>0))}">已启用</a></eq>
							</td>
							<td align="center"><a
								href="{:U('Banner/banner_edit',array('id'=>$vo['id']))}">修改</a>
								| <a
								href="{:U('Banner/banner_delete',array('id'=>$vo['id']))}">删除</a></td>
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