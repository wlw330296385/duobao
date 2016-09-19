<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li class="current"><a href="{:U('Manager/goods')}" >商品管理</a></li>
        <li ><a href="{:U('Manager/goods_add')}" >添加商品</a></li>
      </ul>
</div>
<form name="searchform" action="{:U('Manager/goods')}" method="post" >
    <div class="search_type cc mb10">
      <div class="mb10"> <span class="mr20"> 
        <select name="sort">
          <option value='1' <eq name="sort" value='1'>selected</eq>>总销量</option>
          <option value='2' <eq name="sort" value='2'>selected</eq>>总金额</option>
        </select>
        <input type="submit" value="排序" class="btn">
        </span> </div>
    </div>
  </form>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">名称</td>
            <td align="left">价格</td>
            <td align="left">原价</td>
            <td align="left">类型</td>
            <td align="left">图片</td>
            <td align="left">发布时间</td>
            <td align="left">推广链接</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">【{$vo.sid}】{$vo.name}</td>
              <td align="left">{$vo.money}</td>
              <td align="left">{$vo.orgprice}</td>
              <td align="left">{$vo.typeid}</td>
              <td align="left"><img src="{$vo.thumb}" height="40"/></td>
              <td align="left">{$vo.atime|date='Y-m-d',###}</td>
              <td align="left">
              <input type="text" value="http://duobao.nntzd.com/shop/gid/{$vo.id}" />
              <a href="http://qr.liantu.com/api.php?text=http://duobao.nntzd.com/shop/gid/{$vo.id}" target="_blank">[二维码]</a></td>
              <td align="left">
              <a href="{:U('Manager/activitys', array('gid'=>$vo['id']) )}">[往期]</a> 
              <a href="{:U('Manager/goods_start', array('id'=>$vo['id']) )}">[启动新场]</a> 
              	<a href="{:U('Manager/goods_edit', array('id'=>$vo['id']) )}">[编辑]</a> 
              	
              	
              		<eq name="vo['putstatus']" value="1">
              			<a href="{:U('Manager/goods_putstatus', array('id'=>$vo['id'],'status'=>0) )}">
              			[<span style="color: red;">下架</span>]
              			</a>
              			<else/>
              			<a href="{:U('Manager/goods_putstatus', array('id'=>$vo['id'],'status'=>1) )}">
              			[<span style="color: green;">上架</span>]
              			</a>
              		</eq>
              		
              		
              	<!--<a href="{:U('Manager/goods_delete', array('id'=>$vo['id']) )}">[删除]</a>-->
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>