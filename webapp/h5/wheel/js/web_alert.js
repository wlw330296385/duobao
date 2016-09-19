var webAlert = {
    init: function() {
        var _html1 = '<div style="z-index:99; width: 100%; height: 100%; position: fixed; top:0; left:0; background:rgba(0, 0, 0, 0.4); display:none;" id="web_alert_tip">';
        _html1 += '<div style="position:absolute; z-index:3; background-color:#fff; top:35%; width: 90%; margin:0 5%; border-radius:5px;">';
        _html1 += '<div style="padding: 15px; color:#323232; font-size:18px;" id="alert_content_tip"></div>';
        _html1 += '<div style="margin: 5px 20px 15px 20px; padding: 10px; text-align:center; background-color:#ff5151; color:#fff; border-radius:5px; cursor:pointer;" id="alert_close_tip">确定</div></div>';
        _html1 += '<script type="text/javascript">';
        _html1 += '$("#alert_close_tip").click(function() {$("#web_alert_tip").hide();});';
        _html1 += '</script>';
        $('body').append(_html1);
        
        var _html2 = '<div style="z-index:99; width: 100%; height: 100%; position: fixed; top:0; left:0; background:rgba(0, 0, 0, 0.4); display:none;" id="web_alert_recharge">';
        _html2 += '<div style="position:absolute; z-index:3; background-color:#fff; top:35%; width: 90%; margin:0 5%; border-radius:5px;">';
        _html2 += '<img style="position:absolute; right:5px; top:5px; width:25px; cursor:pointer;" id="alert_close_submit_recharge" src="http://i.duobao369.com/201603071907326359.png"/>';
        _html2 += '<div style="padding: 15px; color:#323232; font-size:18px;" id="alert_content_recharge">您的抽奖机会不足，请立即充值！</div>';
        _html2 += '<div style="margin: 5px 20px 15px 20px; padding: 10px; text-align:center; background-color:#ff5151; color:#fff; border-radius:5px; cursor:pointer;" id="alert_close_recharge">点击充值</div></div>';
        _html2 += '<script type="text/javascript">';
        _html2 += '$("#alert_close_recharge").click(function() {$("#web_alert_recharge").hide();var platform=getPlatform(); if(platform=="android"){window.wst.openRechargePayFram("100");}else{loadURL("duobao://openRechargePayFram?money=100");}});';
        _html2 += '$("#alert_close_submit_recharge").click(function() {$("#web_alert_recharge").hide();})';
        _html2 += '</script>';
        $('body').append(_html2);

        var _html4 = '<div class="meng meng4" id="web_alert" style="display:none;"><div class="popup"><div class="popup_in"><img class="close"src="img/close.png"width="11%"><h2 id="web_alert_content"></h2><span id="web_alert_close"class="sure">确定</span><img class="pop_top"src="img/pop_top.png"width="100%"></div></div></div>';
        _html4 += '<script type="text/javascript">$("#web_alert .close, #web_alert #web_alert_close").click(function() {$("#web_alert").hide();});</script>';
        $('body').append(_html4);

        var _html5 = '<div class="meng meng4" id="web_alert_red" style="display:none;"><div class="popup"><div class="popup_in"><img class="close"src="img/close.png"width="11%"><h2 style="font-size:1.3rem"id="web_alert_red_content"></h2><span class="sure"id="web_alert_view">查看红包</span><img class="pop_top"src="img/pop_top.png"width="100%"></div></div></div>';
        _html5 += '<script type="text/javascript">$("#web_alert_red .close").click(function() {$("#web_alert_red").hide();});$("#web_alert_red #web_alert_view").click(function() {var platform=getPlatform();if(platform=="android"){openActivity("RedMoneyList", true, "", "", {});}else{openActivity("red_center", true, "", "", {target:"redbag"});};$("#web_alert_red").hide();});</script>';
        $('body').append(_html5);
    },
    show_tip: function(content) {
        $('#web_alert_tip #alert_content_tip').html(content);
        $('#web_alert_tip').show();
    },
    show: function(content) {
        $('#web_alert #web_alert_content').html(content);
        $('#web_alert').show();
    },
    show_recharge: function() {
        $('#web_alert_recharge').show();
    },
    show_red: function(content) {
        $('#web_alert_red_content').html(content);
        $('#web_alert_red').show();
    }
}


