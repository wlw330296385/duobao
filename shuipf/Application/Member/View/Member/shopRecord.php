<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <!-- <Admintemplate file="Common/Nav"/> -->
  
  <form name="searchform" action="{:U('Member/shopRecord')}" method="post" >
    <input type="hidden" name="username" value="{$username}">
    <input type="hidden" name="userid" value="{$userid}">
    <input type="hidden" name="AC" value="{$AC}">
    <div class="search_type cc mb10">
      <div class="mb10"> <span class="mr20"> 
        
        <select name="field">
        
          <option value='deal' >购买数量</option>
          <option value='money' >消费金额</option>
        </select>
        
        <!-- <button class="btn">搜索</button> -->
        <input type="submit" value="排序" class="btn">
        </span> </div>
    </div>
  </form>
  <form name="myform" action="{:U('Member/delete')}" method="post" class="J_ajaxForm">
    <div class="table_list">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <td  align="left" width="20"><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></td>
            
            <td align="left">用户名</td>
            <td align="left">订单编号</td>
            <td align="left">商品名称</td>
            <td align="left">商品缩略图</td>
            <td align="left">数量</td>
            <td align="left">花费金额</td>
            <td align="left">下单时间</td>

            <td align="left">支付状态</td>
            <!-- <td align="left">操作</td> -->
          </tr>
        </thead>
        <tbody>
          <volist name="shop_list" id="vo">
            <tr>
              <td align="left"><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x"  value="{$vo.id}" name="id[]"></td>
         
              <td align="left">{$vo.username}</td>
              <td align="left">{$vo.ordernumber}</td>
              <td align="left"><a href="index.php?g=DuoBao&m=Manager&a=activitys_order&id={$vo.aid}">{$vo.name}</a>[{$vo.section}期]</td>
              <td align="left"><img src="{$vo.thumb}" alt="" style="height: 100px"></td>
              <td align="left">{$vo.deal}</td>
              <td align="left">{$vo.money}</td>
           
              <td align="left"><?php echo date('Y-m-d H:i:s',$vo['atime']) ?></td>
              
             
              <td align="left"><if condition="$vo['status'] eq 1">支付成功<else />未支付</if></td>
              <!-- <td align="left"><a href="{:U('Member/Order_delete', array('userid'=>$vo['userid']) )}">[修改]</a></td> -->
            </tr>
          </volist>
        </tbody>
      </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
    </div>
    <div class="">
     {$Page}

    </div>
  </form>
</div>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
<script>
//会员信息查看
function member_infomation(userid, modelid, name) {
	omnipotent("member_infomation", GV.DIMAUB+'index.php?g=Member&m=Member&a=memberinfo&userid='+userid+'', "个人信息",1)
}
</script>
</body>
</html>