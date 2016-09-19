<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body>
<div class="wrap">
  <div>
  	<form action="" method="post">
    	开始时间：<input type="text" name="stime" id="stime" value="" size="21" class="input length_3 J_datetime ">
  	截止时间：<input type="text" name="etime" id="etime" value="" size="21" class="input length_3 J_datetime ">
  	<button>查询</button>
    </form>
  </div>

  <div>
  	充值PAY订单 {$paynum}

<if condition="empty($finalStr)">
  
      <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有订单</span>
<else />
<div id="graph1">Loading graph...</div>
</if>


</div>
  <div>
  	消费ORDER订单 {$ordernum}
  
<if condition="empty($finalStr)">
  
    <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有订单</span>
<else />
<div id="graph2">Loading graph...</div>
</if>
  </div>
  <div>
  	用户MEMBER注册 {$regnum}

<if condition="empty($finalMem)">
  
  <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有新用户注册</span>
<else />
<div id="graph3">Loading graph...</div>
</if>
  </div>
  <div>
  	中奖WIN金额 {$lucknum}

<if condition="empty($finalWin)">
  <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有用户中奖</span>
<else />
<div id="graph4">Loading graph...</div>
</if>
  </div>


<div>
  下单成交商品数量前十
       <br/>
        <table  cellspacing="0" style="border:gray solid 1px">
          <tbody>

    <tr>

      <th align="center" style=" width: 300px;color: gray">商品名称</th>
      <th align="center" style="color: gray">总交易数</th>
    </tr>

  <volist name="topArr" id="vo">
      <tr >
        <td>{$vo.0}</td>
        <td>{$vo.1}</td>
      </tr>
  </volist>

          </tbody>
        </table>

</div>

  <div>
  	活动抢币point_log赠送
<if condition="empty($finalPA)">
  <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有赠送活动抢币</span>
<else />
<div id="graph6">Loading graph...</div>
</if>
  </div>


<div>
    邀请好友抢币point_log赠送

<if condition="empty($finalPI)">
  <br>
  &nbsp&nbsp&nbsp&nbsp&nbsp <span style="color: gray">该段时间没有赠送活动抢币</span>
<else />
<div id="graph7">Loading graph...</div>
</if>
  </div> 
</div>


<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>

<script type="text/javascript" src="{$config_siteurl}statics/js/jscharts.js"></script>
<!-- <script src="statics/extres/duobao/Statistics/js/jquery.min.js"></script> -->
<!-- <script src="{$config_siteurl}statics/extres/duobao/Statistics/js/jquery.flot.min.js"></script> -->
</body>
</html>


<script type="text/javascript">



 function aa(){

  var myData = new Array({$finalStr});
  // var colors = {$colorA} ;
  var myChart = new JSChart('graph1', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorA});
  myChart.setTitle('chongzhi list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid(false);
  myChart.setSize({$len1}, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();  

 }

 function bb(){


  var myData = new Array({$finalStr});
  // var colors = {$colorA} ;
  var myChart = new JSChart('graph2', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorA});
  myChart.setTitle('xiaofei list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('date');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid(false);
  myChart.setSize({$len1}, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();  
 }


function cc(){

  var myData = new Array({$finalMem});
  // var colors = {$colorB} ;
  var myChart = new JSChart('graph3', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorB});
  myChart.setTitle('register list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('date');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid(false);
  myChart.setSize({$len3}, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();  
 
}


function dd(){


  var myData = new Array({$finalWin});
  var myChart = new JSChart('graph4', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorC});
  myChart.setTitle('prize list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('date');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid({$len4});
  myChart.setSize(700, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();
 } 


function ff(){


  var myData = new Array({$finalPA});
  var myChart = new JSChart('graph6', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorE});
  myChart.setTitle('point of activity list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('date');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid(false);
  myChart.setSize({$len6}, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();
 }

function gg(){
 
var wid = $(document).width();

  var myData = new Array({$finalPI});
  // var colors = {$colorC} ;
  var myChart = new JSChart('graph7', 'bar');
  myChart.setDataArray(myData);
  myChart.colorizeBars({$colorF});
  myChart.setTitle('point of invition list');
  myChart.setTitleColor('#8E8E8E');
  myChart.setAxisNameX('date');
  myChart.setAxisNameY('');
  myChart.setAxisColor('#C4C4C4');
  myChart.setAxisNameFontSize(16);
  myChart.setAxisNameColor('#999');
  myChart.setAxisValuesColor('#7E7E7E');
  myChart.setBarValuesColor('#7E7E7E');
  myChart.setAxisPaddingTop(60);
  myChart.setAxisPaddingRight(140);
  myChart.setAxisPaddingLeft(30);
  myChart.setAxisPaddingBottom(40);
  myChart.setTextPaddingLeft(105);
  myChart.setTitleFontSize(11);
  myChart.setBarBorderWidth(1);
  myChart.setBarBorderColor('#C4C4C4');
  myChart.setBarSpacingRatio(50);
  myChart.setGrid(false);
  myChart.setSize({$len7}, 321);
  myChart.setBackgroundImage('{$config_siteurl}statics/iamges/chart_bg.jpg');
  myChart.draw();
 } 




var a = '{$finalStr}';
var c = '{$finalMem}';
var d = '{$finalWin}';
var e = '{$finalTop}';
var f = '{$finalPA}';
var g = '{$finalPI}';

if (a) {
  aa();
  bb();
}

if (c) {
  cc();
}
if (d) {

  dd();
}

if (f) {
ff();
}

if (g) {
gg();
}
</script>
