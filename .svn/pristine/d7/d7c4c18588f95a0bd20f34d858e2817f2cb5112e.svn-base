
function getHostPage(path) {
	var host = window.location.host;
	// if (host.indexOf('mob.pages.duobao369.com') != -1) {
	// 	return "http://v1.mob.pages.duobao369.com" + path;
	// }
	// else if (host.indexOf('mob.pages.duobao999.com') != -1) {
	// 	return "http://v1.mob.pages.duobao999.com" + path;
	// }
	// else if (host.indexOf('mob.pages.zhuquzhou.com') != -1) {
	// 	return "http://v1.mob.pages.zhuquzhou.com" + path;
	// }
 //    else if (host.indexOf('dev.m.pages.zhuquzhou.com') != -1) {
 //        return 'http://dev.m.pages.zhuquzhou.com:7000' + path;
 //    }
	// else {
	// 	return "http://dev.m.pages.duobao369.com:7000" + path;
	// }
}

function getHostApi(path) {
	var host = window.location.host;
	// if (host.indexOf('mob.api.duobao369.com') != -1 || host.indexOf('mob.pages.duobao369.com') != -1) {
	// 	return "http://v1.mob.api.duobao369.com" + path;
	// }
	// else if (host.indexOf('mob.api.zhuquzhou.com') != -1 || host.indexOf('mob.pages.zhuquzhou.com') != -1) {
	// 	return "http://v1.mob.api.zhuquzhou.com" + path;
	// }
	// else if (host.indexOf('mob.api.duobao999.com') != -1 || host.indexOf('mob.pages.duobao999.com') != -1) {
	// 	return "http://v1.mob.api.duobao999.com" + path;
	// }
 //    else if (host.indexOf('dev.m.api.zhuquzhou.com') != -1 || host.indexOf('dev.m.pages.zhuquzhou.com') != -1) {
 //        return 'http://dev.m.api.zhuquzhou.com:7000' + path;
 //    }
	// else {
	// 	return "http://dev.m.api.duobao369.com:7000" + path;
	// }
}

function parseParams(url){
    if( url == undefined){
        url = window.location.href;
    }   
    var indexOfQ = url.indexOf('?');
    if( indexOfQ == -1){
        return {}; 
    }   
    var search = url.slice(indexOfQ + 1); 
    var hashes = search.split('&');
    var params = {};
    for(var i = 0; i < hashes.length; i++){
        var hash = hashes[i].split('=', 2); 
        if ( hash.length == 1){ 
            params[hash[0]] = ''; 
        } else {
            params[hash[0]] = decodeURIComponent(hash[1]).replace(/\+/g, " ");
        } 
    }
    return params;
}

function getPlatform(){
    var params = parseParams();
	if (params.platform == null) {
		try{
			if (/iPhone|iPod/i.test(navigator.userAgent)) {
				return 'ios';
			}
			else if (/Android/i.test(navigator.userAgent)) {
				return 'android';
			}
		}catch(e){}
	}
    if(params.platform == 'android'){
        return  'android';
    }else if(params.platform == 'ios'){
        return 'ios';
    }
}

function getParam(key){
    var params = parseParams();
    return params[key];
}

function serialize(obj){
    var params_ss = [];
    for(var p in obj){
        if (obj.hasOwnProperty(p)){
            params_ss.push(encodeURIComponent(p) + '=' + encodeURIComponent(obj[p]));
        }
    }
    return params_ss.join('&');
}

function urlencodeJSON(obj){
    var new_obj = {};
    for(var p in obj){
        if(obj.hasOwnProperty(p)){
            new_obj[encodeURIComponent(p)] = encodeURIComponent(obj[p]);
        }
    }
    return JSON.stringify(new_obj);
}

function openPage(title, method, uri,  params){
    //原生的打开页面
    var platform = getPlatform();
    //var platform = getParam('platform');
    if(platform == 'android'){
        window.android_js.open_page(title, method, uri, serialize(params));
    } else if(platform == 'ios'){
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({"cmd":"openPage","title":title, "method": method, "uri": uri, "params": serialize(params)})));         
    }
}

function openActivity(activity_name,is_finish,title,back_title,params){
    var platform = getPlatform();
    if(platform == 'ios'){
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({"cmd":"open_activity","activity_name":activity_name, "is_finish": is_finish, "title": title, "params": serialize(params)})));
        // window.location.href = ('ios://'+ encodeURIComponent({cmd: 'open_activity', activity_name:activity_name, is_finish:is_finish, title:title, params: params.replace(new RegExp('"',"g"),"'")}));
    }else if (platform == 'android'){
        window.android_js.open_activity(activity_name, is_finish, title, back_title, JSON.stringify(params));
    }    
}

