
//网站根路径
function getBaseUrl()
{
    return $('#web_base_url').text();
}
var base_url = getBaseUrl();

//实时时间
function getNowTime()
{
    //获取当前时间并格式化为时间戳
    let timestamp = parseInt((new Date()).getTime()/1000);
    //将时间写入标签
    let str = '';
    let strLen = timestamp%4;
    if (3 === strLen) strLen = 1;
    for (let i=0; i < 3; i++) {
        if (i <= strLen) {
            str += '.';
        } else {
            str += "&nbsp;";
        }
    }
    $('#now_time').html('<' + timestamp + str + '>');
    $('#now_date_record').html(formatTime(timestamp));
}

//时间戳转日期格式
function formatTime (timestamp)
{
    let unixtimestamp = new Date(timestamp*1000);
    let year = 1900 + unixtimestamp.getYear();
    let month = "0" + (unixtimestamp.getMonth() + 1);
    let date = "0" + unixtimestamp.getDate();
    let hour = "0" + unixtimestamp.getHours();
    let minute = "0" + unixtimestamp.getMinutes();
    let second = "0" + unixtimestamp.getSeconds();
    return year + "-" + month.substring(month.length-2, month.length)  + "-" + date.substring(date.length-2, date.length)
        + " " + hour.substring(hour.length-2, hour.length) + ":"
        + minute.substring(minute.length-2, minute.length) + ":"
        + second.substring(second.length-2, second.length);
}

//日期转时间戳
function formatDate(timeDate)
{
    let time = new Date(timeDate.replace(/-/g,"/"));
    let timeInt = time.getTime();
    return parseInt(timeInt/1000);
}

//JSON解码
function formatJsonEncode(text)
{
    let json = text.toString();
    json = json.replace(/[\r\n\t]/g, "");
    json = json.replace(/(\\t)*/g, "");
    json = json.replace(/\s*\,\s*/g, ',');
    json = json.replace(/\s*\:\s*/g, ':');
    json = json.replace(/\s*\{\s*/g, "{");
    json = json.replace(/\s*\[\s*/g, "[");
    json = json.replace(/\s*\}\s*/g, "}");
    json = json.replace(/\s*\]\s*/g, "]");
    return  json;
}

