<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">

  <div class="nav">
    <ul class="cc">
        <li class="current"><a href="{:U('Manager/goods_type')}" >商品类型</a></li>
        <li ><a href="{:U('Manager/add_type')}" >添加类型</a></li>
      </ul>
</div>
  
  <form name="myform" action="" method="post" class="J_ajaxForm">
  <div class="table_list">
  <table width="100%" cellspacing="0">
      <thead>
        <tr>
          <td width="10" align="left"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x">全选</td>
          <td width="10" align="center" >排序 </td>
          <td width="70" align="center" >名称 </td>
          <td width="70" align="center" >图片</td>
          <td width="100" align="center">管理操作</td>
      </tr>
      </thead>
      <tbody>
      <volist name="types" id="vo">
        <tr>
          <td align="left"><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="id[]" value="{$vo.id}" id="att_{$vo.id}" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td align="center"><input name="listorders[{$vo.id}]" type="text" size="3" value="{$vo.sort}" class="input"></td>
          <td align="center">{$vo.typename}</td>
          <td align="center"><img style="height: 25px; width: 25px" src="<?php echo $icon=empty($vo['icon'])?'http://img1.nntzd.com/gzq/temp/avt.jpg':$vo['icon']?> "></td>
          <td align="center"><a href="{:U('Manager/edit_type',array('id'=>$vo['id']))}">修改</a> | <a class="J_ajax_del" href="{:U('Manager/del_type',array('id'=>$vo['id']))}">删除</a></td>
        </tr>
      </volist>
      </tbody>
    </table>
  </div>
  <div class="btn_wrap">
      <div class="btn_wrap_pd">
        <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label> 
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="button" data-action="{:U("Manager/sort_type")}">排序</button> 
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit" data-action="{:U("Manager/del_type")}">删除</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js?v"></script>
</body>
</html>