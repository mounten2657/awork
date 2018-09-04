
function ajax(method, url, data, callback) {
    let xhr = new XMLHttpRequest();
    let urlEncode = function (param, key, encode) {
        if(param==null) return '';
        let paramStr = '';
        let t = typeof (param);
        if (t === 'string' || t === 'number' || t === 'boolean') {
            paramStr += '&' + key + '=' + ((encode==null||encode) ? encodeURIComponent(param) : param);
        } else {
            for (let i in param) {
                let k = key == null ? '"'+i+'"' : key + (param instanceof Array ? '[' + i + ']' : '.' + i);
                paramStr += urlEncode(param['"'+i+'"'], k, encode);
            }
        }
        return paramStr
    };
    data = urlEncode(data).slice(1);
    if (method.toLowerCase() === 'get') {
        url += ((url.indexOf('?') === -1) ? '?' : '&') + data;
    }
    xhr.open(method, url);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback(xhr.responseText);
        }
    };
}