function openShare(title, body) {
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.app_share(title, body);
    }else {
        window.location.href = ('ios://'+ encodeURIComponent({cmd: 'openShare', title:title,content:body}));
    }
}

function openShareSDK(title, body, url, images) {
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.share_sdk(title, body, url, images);
    }else {
         body = body.substring(0,body.length-1);
        window.location.href = ("ios://"+encodeURIComponent(JSON.stringify({"cmd":"share","title":title,"shareurl":url,"iconurl":images,"msg":body})));
        
    }
}

function nativeHttpRequest(method, uri, params, msg, callback_name){
    //原生的http请求
   var platform = getPlatform();
    if(platform == 'ios'){
        // window.location.href = "ios://"+serialize(params);
        // window.open('ios://' + encodeURIComponent(JSON.stringify({"cmd":"nativeHttpRequest","method":method,"uri":uri,"params":serialize(params).replace(new RegExp('"',"g"),"'"),"msg":msg,"callback_name":callback_name})));
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({"cmd":"nativeHttpRequest","method":method,"uri":uri,"params":serialize(params),"msg": msg,"callback_name":callback_name})));
        // alert("提交中...");

    }else if (platform == 'android'){
        window.android_js.http_request(method, uri, JSON.stringify(params), msg, callback_name);
    }
}

function nativeTip(msg){
    //原生的提示
    var platform = getPlatform();
   if(platform == 'android'){
        window.android_js.tip_msg(msg);
    }else{        

        window.location.href = ("ios://"+encodeURIComponent(JSON.stringify({"cmd":"nativeTip","msg":msg})));
    }
}

function nativeAlert(title,msg){
    //原生的警告框
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.tip_err(title,msg);
    } else{
        window.open('ios://'+ encodeURIComponent(JSON.stringify({"cmd":"nativeAlert",title:title,msg:msg})));
    }
}

function nativeAlertBtn(title,msg,btn,callback){
    //原生的提示框（带自定义按钮）
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.tip(title,msg,btn,callback);
    } else{
        window.open('ios://'+ encodeURIComponent(JSON.stringify({cmd: 'nativeAlertBtn', title:title, msg:msg, btn:btn, callback:callback})));
    }
}

function nativeShowDynamicMask(mask_id, images, url, activity_name, activity_params, is_show_close_btn, is_cancel, is_back_key) {
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.show_dynamic_mask(mask_id, images, url, activity_name, JSON.stringify(activity_params), is_show_close_btn, is_cancel, is_back_key);
    } else {
        var href = ('ios://' + encodeURIComponent(JSON.stringify({cmd:"show_dynamic_mask", mask_id:mask_id, images:images, url:url, activity_name:activity_name, is_show_close_btn:is_show_close_btn, is_cancel:is_cancel, is_back_key:is_back_key, activity_params: serialize(activity_params)})));
        nativeAlert('tip', href);
        window.location.href = href;
    }
}

function openPageWithParams(title, method, uri,  params, web_params){
    //原生的打开页面
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.open_page(title, method, uri, serialize(params), JSON.stringify(web_params));
    } else if(platform == 'ios'){
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({"cmd":"openPage","title":title, "method": method, "uri": uri, "params": serialize(params), "web_params":JSON.stringify(web_params)})));         
    }
}

function nativeOpenRecharge() {
    var platform = getPlatform();
    if (platform == 'ios') {
      openActivity('recharge', true, '充值', '', {target:"recharge"});
    } else {
      openActivity('Recharge', true, '充值', '', '{}');
    }
}

function titleBarShare(callback) {
    var platform = getPlatform();
    if (platform == 'ios') {
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({cmd:"menu_right_share", callback_name:callback})));
    } else {
        window.android_js.menu_right_share(callback);
    }
}

function titleBarRightWithIcon(icon_url, callback) {
    var platform = getPlatform();
    if (platform == 'ios') {
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({cmd:"menu_right_ico", callback_name:callback, icon_url:icon_url})));
    } else {
        window.android_js.menu_right_ico(icon_url, callback);
    }
}

function titleBarRightWithText(title, callback) {
    var platform = getPlatform();
    if (platform == 'ios') {
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({cmd:"menu_right_callback_js", callback_name:callback, title:title})));
    } else {
        window.android_js.menu_right_callback_js(title, callback);
    }
}

function nativeLogin(account, password, go_act){
    //原生登录
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.login(account, password, go_act);        
    }else{      
        window.open('ios://'+ encodeURIComponent(JSON.stringify({"cmd":"login","phone":account,"password":password})));
    }
}

