<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
  	<ul class="cc">
  		<li><a href="#">活动管理</a></li>
  	</ul>
  </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td align="left">ID</td>
            <td align="left">期数</td>
            <td align="left">所需</td>
            <td align="left">已购</td>
            <td align="left">开始时间</td>
            <td align="left">结束时间</td>
            <td align="left">中奖人</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.section}</td>
              <td align="left">{$vo.money}</td>
              <td align="left">{$vo.nowmoney}</td>
              <td align="left">{$vo.atime|date='Y-m-d H:i:s',###}</td>
              <td align="left">
              	<eq name="vo.status" value="0">
              	<span style="color: red;">{$vo.etime|date='Y-m-d H:i:s',###}</span>
              	<else/>
              	<span style="color:green;">进行中</span>
              	</eq>
              	</td>
              <td align="left">{$vo.nickname} <eq name="vo.islock" value="1"><span style="color:red">A</span></eq> </td>
              <td align="left">
		              	[<a href="{:U('Manager/activitys_order', array('id'=>$vo['id']) )}">下单记录</a>]
                    &nbsp;&nbsp;
              	   <neq name="vo.wid" value="0">
              	    [<a href="{:U('Manager/robot_share', array('id'=>$vo['wid']))}">晒单</a>]
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
<script type="text/javascript">
	$(function(){
//		$(".btn_preset").on('click',function(){
//			var aid = $(this).attr('data-aid');
//			var uid = $("#uid_"+aid).val();
//			$.get("{:U('Manager/activitys_preset')}",{id:aid,uid:uid},function(){
//				$(".b_"+aid).hide();
//			})
//		})
	})
</script>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>