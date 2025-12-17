
$(function () {

    /**************************************Tool for timestamp***********************************************/
    //初始化
    let color = '#ddd';
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

    /**************************************Tool for string***********************************************/
    let clickTimer = null;
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
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            text = decodeURI(text);
            text += "\r\n\r\nRequest Parameters: " + formatJsonDecode(getUrlParams(text));
            $('#text_out').val(text).css('color', color);
        },300);
    });
    //双击 url decode
    $('#url_decode').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        text = decodeURIComponent(text);
        text += "\r\n\r\nRequest Parameters: " + formatJsonDecode(getUrlParams(text));
        $('#text_out').val(text).css('color', color);
    });

    //点击 url encode
    $('#url_encode').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            $('#text_out').val(encodeURI(text)).css('color', color);
        },300);
    });
    //双击 url encode
    $('#url_encode').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        $('#text_out').val(encodeURIComponent(text)).css('color', color);
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
            stext = stext.replace(/\+/g, "Q");
            stext = stext.replace(/\//g, "Z");
            str += stext + "\r\n\r\n";
        }
        $('#text_out').val(str).css('color', color);
    });

    //点击 unicode
    $('#unicode').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val(unicode(text)).css('color', color);
    });

    //点击 uni_decode
    $('#uni_decode').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val(deUnicode(text)).css('color', color);
    });

    //点击 sql_format
    $('#sql_format').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            tooLuFormat(text, 'beauty', 'sql_format');
        },300);
        return true;
    });
    //双击 sql_format
    $('#sql_format').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        tooLuFormat(text, 'compress', 'sql_format');
    });

    //点击 xml_format
    $('#xml_format').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            tooLuFormat(text, 'beauty', 'xml_format');
        },300);
        return true;
    });
    //双击 xml_format
    $('#xml_format').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        tooLuFormat(text, 'purify', 'xml_format');
    });

    //点击 md5
    $('#md5').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            $('#text_out').val($.md5(text)).css('color', color);
        },300);
    });
    //双击 md5
    $('#md5').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_out').val();
        $('#text_out').val($.md5(text)).css('color', color);
    });

    //点击 base64_encode
    $('#base64_encode').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            $('#text_out').val($.base64.encode(text)).css('color', color);
        },300);
    });
    //双击 base64_encode
    $('#base64_encode').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        $('#text_out').val($.base64.encodeExt(text)).css('color', color);
    });

    //点击 base64_decode
    $('#base64_decode').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            $('#text_out').val($.base64.decode(text)).css('color', color);
        },300);
    });
    //双击 base64_decode
    $('#base64_decode').dblclick(function () {
        clearTimeout(clickTimer);
        let text = $('#text_in').val();
        $('#text_out').val($.base64.decodeExt(text)).css('color', color);
    });

    //点击 sha256
    $('#sha256').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            ssha(text,'sha256');
        },300);
        return true;
    });

    //点击 sha512
    $('#sha512').click(function () {
        clearTimeout(clickTimer);
        clickTimer = setTimeout(function () {
            let text = $('#text_in').val();
            ssha(text,'sha512');
        },300);
        return true;
    });

    /**************************************Tool for platform***********************************************/

    $('#big_data').mouseenter(function () {
        layer.tips('Value: A large amount of irrelevant information, predictable analysis of future trends and patterns, in-depth and complex analysis, and rapid extraction of the valuable information from the massive data resources, bringing real benefits to customers. (For example: machine learning, artificial intelligence, data aggregation, etc.)\n' +
            'Variety: the heterogeneity and diversification of big data, and the presentation of many different forms (structured data, unstructured data, semi-structured data) is not limited to text, images, interfaces, files, databases, standards Format etc.\n' +
            'Speedy Velocity: Real-time analysis instead of batch analysis, rapid data extraction, cleaning, aggregation, labeling, specific to people and things, immediate results rather than after-event results. Data of trillions or more is processed at all times, so it is time-sensitive, high-speed processing, and quick response.\n' +
            'Veracity: The content of big data is closely related to what happens in the real world. The study of big data is to extract the process of explaining and predicting real events from huge network data. Improve the accuracy and reliability of data and ensure data quality. It can also be used to predict a certain trend in the future and use data to extract real demand points.\n',
            '#big_data img', {tips:[2, '#ccc'],area:['495px','250px'],time:3000});
    });

    // 抢聚焦
    // var focus = setInterval(function () {
    //     $('#text_in').focus();
    // }, 100);
    // setTimeout(function () {
    //     window.clearInterval(focus)
    // },2000)

});

