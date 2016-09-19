<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  	<ul class="cc">
  		<li><a href="#">订单管理</a></li>
  	</ul>
  </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">用户</td>
            <td align="left">统计（消费/中奖）</td>
            <td align="left">商品</td>
            <td align="left">价格</td>
            <td align="left">份数</td>
            <td align="left">活动状态</td>
            <td align="left">下单时间</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left"><a href="{:U('Manager/winning_user', array('userid'=>$vo['uid']))}">{$vo.nickname}</a></td>
              
              <td align="left">{$vo.buy} / {$vo.luck}</td>
              
              <td align="left">
              	<a href="index.php?g=DuoBao&m=Manager&a=activitys&gid={$vo.gid}">{$vo.name}</a>
              	<a href="index.php?g=DuoBao&m=Manager&a=activitys_order&id={$vo.aid}"><span style="color: #999;">[{$vo.section}期]</span></a></td>
              <td align="left"><span>{$vo.money}</span></td>
              <td align="left">{$vo.deal}</td>
              <td align="left">
              	<eq name="vo.status" value="0">
              	<span style="color: red;">结束</span>
              	<else/>
              	<span style="color:green;">进行中</span>
              	</eq></td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">
              	<eq name="vo.status" value="1">
              	<empty name="vo.pset">
              		<a href="{:U('Manager/activitys_preset', array('id'=>$vo['aid'],'uid'=>$vo['uid']) )}" class="J_ajax_del">[退单]</a>
              	</empty>
              	</eq>
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