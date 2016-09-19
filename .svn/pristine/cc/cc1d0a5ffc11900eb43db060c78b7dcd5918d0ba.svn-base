<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <div class="nav">
    <ul class="cc">
        <li class="current"><a href="javascript:;">[{$memberinfo['nickname']}] 中奖管理</a> 
           </li>
    </ul>
  </div>
  <div>
            中得：{$ownum} ，
            充值：<a href="index.php?g=Member&m=Member&a=records&userid={$memberinfo['userid']}">{$paynum}</a> ，
            下单：<a href="index.php?g=Member&m=Member&a=shopRecord&userid={$memberinfo['userid']}">{$ordernum}</a> ，
            剩余抢币：{$memberinfo['point']} ，
            剩余元宝：{$memberinfo['credit']} ，
            师傅ID：<a href="{:U('Manager/winning_user', array('userid'=>$memberinfo['master_uid']))}" style="display:inline">{$master_memberinfo}</a> 

            徒弟：{$mnum}
            </div>
  <form name="myform" action="" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></td>
            <td align="left">ID</td>
            <td align="left">中奖码</td>
            <td align="left">用户</td>
            <td align="left">商品</td>
            <td align="left">价格</td>
            <td align="left">状态</td>
            <td align="left">时间</td>
            <td align="left">操作</td>
          </tr>
        </thead>
        <tbody>
          <volist name="data" id="vo">
            <tr>
              <td align="left">
                <eq name="vo.status" value="0">
                  <input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x"  value="{$vo.id}" name="id[]"  data-money="{$vo.orgprice}">
                </eq>
                

              </td>
              <td align="left">{$vo.id}</td>
              <td align="left">{$vo.codenumber}</td>
              <td align="left">
                {$vo.nickname}
                <eq name="vo['islock']" value="1">&nbsp;[auto]</eq></td>
              <td align="left">{$vo.name}<span style="color: #999;">[{$vo.section}期]</span></td>
              <td align="left">{$vo.orgprice}</td>
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
     <div class="">
      <div class="btn_wrap_pd">
       选中： <span id="chknowtxt" style="color:red"></span> 个，共 <span id="moneytxt" style="color:red"></span> 元 <button class="btn  mr10 J_ajax_submit_btn" data-action="{:U('Manager/winning_pl')}" type="submit">批量发货</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<script type="text/javascript">
  var chknum = 0;
  function getchknum(){
    chknum = 0;
    var txtmoney = 0;
      $('.J_check').each(function(){
        var ischk = $(this).attr('checked');
        var money = $(this).attr('data-money');
        if(ischk){
            chknum ++;
            txtmoney += parseInt(money);
        }
      })

    $('#chknowtxt').html(chknum);
    $('#moneytxt').html(txtmoney);
  }
  $(function(){
    $('.J_check').change(function(){
        getchknum();
    })
    $('.J_check_all').change(function(){
       getchknum();
    })
  })

</script>
</body>
</html>