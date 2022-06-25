
/**
 * ajax
 * @param request
 */
function ajax(request) {
    let xhr = new XMLHttpRequest();
    let method  = request.method;
    let url     = request.url;
    let data    = request.data;
    let success = request.success;
    let error   = request.error;
    let urlEncode = function (param, key, encode) {
        if(param == null) return '';
        let paramStr = '';
        let t = typeof (param);
        if (t === 'string' || t === 'number' || t === 'boolean') {
            paramStr += '&' + key + '=' + ((encode == null || encode) ? encodeURIComponent(param) : param);
        } else {
            for (let i in param) {
                let k = key == null ? '"'+i+'"' : key + (param instanceof Array ? '[' + i + ']' : '.' + i);
                paramStr += urlEncode(param['"'+i+'"'], k, encode);
            }
        }
        return paramStr
    };
    data = urlEncode(data).slice(1);
    if (method.toUpperCase() === 'GET') {
        url += ((url.indexOf('?') === -1) ? '?' : '&') + data;
    }
    xhr.open(method, url);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send(data);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            success(xhr.responseText);
        } else {
            error(xhr.statusText);
        }
    };
}

/**
 * get param form url
 * @param paramName
 * @returns {string|*}
 */
function getUrl(paramName)
{
    let paramValue = "";
    let isFound = false;
    if(paramName === 'UrlHost')
        return this.location.host ;
    if (this.location.search.indexOf("?") === 0 && this.location.search.indexOf("=") > 1)
    {
        let arrSource = unescape(this.location.search).substring(1,this.location.search.length).split("&");
        i = 0;
        while (i < arrSource.length && !isFound)
        {
            if (arrSource[i].indexOf("=") > 0)
            {
                if (arrSource[i].split("=")[0].toLowerCase() === paramName.toLowerCase())
                {
                    paramValue = arrSource[i].split("=")[1];
                    isFound = true;
                }
            }
            i++;
        }
    }
    return paramValue;
}

