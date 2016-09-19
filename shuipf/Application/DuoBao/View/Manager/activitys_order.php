<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  	<ul class="cc">
  		<li><a href="#">活动订单</a></li>
  	</ul>
  </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">UID</td>
            <td align="left">用户</td>
            <td align="left">本次/总数</td>
            <td align="left">时间</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.uid}</td>
              <td align="left">{$vo.nickname} 
                <eq name="vo.islock" value="1"><span style="color:red">A</span></eq>
              </td>
              <td align="left">{$vo.adeal}/{$vo.cdeal}</td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">
              	<a href="{:U('Manager/activitys_preset', array('id'=>$vo['aid'],'uid'=>$vo['uid']) )}" class="J_ajax_del">[退单]</a>
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