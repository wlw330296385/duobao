var ___site___ = 'http://duobao.nntzd.com/';
var app = {
	GET:function(name){
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");
	var r = window.location.search.substr(1).match(reg);
	   if (r!=null) return (r[2]); return null;
	}
};