function nativeRecharge(recharge_channel, money, callback_name){
    //支付
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.recharge(recharge_channel, money, callback_name);
    } else{
        window.open('ios://' + encodeURIComponent(JSON.stringify({"cmd":"nativeRecharge","recharge_channel":recharge_channel,"money":money,"callback_name":callback_name})));
    }
}

function nativeRechargeNew(money, prize_id){
    //支付新接口（prize_id大于0时为购买）
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.recharge(money, prize_id);
    } else{
		openPage('充值', 'GET', getHostPage('/recharge.html'), {});
    }
}

function nativeaAtiviyClose() {
    //关闭原生页面
	var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.app_finish();
    } else{         
        window.location.href = ('ios://' + encodeURIComponent(JSON.stringify({"cmd":"app_finish"})));
    }
}

function nativeaClearCache() {
	//原生清理缓存
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.clear_cache();
    }else{
         window.open("ios://"+encodeURIComponent(JSON.stringify({"cmd":"clear_cache"})));        
    }
}
function setUserHeader() {
	//设置用户头像
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.user_header();
    }else{
         window.open("ios://"+encodeURIComponent(JSON.stringify({"cmd":"setHeader"})));        
    }
}

function show_buy_code(title,url,code){
    //查看参与号码
    var platform = getPlatform();
    if(platform == 'android'){
        window.android_js.show_buy_code(title,url,code);
    } else{        
        window.open('ios://'+ encodeURIComponent(JSON.stringify({"cmd":"show_buy_code",title:title, url: url, code: code})));        
    }
}

function open_prize(prize_id) {
    //查看奖品详情
    var platform = getPlatform();
    if (platform == 'android'){
		var pms = parseParams();
		var app_version = pms.app_version;
		if (app_version != null && parseInt(app_version) > 26) {
			openActivity("PrizeDetail",false,"奖品详情","",{'prize_id':prize_id});
			return;
		}
    }
	openPage('奖品详情', 'GET', getHostPage('/prize_detail.html'), {'prize_id':prize_id});
}

function prize_buy(prize_id) {
    //openPage('提交订单', 'GET', getHostPage('/buy.html'), {'prize_id':prize_id});
    var params = {'prize_id':prize_id};
    var platform = getPlatform();
    if (platform == 'android') {	
		var pms = parseParams();
		var app_version = pms.app_version;
		if (app_version == null || parseInt(app_version) < 19) {
			window.android_js.order_buy('提交订单', getHostPage('/buy.html'), serialize(params));
		}
		else {
            
			window.android_js.prize_buy(prize_id, JSON.stringify(params));
		}
    }else{
        openPage('提交订单', 'GET', getHostPage('/buy.html'), params);
    }
}
function prize_buy_ok() {
	//购买成功
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.order_buy_result();
    }else{
        window.open("ios://"+encodeURIComponent(JSON.stringify({"cmd":"home","uri":getHostPage("/buy_history.html")})));               
    }
}

function logout() {
	//退出登录
    var platform = getPlatform();
    if (platform == 'android') {
        window.android_js.logout();
    }else{
        window.open("ios://"+encodeURIComponent(JSON.stringify({"cmd":"logout"})));
    }    
}

function bandUserHeader(avatar_str, image) {
	//绑定用户头像(路径，控件)
	if (avatar_str != null && avatar_str != "" && avatar_str != "null" && avatar_str != "undefined") {
		image.attr("src", avatar_str);
	}
	else {
		image.attr("src", '/images/user.png');
	}
}

function other_user_conter(user_id) {
	openPage('用户中心', 'GET', getHostPage('/other_center.html'), {'user_id':user_id});
}

function bandNoData(img) {
	//绑定无数据图片
	$('.no_data_display').show();
	if (img != null && img != '') {
		//img = '../images/no_data.png';
		$('.no_data_display').css("background-image","url(" + img + ")");
	}
}

function trackEvent(category, action, value) {
    var label = getPlatform();
}

function checkIframe(){
    $('iframe').each(function(i, r){
        trackEvent('iframe', $(r).attr('src'), 1);
    });
}

//从这里开始是夺宝的基础加载
function loadURL(url) {
    var iFrame;
    iFrame = document.createElement("iframe");
    iFrame.setAttribute("src", url);
    iFrame.setAttribute("style", "display:none;");
    iFrame.setAttribute("height", "0px");
    iFrame.setAttribute("width", "0px");
    iFrame.setAttribute("frameborder", "0");
    document.body.appendChild(iFrame);
    // 发起请求后这个 iFrame 就没用了，所以把它从 dom 上移除掉
    iFrame.parentNode.removeChild(iFrame);
    iFrame = null;
}
