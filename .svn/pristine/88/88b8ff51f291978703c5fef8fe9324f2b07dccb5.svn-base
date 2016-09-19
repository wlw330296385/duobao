	function parseQueryString()
	{
		alert("789");
		var url = decodeURI(window.location.href);
		// alert(url);
		var obj={};
		var keyvalue=[];
		var key="",value=""; 
		var paraString=url.substring(url.indexOf("?")+1,url.length).split("&");
		for(var i in paraString)
		{
			
			keyvalue=paraString[i].split("=");
			
			alert(keyvalue);
			// alert(keyvalue);
			
//			key=keyvalue[0];
//			value=keyvalue[1];
//
//			obj[key]=value;
			
//			var u = navigator.userAgent, app = navigator.appVersion;
//			var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
//			var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
//				
//			if(isiOS == true)
//			{
//				key=keyvalue[0];
//				value=keyvalue[1];
////				value = EncodeUtf8(value);
//				if(key == "uId"){
//					value = unescape(value);
//				}
//				
//				obj[key]=value;
////				key = "uId";
////				obj[key] = "undefine";
//			}else
//			{
				key=keyvalue[0];
				value=keyvalue[1];
	
				obj[key]=value;
//			}
		} 
		
		var u = navigator.userAgent, app = navigator.appVersion;
			var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Linux') > -1; //android终端或者uc浏览器
			var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
				
			if(isiOS == true)
			{
//				key=keyvalue[0];
//				value=keyvalue[1];
//				value = EncodeUtf8(value);
//				value = unescape(value);
//				obj[key]=value;
				key = "uId";
				obj[key] = "undefine";
			}
		
		return obj;
	}
	
	function getCookie(name){ 
		var strCookie=document.cookie; 
		var arrCookie=strCookie.split("; "); 
		for(var i=0;i<arrCookie.length;i++){ 
			var arr=arrCookie[i].split("="); 
			if(arr[0]==name)return arr[1]; 
		} 
		return ""; 
	} 
	
	function addCookie(name,value,expiresHours){ 
		var cookieString=name+"="+escape(value); 
		//判断是否设置过期时间 
		if(expiresHours>0){ 
			var date=new Date(); 
			date.setTime(date.getTime+expiresHours*3600*1000); 
			cookieString=cookieString+"; expires="+date.toGMTString(); 
		} 
		document.cookie=cookieString; 
	} 
	
	function getTimeStr(beginTime,endTime)
	{
		var tBeginTime = new Date(beginTime*1000);
		var tEndTime = new Date(endTime*1000);
		var week = getWeekStr(tBeginTime);
		var month = tBeginTime.getMonth() + 1;
		var day = tBeginTime.getDate();
		
		var hours = tBeginTime.getHours();
		var minutes = tBeginTime.getMinutes();
		
		var endMouth = tEndTime.getMonth()+1;
		var endday = tEndTime.getDate();
		var endHours = tEndTime.getHours();
		var endMinutes = tEndTime.getMinutes();
		
		
		
		var timeStr = getStrTwoChatater(month)+'/'+getStrTwoChatater(day)+' '+getStrTwoChatater(hours)+':'+getStrTwoChatater(minutes)+'-'+getStrTwoChatater(endMouth)+'/'+getStrTwoChatater(endday)+' '+getStrTwoChatater(endHours)+':'+getStrTwoChatater(endMinutes);
		return timeStr;
		
	}
	
	function getStrTwoChatater(tStr)
	{
		if(tStr < 10 && tStr != 0)
		{
			tStr = '0'+tStr;
		}else if(tStr == 0){
			tStr = '00';
		}
		return tStr;
	}
	
	function getCommentTimeStr(aTime)
	{
		var tBeginTime = new Date(aTime*1000);
		var month = tBeginTime.getMonth() + 1;
		var day = tBeginTime.getDate();
		
		var hours = tBeginTime.getHours();
		var minutes = tBeginTime.getMinutes();
		
		var timeStr = month+'-'+day+' '+hours+':'+minutes;
		return timeStr;
	}
	
	function getWeekStr(date)
	{
		var week;
		if(date.getDay()==0){
			week="星期日";
		}
			
		if(date.getDay()==1){
			week="星期一";
		}
			
		if(date.getDay()==2){
			week="星期二";
		}
			
		if(date.getDay()==3){
			week="星期三";
		}
			
		if(date.getDay()==4){
			week="星期四";
		}
			
		if(date.getDay()==5){
			week="星期五";
		}
			
		if(date.getDay()==6){
			week="星期六";
		}
			
		return week;
	}
	
	// 字符串转换utf-8  
    function EncodeUtf8(s1)  
    {  
        // escape函数用于对除英文字母外的字符进行编码。如“Visit W3School!”->"Visit%20W3School%21"  
        var s = escape(s1);  
        var sa = s.split("%");//sa[1]=u6211  
        var retV ="";  
        if(sa[0] != "")  
        {  
            retV = sa[0];  
        }  
        for(var i = 1; i < sa.length; i ++)  
        {  
            if(sa[i].substring(0,1) == "u")  
            {  
                retV += Hex2Utf8(Str2Hex(sa[i].substring(1,5)));  
                if(sa[i].length>=6)  
                {  
                    retV += sa[i].substring(5);  
                }  
            }  
            else retV += "%" + sa[i];  
        }  
        return retV;  
    }  
    function Str2Hex(s)  
    {  
        var c = "";  
        var n;  
        var ss = "0123456789ABCDEF";  
        var digS = "";  
        for(var i = 0; i < s.length; i ++)  
        {  
            c = s.charAt(i);  
            n = ss.indexOf(c);  
            digS += Dec2Dig(eval(n));  
              
        }  
        //return value;  
        return digS;  
    }  
    function Dec2Dig(n1)  
    {  
        var s = "";  
        var n2 = 0;  
        for(var i = 0; i < 4; i++)  
        {  
            n2 = Math.pow(2,3 - i);  
            if(n1 >= n2)  
            {  
                s += '1';  
                n1 = n1 - n2;  
            }  
            else  
            s += '0';  
              
        }  
        return s;  
          
    }  
    function Dig2Dec(s)  
    {  
        var retV = 0;  
        if(s.length == 4)  
        {  
            for(var i = 0; i < 4; i ++)  
            {  
                retV += eval(s.charAt(i)) * Math.pow(2, 3 - i);  
            }  
            return retV;  
        }  
        return -1;  
    }  
    function Hex2Utf8(s)  
    {  
        var retS = "";  
        var tempS = "";  
        var ss = "";  
        if(s.length == 16)  
        {  
            tempS = "1110" + s.substring(0, 4);  
            tempS += "10" +  s.substring(4, 10);  
            tempS += "10" + s.substring(10,16);   
            var sss = "0123456789ABCDEF";   
            for(var i = 0; i < 3; i ++)   
            {   
                retS += "%";   
                ss = tempS.substring(i * 8, (eval(i)+1)*8);   
                  
                  
                  
                retS += sss.charAt(Dig2Dec(ss.substring(0,4)));   
                retS += sss.charAt(Dig2Dec(ss.substring(4,8)));   
            }   
            return retS;   
        }   
        return "";   
    } 
