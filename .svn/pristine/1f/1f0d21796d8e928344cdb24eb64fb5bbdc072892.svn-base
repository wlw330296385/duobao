function get_rp_host() {
    var host = window.location.host;
    var tmp_array = host.split(':');
    if (tmp_array.length > 1) {
        host = tmp_array[0];
    }
    var arrs = host.split('.');
    var length = arrs.length;
    return 'http://rp.' + arrs[length - 2] + '.' + arrs[length - 1];
}

function collectDisplay(collect_id) {
    
    var api = get_rp_host() + '/collect?a=activity&platform=' + getPlatform() + '&t=show&activity_id=' + collect_id;
    var user_id = getParam('user_id');
    if (typeof(user_id) != 'undefined' && user_id > 0) {
        api += '&user_id=' + user_id;
    }
    var mac = getParam('mac');
    if (typeof(mac) != 'undefined') {
        api += '&mac=' + mac;
    }
    var _html = '<iframe src="' + api + '" style="display:none;" />';
    $('body').append(_html);
}

function collectClick(collect_id) {
    var api = get_rp_host() + '/collect?a=activity&platform=' + getPlatform() + '&t=click_visit&activity_id=' + collect_id;
    var user_id = getParam('user_id');
    if (typeof(user_id) != 'undefined' && user_id > 0) {
        api += '&user_id=' + user_id;
    }
    var mac = getParam('mac');
    if (typeof(mac) != 'undefined') {
        api += '&mac=' + mac;
    }
    var _html = '<iframe src="' + api + '" style="display:none;" />';
    $('body').append(_html);
}

function collectJoin(collect_id) {
    var api = get_rp_host() + '/collect?a=activity&platform=' + getPlatform() + '&t=join&activity_id=' + collect_id;
    var user_id = getParam('user_id');
    if (typeof(user_id) != 'undefined' && user_id > 0) {
        api += '&user_id=' + user_id;
    }
    var mac = getParam('mac');
    if (typeof(mac) != 'undefined') {
        api += '&mac=' + mac;
    }
    var _html = '<iframe src="' + api + '" style="display:none;" />';
    $('body').append(_html);
}

function collectShare(collect_id) {
    var api = get_rp_host() + '/collect?a=activity&platform=' + getPlatform() + '&t=share&activity_id=' + collect_id;
    var user_id = getParam('user_id');
    if (typeof(user_id) != 'undefined' && user_id > 0) {
        api += '&user_id=' + user_id;
    }
    var mac = getParam('mac');
    if (typeof(mac) != 'undefined') {
        api += '&mac=' + mac;
    }
    var _html = '<iframe src="' + api + '" style="display:none;" />';
    $('body').append(_html);
}
