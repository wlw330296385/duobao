// 在template当中调用函数
template.helper('time', function (t) {
   return new Date(parseInt(t) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
});

template.helper('split', function (t) {
    var data = t.split("|")
    return data;
});

template.helper('sub', function (t) {
    var data=t.substr(0,7);
    return data;
});

template.helper('flo', function (t) {
    var data=parseInt(t);
    return data;
});


