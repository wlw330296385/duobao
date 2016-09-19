<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  	<ul class="cc">
  		<li><a href="#">晒单管理</a></li>
  	</ul>
  </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left" width="40">ID</td>
            <td align="left">用户</td>
            <td align="left">商品</td>
            <td align="left">描述</td>
            <td align="left">图片</td>
            <td align="left"  width="120">时间</td>
            <td align="left" width="100">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.nickname}<eq name="vo['islock']" value="1">&nbsp;<span style="color: red">[auto]</span></eq></td>
              <td align="left">{$vo.name}<span style="color: #999;">[{$vo.section}期]</span></td>
              <td align="left">{$vo.des}</td>
              <td align="left">
                <?php
                  $photos = explode('|', $vo['photos']);
                ?>
                 <volist name="photos" id="p">
                <a href="{$p}" target="_blank"><img src="{$p}" height="60" /></a>
                </volist>
              </td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">
              	<eq name="vo['s_status']" value="0">
              		
              		<a href="{:U('Manager/shows_status', array('id'=>$vo['id'],'status'=>1) )}" style="color: green;">[通过审核]</a>
              		<a href="{:U('Manager/shows_status', array('id'=>$vo['id'],'status'=>-1) )}" style="color: red;">[屏蔽]</a>
								</eq>
								<eq name="vo['s_status']" value="-1">
              		<!-- <a href="{:U('Manager/shows_status', array('id'=>$vo['id'],'status'=>0) )}">[恢复]</a> --> 
              	</eq>
              	<eq name="vo['s_status']" value="1">
              		<a href="{:U('Manager/shows_status', array('id'=>$vo['id'],'status'=>-1) )}" style="color: red;">[屏蔽]</a>
              	</eq>
              	<a href="{:U('Manager/shows_del', array('id'=>$vo['id']) )}" class="J_ajax_del">[删除]</a>
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