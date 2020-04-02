
$(function () {

    //初始化
    let color = '#333';
    let errColor = '#c7254e';
    let nowTimer = setInterval("getNowTime()",1000);
    let nowTimeInt = parseInt((new Date()).getTime()/1000);
    $('#now_time').html('<' + nowTimeInt + '...>');
    $('#now_time_record').html(nowTimeInt);
    $('#now_date_record').html(formatTime(nowTimeInt));
    $('#time_in').val(nowTimeInt);
    $('#time_out').html(formatTime(nowTimeInt));
    $('#date_in').val(formatTime(nowTimeInt));
    $('#date_out').html(nowTimeInt);

    //点击 Stop
    $('#now_stop').click(function () {
        let val = $(this).data('val');
        if (val) {
            window.clearInterval(nowTimer);
            $(this).data('val', 0);
            $('#now_time').removeClass('text-danger').addClass('text-info');
            $(this).removeClass('btn-danger').addClass('btn-success').html('Start');
            $('#now_time_record').html(parseInt((new Date()).getTime()/1000));
            $('#now_date_record').html(formatTime(parseInt((new Date()).getTime()/1000)));
        } else {
            nowTimer = setInterval("getNowTime()",1000);
            $(this).data('val', 1);
            $('#now_time').removeClass('text-info').addClass('text-danger');
            $(this).removeClass('btn-success').addClass('btn-danger').html('Stop ');
        }
    });

    //点击 Date
    $('#time_in + label').click(function () {
        let nowTimeInt = $('#time_in').val();
        $('#time_out').html(formatTime(nowTimeInt));
    });

    //点击 Time
    $('#date_in + label').click(function () {
        let nowTimeDate = $('#date_in').val();
        $('#date_out').html(formatDate(nowTimeDate));
    });

    //点击 json decode
    $('#json_decode').click(function () {
        let json = '';
        let text = $('#text_in').val();
        try {
            json = formatJsonDecode(text);
        } catch (e) {
            let error = e.name + ": " + e.message;
            console.log(e);
            $('#text_out').val(error).css('color', errColor);
            return false;
        }
        $('#text_out').val(json).css('color', color);
    });

    //点击 json encode
    $('#json_encode').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val(formatJsonEncode(text)).css('color', color);
    });

    //点击 url decode
    $('#url_decode').click(function () {
        let text = $('#text_in').val();
        text = decodeURI(text);
        text += "\r\n\r\nRequest Parameters: " + formatJsonDecode(getUrlParams(text));
        $('#text_out').val(text).css('color', color);
    });

    //点击 url encode
    $('#url_encode').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val(encodeURI(text)).css('color', color);
    });

    //点击 implode
    $('#implode').click(function () {
        let text = $('#text_in').val();
        text = text.replace(/\ +/g, ',');
        text = sortStr(text, ",");
        $('#text_out').val(text).css('color', color);
    });

    //点击 explode
    $('#explode').click(function () {
        let text = $('#text_in').val();
        text = text.replace(/\,/g, "\r\n");
        text = sortStr(text, "\r\n");
        $('#text_out').val(text).css('color', color);
    });

    //点击 rand passwd
    $('#rand_passwd').click(function () {
        let text = (new Date()).getTime().toString() + Math.floor((Math.random()*10000)+1);
        let str = '';
        for (let i = 9; i > 0; i--) {
            let stext = b64_md5(text + i);
            stext = stext.replace(/\+/g, "_");
            stext = stext.replace(/\//g, "_");
            str += stext + "\r\n\r\n";
        }
        $('#text_out').val(str).css('color', color);
    });

    //点击 version bat
    $('#version_bat').click(function () {
        let text = $('#text_in').val();
        text = text.replace(/\ +/g, ',');
        $.ajax({
            url: '/index/api/generateBat',
            type:'post',
            data:{text: text},
            success:function (res) {
                res = JSON.parse(res);
                if (res.code === '0') {
                    $('#text_out').val(res.data.bat).css('color', color);
                } else {
                    $('#text_out').val(res.msg).css('color', errColor);
                }
            }
        });
        return true;
    });

    //双击 version bat
    $('#version_bat').dblclick(function () {
        let text = $('#text_in').val();
        text = text.replace(/\ +/g, ',');
        if (text !== '') {
            window.location.href = '/index/api/downloadBat?text='+text;
        }
    });

    //加载百度翻译
    setTimeout(function () {
        let baidufyHtml = '    <div class="row">\n' +
            '        <div class="col-sm-12">\n' +
            '            <iframe frameborder="0" scrolling="auto" height="300" width="100%" src="https://fanyi.baidu.com/#zh/en/"></iframe>\n' +
            '        </div>\n' +
            '    </div>';
        $(".container").append(baidufyHtml);
    } ,500);

});

