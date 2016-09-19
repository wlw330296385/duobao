$('#home_nav a').on('click',function(){
	var index=$(this).index();
	var a=$(this).attr('href');
	console.log(a)
	window.location.href=a;
})
//获取url路径上的参数
function GetQueryString(name) {
   var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
   var r = window.location.search.substr(1).match(reg);
   if (r!=null) return (r[2]); return null;
}

//这里计算倒计时

function timer(k)
{	
    var ts = k;//计算剩余的毫秒数
   
    var dd = parseInt(ts/60/60/60/24,10);//计算剩余的天数
    var hh = parseInt(ts/60/60/60%24,10);//计算剩余的小时数
    var mm = parseInt(ts/60/60% 60, 10);//计算剩余的分钟数
    var ss = parseInt(ts/60%60,10);//计算剩余的秒数
    var ms = parseInt(ts%60,10);//计算剩余的毫秒数
    dd = checkTime(dd);
    hh = checkTime(hh);
    mm = checkTime(mm);
    ss = checkTime(ss);
    ms = checkTime(ms);
    var res =mm+':'+ss+':'+ms; 
    if(k<=0){
        location.reload('true');
    }
   return res;
}
function checkTime(i)
{
    if (i < 10){ i = "0" + i;} return i;
}

function clock(b,newWin){											
	b--;
	a = timer(b);
	var str = '<a href="goods/goods.html?aid='+newWin[i].aid+'"><li class="mui-ellipsis"><img src="' + newWin[i].thumb + '" alt="" width="95%" /><div><span>第(' + newWin[i].section + ')期' + newWin[i].name + '</span><span class="green">' + a + '</span></div></li></a>';
	$('.three ul').append(str);
	};
	
function is_login(){
	var is_login=localStorage.getItem('db330296385_woo_user');
    var str=JSON.parse(is_login); 
        if(str==''||str ==undefined||str ==null||str==NaN||str==false){
        alert('请先登录');
        window.location.href='http://duobao.nntzd.com/index.php?g=Api&m=Getclient&a=index';
        return false
        }else{
           var uid=str.userid;
           var encrypt=str.encrypt;
           var userinfo;
            $.ajax({
            url:'http://duobao.nntzd.com/?g=DuoBao&m=Member&a=getInfo',
            type: 'get',
            data: {'uid':uid,'encrypt':encrypt},
            dataType: 'json',
            success:function(msg){
                if(msg){
                    var u=JSON.stringify(msg);
                    localStorage.setItem('db330296385_woo_user',u);
                }
            }
        })
            userinfo=localStorage.getItem('db330296385_woo_user');
            userinfo=JSON.parse(is_login);
            return userinfo;
        }
}
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?1ae2bf3e81df474afe7b96df997e2bf0";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();

//这里是分享到朋友圈
// $.getJSON('http://duobao.nntzd.com/index.php?g=Api&m=GetAppId&a=getAll','',function(msg){	
// var appid=msg.appid,timestamp=msg.timestamp,url=msg.url,nonceStr=msg.nonceStr,rawString=msg.rawString,signature=msg.signature;
// // alert(appid)
// // alert(timestamp)
// // alert(url)
// // alert(nonceStr)
// // alert(rawString)
// // alert(signature)
// var shareData = {
//         title: '我们一起做点小激动的事情吧!!参加一块夺宝!！', // 分享标题
//         link: 'http://duobao.nntzd.com/wx', // 分享链接
//         imgUrl: 'http://duobao.nntzd.com/wx/img/ico.png',
//         desc: '一块钱就能拍Iphone6 plus啦,这是一个集人品与节操于一身的时刻!我的小心脏一直啪啪啪地跳,肿么办！',
//         fail: function(res) {
//             alert(JSON.stringify(res));
//         }
//     };
//     wx.config({
//         'appId': appid,
//         'timestamp':timestamp,
//         'nonceStr':nonceStr,
//         'signature':signature,
//         'jsApiList': [
//             'checkJsApi',
//             'onMenuShareTimeline',
//             'onMenuShareAppMessage',
//             'onMenuShareQQ',
//             'onMenuShareWeibo'
//         ]
//     });
//     wx.ready(function() {
//         wx.onMenuShareAppMessage(shareData);
//         wx.onMenuShareTimeline(shareData);
//         wx.onMenuShareQQ(shareData);
//         wx.onMenuShareWeibo(shareData);
//     });
// })
  