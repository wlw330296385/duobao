<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  	<ul class="cc">
  		<li><a href="#">支付订单管理</a>  </li>
  	</ul>
  </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">ch_id</td>
            <td align="left">order_no</td>
            <td align="left">uid</td>
            
            <td align="left">amount</td>
            <td align="left">channel</td>
            <td align="left">atime</td>
            <td align="left">status</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.ch_id}</td>
              <td align="left">{$vo.order_no}</td>
              <td align="left"><a href="{:U('Manager/winning_user', array('userid'=>$vo['uid']))}">{$vo.nickname}</a></td>
              <td align="left">{$vo.amount}</td>
              <td align="left">{$vo.channel}</td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">{$vo.status}</td>
              <td align="left">
              	<a href="#">[待定]</a>
              </td>
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} 微信：{$wxcount} 支付宝：{$alipaycount} 合计：{$allcount}</div>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>