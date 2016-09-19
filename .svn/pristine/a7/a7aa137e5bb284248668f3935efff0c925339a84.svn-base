function get_number() {
    var today = new Date();
    var month = today.getMonth() + 1;
    var day = format_number(today.getDate());
    var hour = format_number(today.getHours());
    var minute = format_number(today.getMinutes());
    var seconds = format_number(today.getSeconds());
    
    var tmp_1 = parseInt('' + month + day);
    var tmp_2 = parseInt('' + hour + minute + seconds);
    var number = (tmp_1 * 1024 / 800 - 301 + tmp_2).toString();
    if (number.indexOf('.') != -1) {
        number = number.split('.')[0];
    }
    return number;
}

function get_number_2() {
    var number = 0;
    var today = new Date();
    var start_day = new Date(today.getFullYear(), today.getMonth(), today.getDate(), 0, 0, 0);
    var ran_number = ((today - start_day) / 1000).toFixed();

    number = parseInt((12546 * parseInt(ran_number) / 86400).toFixed()) + 168;
    return number;
}

function format_number(number) {
    if (number < 10) {
        return '0' + number;
    }
    return number;
}
//分享按钮跳出来的信息
function lottery_share(callback_func) {

    //var title = '今天有' + get_number() + '人在幸运大转盘中获奖！';
    var tmp_random = Math.random() * 10;
    // 0-9
    if (tmp_random >= 2) {
        var title = '今天已有384523人一元抽中iPhone6S';
        var body = title;
        var url = 'http://duobao.nntzd.com/webapp/h5/wheel_share/?f=app' + Math.random();
        var img_url = 'http://7xja1h.com2.z0.glb.qiniucdn.com/1460542915';
    } else {
        var title = '一元能买什么？赶紧试试手气~';
        var body = title;
        var url = 'http://duobao.nntzd.com/webapp/h5/wheel_share/?f=app';
        var img_url = 'http://7xja1h.com2.z0.glb.qiniucdn.com/1460016076';
    }
    //var img_url = 'http://i.duobao369.com/20160308163941522.jpg';
    // var callback_url = 'activity/raffle_share';
    // var callback_func = callback_func;
    var platform = getPlatform();

    if (platform == 'android') {
        window.wst.openShareFram(title,url);
    } else if (platform == 'ios') {
        loadURL("duobao://openShareFram?title="+title+"&url="+url);
    }
    $.getJSON('http://duobao.nntzd.com/index.php?g=Api&m=Activity&a=share',getpar,function(ret){
        if(ret){
            setTimeout(function(){window.location.reload();},3000);
        }
        
    });
    
}

function share_callback() {
    trackEvent('幸运大抽奖', '分享成功');
    window.location.reload();
}

