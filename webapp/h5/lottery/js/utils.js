 // about cnzz
var _czc = _czc || [];
_czc.push(["_setAccount", "1256511550"]);
(function(){

    // var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    // var html = unescape("%3Cspan id='cnzz_stat_icon_1256511550'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1256511550%26show%3Dpic' type='text/javascript'%3E%3C/script%3E");
    // document.write('<div style="display:none">' + html + '</div>');
})();

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

function trackEvent(category, action, label, value) {
    _czc.push(["_trackEvent",category,action,label,value]);
}
