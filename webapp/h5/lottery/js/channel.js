//http://v1.mob.pages.duobao369.com/js/utils.js required
//jquery required
function isWechat(){
    var ua = navigator.userAgent.toLowerCase();
    return ua.indexOf('micromessenger') != -1;
}
function isIphone(){
    var ua = navigator.userAgent.toLowerCase();
    return ua.indexOf('iphone') != -1 || ua.indexOf('ipad') != -1;
}
function getChannelId(){
    var params = parseParams();
    var channel_id = params.channel_id;
    if (typeof(channel_id) == 'undefined') {
        channel_id = params.s;
    }
    if(isIphone()){
        channel_id = channel_id || '9faa';
    } else{
        channel_id = channel_id || '9f64';
    }
    return channel_id;
}

function channelDisplay(channel_id){
    // if (channel_id == '5736' || channel_id == '57ef') {
    //     baidu_script = '<script>var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="//hm.baidu.com/hm.js?1e8748c58928e6906921876a1b55e289";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();</script>';
    //     $('body').append(baidu_script);
    // }

    var platform = 'android';
    var v = $('#v').attr('data-value');
    if( isIphone()){
        platform = 'ios';
    }
    // var api = 'http://rp.1yt.me/page_display?platform=' + platform + '&channel_id=' + channel_id + '&ver=' + v;
    // var d = $('<iframe>').attr('src', api).css('display','none');
    // $('body').append(d);

    trackEvent( v, channel_id, '展示');
    //trackEvent('展示' + v, channel_id);

    // if (channel_id == '5914') {
    //     var _html = '<script type="text/javascript" id="monitorpoint_t_p_c_e" src="https://f2.adpush.cn/stat/r3.js?t=1&l=0&bl=60&delay=0&r=.cntv.cn/adplayer/adBlockDetector/adv_index"></script>';
    //     var _html1 = '<script type="text/javascript" id="monitorpoint_t_p_c_e_d" src="https://f2.adpush.cn/stat/m3.js?t=2&l=2&count=1&r=.cntv.cn/adplayer/adBlockDetector/adv_index"></script>';
    //     $('body').append(_html).append(_html1);
    // }
    // if (channel_id == '592d') {
    //     var _html = '<!--Marketin--><script type="text/javascript">var _paq=_paq||[];_paq.push(["setCookieDomain","*.eclicks.cn"]);_paq.push(["trackPageView"]);_paq.push(["enableLinkTracking"]);(function(){var u="//wa.marketin.cn/";_paq.push(["setTrackerUrl",u+"tracker/"]);_paq.push(["setSiteId",10]);var d=document,g=d.createElement("script"),s=d.getElementsByTagName("script")[0];g.type="text/javascript";g.async=true;g.defer=true;g.src=u+"tracker/";s.parentNode.insertBefore(g,s)})();</script><noscript><p><img src="//wa.marketin.cn/tracker/?idsite=10"style="border:0;"alt=""/></p></noscript><noscript><p><img src="http://wa.marketin.cn/tracker/?idsite=10&rec=1"style="border:0"alt=""/></p></noscript><!--End Marketin Code-->';
    //     $('body').append(_html);
    // }
}

var channel_id = getChannelId();
channelDisplay(channel_id);


function download(mark){
    var channel_id = getChannelId();
    //trackEvent('渠道','点击' + mark, channel_id);

    var v = $('#v').attr('data-value');
    trackEvent( v, channel_id, '点击');
    //trackEvent('点击' + v, channel_id);

    var target = 'http://duobao.nntzd.com/webapp/dowload.html';
    if(isIphone()){
        target = 'https://appsto.re/cn/qrfh_.i';
        if(isWechat()){
            target = 'http://a.app.qq.com/o/simple.jsp?pkgname=com.tianzhidao.indiana&g_f=991653';
        } 
    } else {
        target = 'http://duobao.nntzd.com/app_update/Indianb.apk' ;
        if(isWechat()){
            target = 'http://a.app.qq.com/o/simple.jsp?pkgname=com.tianzhidao.indiana&g_f=991653';
//            target = 'http://a.app.qq.com/o/simple.jsp?pkgname=fw.cn.quanmin' ;
        }
    }

    /*if (channel_id == '5764') {
        target = 'http://www.1yt.me/downloads/1yuantao_1.1.4__jiagu_sign-5764.apk';
    } else if (channel_id == '5752') {
        target = 'http://www.1yt.me/downloads/1yuantao_1.1.4__jiagu_sign-5752.apk';
    }*/
    window.setTimeout(function(){ window.location.href = target;}, 200 );
}

// attach channel id
$('#download').on('click', function(){
    download('按钮');
});

$(window).on('scroll', function(){
    var v = $('#v').attr('data-value');
    trackEvent( v, channel_id, '滑动');
    //trackEvent('滑动'+v, channel_id );
});

//$(window).on('load',function(){
//    var v = $('#v').attr('data-value');
//    download('自动下载');
//});
