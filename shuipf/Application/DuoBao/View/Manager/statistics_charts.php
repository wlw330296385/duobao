<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body>

<div class="wrap">
  <!-- <div>
    <a href="javascript:;">7天</a>
    <a href="javascript:;">30天</a>
    <a href="javascript:;">年</a>
  </div> -->
  <div id="reg" style="width: 90%;height:400px;"></div>
  <div id="pay" style="width: 90%;height:400px;"></div>
</div>
<script src="{$config_siteurl}statics/js/echarts.common.min.js?v"></script>
<script type="text/javascript">
  function get_option(name,numname,xdata,sdata){
    return {
        title: {
            text: name
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:[numname]
        },
        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis : [{
                type : 'category',
                boundaryGap : false,
                data : xdata
            }],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [{
              name:numname,
              type:'line',
              stack: '总量',
              areaStyle: {normal: {}},
              data:sdata
          }]
    };
  }

  $(function(){    
    var regChart = echarts.init(document.getElementById('reg'));
    var payChart = echarts.init(document.getElementById('pay'));
    regChart.showLoading();
    payChart.showLoading();
    $.getJSON("{:U('Manager/charts')}",function(data){
      console.log(data);
        regChart.hideLoading();
        var reg_option = get_option('注册统计图','注册量',data.days,data.reg);
        regChart.setOption(reg_option);
        payChart.hideLoading();
        var pay_option = get_option('支付统计图','金额',data.days,data.pay);
        payChart.setOption(pay_option);
    })    
  })
</script>
<script src="{$config_siteurl}statics/js/common.js?v"></script>
<script src="{$config_siteurl}statics/js/content_addtop.js"></script>
</body>
</html>