//JSON编码
function formatJsonDecode (json, options)
{
    let reg = null,
        formatted = '',
        pad = 0,
        PADDING = '    '; // one can also use '\t' or a different number of spaces
    // optional settings
    options = options || {};
    // remove newline where '{' or '[' follows ':'
    //options.newlineAfterColonIfBeforeBraceOrBracket = (options.newlineAfterColonIfBeforeBraceOrBracket === true) ? true : false;
    options.newlineAfterColonIfBeforeBraceOrBracket = true;
    // use a space after a colon
    //options.spaceAfterColon = (options.spaceAfterColon === false) ? false : true;
    options.spaceAfterColon = true;

    // begin formatting...

    // make sure we start with the JSON as a string
    if (typeof json !== 'string') {
        json = JSON.stringify(json);
    }
    // parse and stringify in order to remove extra whitespace
    json = JSON.parse(json);
    json = JSON.stringify(json);

    // add newline before and after curly braces
    reg = /([\{\}])/g;
    json = json.replace(reg, '\r\n$1\r\n');

    // add newline before and after square brackets
    reg = /([\[\]])/g;
    json = json.replace(reg, '\r\n$1\r\n');

    // add newline after comma
    reg = /(\,\")/g;
    json = json.replace(reg, ',\r\n"');

    // remove multiple newlines
    reg = /(\r\n\r\n)/g;
    json = json.replace(reg, '\r\n');

    // remove newlines before commas
    reg = /\r\n\,/g;
    json = json.replace(reg, ',');

    // optional formatting...
    if (!options.newlineAfterColonIfBeforeBraceOrBracket) {
        reg = /\:\r\n\{/g;
        json = json.replace(reg, ':{');
        reg = /\:\r\n\[/g;
        json = json.replace(reg, ':[');
    }
    if (options.spaceAfterColon) {
        reg = /\:/g;
        json = json.replace(reg, ': ');
    }

    $.each(json.split('\r\n'), function(index, node) {
        let i = 0,
            indent = 0,
            padding = '';

        if (node.match(/\{$/) || node.match(/\[$/)) {
            indent = 1;
        } else if (node.match(/\}/) || node.match(/\]/)) {
            if (pad !== 0) {
                pad -= 1;
            }
        } else {
            indent = 0;
        }

        for (i = 0; i < pad; i++) {
            padding += PADDING;
        }
        formatted += padding + node + '\r\n';
        pad += indent;
    });
    return formatted;
}

//获取 url 参数
function getUrlParams(url) {
    let json = {};
    let arr = url.substr(url.indexOf('?') + 1).split('&');
    arr.forEach(function (item) {
        let tmp = item.split('=');
        json[tmp[0]] = tmp[1];
    });
    return json;
}

//字符串数组排序
function sortStr(str, spliter) {
    let arr = str.split(spliter);
    arr.sort(function(a, b){
        return a-b;
    });
    return arr.join(spliter);
}

// unicode 编码
function unicode(str)
{
    var value='';
    for (var i = 0; i < str.length; i++) {
        value += '\\u' + leftZero4(parseInt(str.charCodeAt(i)).toString(16));
    }
    return value;
}
function leftZero4(str)
{
    if (str != null && str != '' && str != 'undefined') {
        if (str.length == 2) {
            return '00' + str;
        }
    }
    return str;
}

// unicode 解码
function deUnicode(str){
    str = str.replace(/(\\u)(\w{1,4})/gi,function($0){
        return (String.fromCharCode(parseInt((escape($0).replace(/(%5Cu)(\w{1,4})/g,"$2")),16)));
    });
    str = str.replace(/(&#x)(\w{1,4});/gi,function($0){
        return String.fromCharCode(parseInt(escape($0).replace(/(%26%23x)(\w{1,4})(%3B)/g,"$2"),16));
    });
    str = str.replace(/(&#)(\d{1,6});/gi,function($0){
        return String.fromCharCode(parseInt(escape($0).replace(/(%26%23)(\d{1,6})(%3B)/g,"$2")));
    });
    return str;
}

// text_out
function tout(msg, err = false) {
    msg = deUnicode(msg);
    if (!err) {
        $('#text_out').val(msg).css('color', '#ddd');
    } else {
        $('#text_out').val(msg).css('color', '#c7254e');
    }
    return true;
}

// disable server
function  disableServer(deny) {
    $(deny)
        .css('pointer-events', 'none')
        .css('cursor', 'not-allowed')
        .attr('title', 'Server Offline!')
        .find('a')
        .css('pointer-events', 'auto')
        .attr('disabled', 'disabled')
        .attr('href', 'javascript:').attr('target', '_self');
    $(deny).unbind('click').click(function () {return false;});
    $(deny).unbind('dblclick').dblclick(function () {return false;});
    return false
}

// tool.lu
function tooLuFormat(code, operate, id)
{
    var loadIndex = layer.load(2, {time: 10 * 1000});
    $.ajax({
        url: base_url + '/api/extra/url?id=' + id,  // 功能待开发
        type: 'post',
        data: {code: code, operate: operate},
        success: function (res) {
            res = JSON.parse(res);
            if (res.code === '0') {
                tout(res.data);
            } else {
                tout(res.msg, true);
            }
            layer.close(loadIndex);
        }
    });
    return true;
}

// sha256 and sha512
function ssha(code, id)
{
    var loadIndex = layer.load(2, {time: 10 * 1000});
    $.ajax({
        url: base_url + '/api/extra/sha',
        type: 'post',
        data: {code: code, 'type': id},
        success: function (res) {
            res = JSON.parse(res);
            if (res.code === 0) {
                tout('');
                tout(res.data);
            } else {
                tout('');
                tout(res.msg, true);
            }
            layer.close(loadIndex);
        }
    });
    return true;
}


