
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

    //双击 url decode
    $('#url_decode').dblclick(function () {
        let text = $('#text_in').val();
        text = decodeURIComponent(text);
        text += "\r\n\r\nRequest Parameters: " + formatJsonDecode(getUrlParams(text));
        $('#text_out').val(text).css('color', color);
    });

    //点击 url encode
    $('#url_encode').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val(encodeURI(text)).css('color', color);
    });

    //双击 url encode
    $('#url_encode').dblclick(function () {
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

    //点击 md5
    $('#md5').click(function () {
        let text = $('#text_in').val();
        $('#text_out').val($.md5(text)).css('color', color);
    });

    // 获取版本信息
    var version = {};
    var loadIndex = layer.load(2, {time: 10 * 1000});
    setTimeout(function () {
        $.ajax({
            url: '/extra/url?current_i',
            type:'post',
            data:{},
            success:function (res) {
                res = JSON.parse(res);
                if (res.code !== '0') {
                    return layer.msg(res.msg);
                }
                version = res.data;
                var info = version.data.branch + ' + ' + version.data.version;
                $('#current_i button').html(info);
                $('#host_text').html(version.data.host);
                $('#branch_text').html('release/'+version.data.branch);
                $('#version_text').html('PHP '+version.data.version);
                $('#HostIP').siblings("div.layui-form-select").find('dl').find('dd[lay-value="' + version.data.host + '"]').click();
                $('#CodeBranch').siblings("div.layui-form-select").find('dl').find('dd[lay-value="' + version.data.branch + '"]').click();
                $('#PHPVersion').siblings("div.layui-form-select").find('dl').find('dd[lay-value="' + version.data.version + '"]').click();
                layer.close(loadIndex);
            }
        });
    },500);

    //点击 current_i
    $('#current_i').click(function () {
        var info = version.data.host + ' <br> ' + version.data.branch + ' <br> ' + version.data.version;
        layer.tips(info, '#current_i', {tips:[1, '#111'],time:3000});
    });

    //点击 host_ip
    $('#host_ip').click(function () {
        var info = version.data.host;
        layer.tips(info, '#host_ip', {tips:[1, '#111'],time:3000});
    });

    //点击 code_bch
    $('#code_bch').click(function () {
        var info = version.data.branch;
        layer.tips(info, '#code_bch', {tips:[1, '#111'],time:3000});
    });

    //点击 php_ver
    $('#php_ver').click(function () {
        var info = version.data.version;
        layer.tips(info, '#php_ver', {tips:[1, '#111'],time:3000});
    });
    $('#host_ip,#code_bch,#php_ver').dblclick(function () {
        layer.open({
            title: 'Select Property Of Html'
            ,type: 1
            ,area: ['480px', '420px']
            ,offset: ['20%', '20%']
            ,btn: ['&nbsp;&nbsp;&nbsp;Set&nbsp;&nbsp;&nbsp;', 'Cancel']
            ,content: $('#host_form')
            ,yes: function (index) {
                layer.msg('The html has been set, click \'Submit\' to save it.');
                layer.close(index)
            }
            ,btn2: function (index) {
                layer.close(index);
            }
        });
    });

    //点击 ch_submit
    $('#ch_submit').click(function () {
        var host = $('#HostIP').val();
        var branch = $('#CodeBranch').val();
        var php = $('#PHPVersion').val();
        layer.prompt({
            title: 'Enter Your Password : '
            ,formType: 1
            ,maxlength: 50
            ,offset: ['30%', '25%']
            ,btn: ['Ok', 'Cancel']
            ,yes: function (index) {
                var loadIndex = layer.load(2, {time: 5 * 1000});
                var pass = layui.jquery('#layui-layer'+ index + " .layui-layer-input").val();
                pass = $.md5($.md5(pass));
                console.log(host,branch,php,pass);
                $.ajax({
                    url: '/extra/url?ch_submit',
                    type:'post',
                    async:false,
                    data:{branch:branch,php:php,pass:pass},
                    success:function (res) {
                        console.log(res);
                        res = JSON.parse(res);
                        if (res.code === '30010') {
                            layer.msg(res.msg);
                            return setTimeout(function () {
                                layer.close(loadIndex);
                                top.location.reload();
                            }, 3000);
                        }
                        if (res.code !== '0') {
                            return layer.msg(res.msg);
                        }
                        layer.msg('The project has been changed successful!');
                        return setTimeout(function () {
                            layer.close(loadIndex);
                            top.location.reload();
                        }, 1000);
                    }
                });
                layer.close(index);
            }
            ,btn2: function (index) {
                layer.close(index);
            }
        });
    });

    // 加载百度翻译
    setTimeout(function () {
        let baidufyHtml = '    <div class="row">\n' +
            '        <div class="col-sm-12">\n' +
            '            <iframe frameborder="0" scrolling="auto" height="300" width="100%" src="https://fanyi.baidu.com/#zh/en/"></iframe>\n' +
            '        </div>\n' +
            '    </div>';
        $(".container").append(baidufyHtml);
    } ,200);

    // 抢聚焦
    var focus = setInterval(function () {
        $('#text_in').focus();
    }, 100);
    setTimeout(function () {
        window.clearInterval(focus)
    },2000)

});

