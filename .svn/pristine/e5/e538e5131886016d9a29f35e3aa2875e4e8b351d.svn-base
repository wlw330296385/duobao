window.onload = function(){

	var aid = GetQueryString('aid');
	Ajax.request('http://duobao.nntzd.com/?g=DuoBao&a=getactivity',{
	    data : 'aid='+aid,
        success : function(xhr){
            var data = JSON.parse(xhr.responseText);
            if(data){
                //$("#username").innerHTML = data.nickname;
                // console.log(data.thumb);
                $("#pd-img").setAttribute("src", data.thumb);
                $("#period").innerHTML = data.section;
                $("#description").innerHTML = data.name;
                $("#number").innerHTML = data.money;
            }
            
        },
        failure : function(xhr){
            console.log(xhr);
    	}
	});
    var u = navigator.userAgent, app = navigator.appVersion;
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
    var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端

	var uid = GetQueryString('uid');
	var enc = GetQueryString('encrypt');
    var fr = GetQueryString('f');
    var apkurl = 'http://a.app.qq.com/o/simple.jsp?pkgname=com.tianzhidao.indiana&g_f=991653';
    if(fr == 'c' && isAndroid){
        // document.getElementById('logo').src = 'http://img1.nntzd.com/static/ic_myicon.png';
        apkurl = 'http://img1.nntzd.com/static/duobao/app/Indianc.apk';
        document.getElementById('tip').style.display = '';
    }
	Ajax.request('http://duobao.nntzd.com/?g=DuoBao&m=Member&a=getInfo&uid='+uid+'&encrypt='+enc,{
	//Ajax.request('http://duobao.nntzd.com/?g=DuoBao&m=Member&a=getInfo&uid=16&encrypt=ms5Khe',{
		
	    data : '',
        success : function(xhr){
        	console.log(xhr);
            var data = JSON.parse(xhr.responseText);
            $("#username").innerHTML = data.nickname;
            $("#user-img").setAttribute("src", data.userpic);
        },
        failure : function(xhr){
            console.log(xhr);
    	}
	});
	

	$('#praise').onclick = function(){
		window.location.href = apkurl;
	}
	$('#downbtn').onclick = function(){
		window.location.href = apkurl;
	}


}

function $(ele){
	var doc = document;
	return doc.querySelector(ele);
}



function GetQueryString(name){
	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
	var r = window.location.search.substr(1).match(reg);
	if(r!=null)return unescape(r[2]); return null;
}

/**
 * 执行基本ajax请求,返回XMLHttpRequest
 * Ajax.request(url,{
 *      async   是否异步 true(默认)
 *      method  请求方式 POST or GET(默认)
 *      data    请求参数 (键值对字符串)
 *      success 请求成功后响应函数，参数为xhr
 *      failure 请求失败后响应函数，参数为xhr
 * });
 *
 */
var Ajax = function(){
    function request(url,opt){
        function fn(){}
        var async   = opt.async !== false,
            method  = opt.method    || 'GET',
            data    = opt.data      || null,
            success = opt.success   || fn,
            failure = opt.failure   || fn;
            method  = method.toUpperCase();
        if(method == 'GET' && data){
            url += (url.indexOf('?') == -1 ? '?' : '&') + data;
            data = null;
        }
        var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        xhr.onreadystatechange = function(){
            _onStateChange(xhr,success,failure);
        };
        xhr.open(method,url,async);
        if(method == 'POST'){
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded;');
        }
        xhr.send(data);
        return xhr;
    }
    function _onStateChange(xhr,success,failure){
        if(xhr.readyState == 4){
            var s = xhr.status;
            if(s>= 200 && s < 300){
                success(xhr);
            }else{
                failure(xhr);
            }
        }else{}
    }
    return {request:request};  
}();

// Ajax.request('servlet/ServletJSON',{
//         data : 'name=jack&age=20',
//         success : function(xhr){
            
//         },
//         failure : function(xhr){
            
//         }
//     }
// );