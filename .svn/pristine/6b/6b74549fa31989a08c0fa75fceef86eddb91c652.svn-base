<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body>
<style type="text/css">
table.gridtable {
  width: 100%;
  font-family: verdana,arial,sans-serif;
  font-size:11px;
  color:#333333;
  border-width: 1px;
  border-color: #666666;
  border-collapse: collapse;
}
table.gridtable th {
  border-width: 1px;
  padding: 8px;
  border-style: solid;
  border-color: #666666;
  background-color: #dedede;
}
table.gridtable td {
  border-width: 1px;
  padding: 8px;
  border-style: solid;
  border-color: #666666;
  background-color: #ffffff;
}
</style>
<div class="wrap">
  <div>
    	开始时间：<input type="text" name="start" id="start" value="{$Think.get.start}" size="21" class="input length_3 J_datetime ">
  	截止时间：<input type="text" name="end" id="end" value="{$Think.get.end}" size="21" class="input length_3 J_datetime ">
  	<button id="btn_search">查询</button>
  </div>
  <h3>统计数量</h3>
  <table class="gridtable">
    <tr>
      <th>充值用户</th>
      <th>支付次数</th>
      <th>支付金额</th>
      <th>支付宝</th>
      <th>微信支付</th>
      <th>未支付</th>
      <th>订单数量</th>
      <th>订单份数</th>
      <th>用户注册</th>
      <th>中奖金额</th>
      <th>活动赠送抢币</th>
      <th>总未使用抢币</th>
    </tr>
    <tr>
      <td>{$data['puser']}</td>
      <td>{$data['pnum']}</td>
      <td>{$data['paynum']}</td>
      <td>{$data['alipay']}</td>
      <td>{$data['wx']}</td>
      <td>{$data['nopay']}</td>
      <td>{$data['onum']}</td>
      <td>{$data['ordernum']}</td>
      <td>{$data['regnum']}</td>
      <td>{$data['winnum']}</td>
      <td>{$data['giftnum']}</td>
      <td>{$data['allpoint']}</td>      
    </tr>
  </table>

  <h3>来源渠道</h3>

  <table class="gridtable" id="app_from_list">
  <thead>

    <tr>
      <th>渠道包</th>
      <th>登陆次数</th>
    </tr>
    </thead>
    <tbody>
    <volist name="app_data" id="vo">
    <tr>
      <td>{$vo['userclient']}</td>
      <td>
        {$vo['c']}
      </td>
    </tr>
    </volist>
    </tbody>
  </table>

  <h3>热门商品 <a href="javascript:;" id="btn_load">点击加载</a></h3>
  <script type="text/html" id="tpl_goods_list">
    
    
    {{each list as value i}}
    <tr>
      <td>{{value.name}}</td>
      <td>
      {{if value.order}}
        {{value.order}}
      {{/if}}
      </td>
      <td>{{value.hot}}</td>
    </tr>
    {{/each}}
    
  </script>

  <table class="gridtable" id="goods_list">
    <thead>
      <tr>
        <th>商品名称</th>
        <th>订单总份数</th>
        <th>总浏览次数</th>
      </tr>
      </thead>
      <tbody id="glbox">
      </tbody>
  </table>

 

</div>
<script src="{$config_siteurl}statics/js/template.js?v"></script>
<script type="text/javascript" src="http://cdn.bootcss.com/jquery.tablesorter/2.25.5/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
  $(function(){
    
    $('#btn_load').click(function(){
      $('#glbox').html('loading..');
      $.getJSON("{:U('Manager/statistics_goods')}",{start:'{$Think.get.start}',end:'{$Think.get.end}'},function(data){
        if(data){
          var d = {list:data};
          $('#glbox').html(template('tpl_goods_list',d));
          $("#goods_list").tablesorter();
        }
      })
    })
    
    
    $("#app_from_list").tablesorter();
    
    $('#btn_search').click(function(){
      window.location.href = "{:U('Manager/statistics',array('menuid'=>189))}"+"&start="+$('#start').val() + '&end=' + $('#end').val();
    })
  })
</script>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>