<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  <eq name="robot" value="0">
  	<ul class="cc">
  		<li class="current"><a href="javascript:;">中奖管理</a></li>
  		<li><a href="{:U('robot_winning')}">自动中奖管理</a></li>
  	</ul>
  	<else />
  	<ul class="cc">
  		<li><a href="{:U('winning')}">中奖管理</a></li>
  		<li class="current"><a href="javascript:;">自动中奖管理</a></li>
  	</ul>
  	</eq>
  </div>
  
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">中奖码</td>
            <td align="left">用户</td>
            <td align="left">商品</td>
            <td align="left">状态</td>
            <td align="left">时间</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.codenumber}</td>
              <td align="left">
                <a href="{:U('Manager/winning_user', array('userid'=>$vo['userid']))}">{$vo.nickname}</a>
                <eq name="vo['islock']" value="1">&nbsp;[auto]</eq></td>
              <td align="left">{$vo.name}<span style="color: #999;">[{$vo.section}期]</span></td>
              <td align="left">
              	<switch name="vo.status">
              			<case value="0"><span style="color: red;">未发货</span></case>
					    <case value="1"><span style="color: #00aeff;">已发货</span></case>
					    <case value="2"><span style="color: green;">已收货</span></case>
						<default />未知
				</switch>
			  </td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">
              	<neq name="vo['islock']" value="1">
                  	<switch name="vo.status">
              			<case value="0"><a href="{:U('Manager/winning_send', array('id'=>$vo['id']))}">[发货]</a></case>
    				    <case value="1"><a href="#" style="color: red;">[设置为已收货]</a></case>
    				    <case value="2"><a href="#" style="color: #999;">已结束</a></case>
    				    <default />未知
    				</switch>
				<else />
					<a href="{:U('Manager/robot_share', array('id'=>$vo['id']))}">[晒单]</a>
              	</neq>
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