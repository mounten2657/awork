<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNZZ STAT</title>
</head>

<body>

<div>CNZZ 测试统计</div>

<button id="cnzz_btn1">CNZZ1</button>
<button id="cnzz_btn2">CNZZ2</button>
<button id="cnzz_btn3">CNZZ3</button>

</body>

<script type="text/javascript">
    // 声明_czc对象:
    var _czc = _czc || [];
    // 绑定siteid
    _czc.push(["_setAccount", "1275778523"]);

    // 绑定事件
    document.getElementById('cnzz_btn1').onclick = function () {
        _czc.push(['_trackEvent', '首次激活码活动', '注册', '云平台账号','1','cnzz_btn1']);
    };
    document.getElementById('cnzz_btn2').onclick = function () {
        _czc.push(['_trackEvent', '首次激活码活动', '查询', 'VIP激活码','1','cnzz_btn2']);
    };

    // 数据统计
    var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cspan style='display:none' id='cnzz_stat_icon_1275778523'%3E%3C/span%3E%3Cscript src='" +
        cnzz_protocol + "s96.cnzz.com/z_stat.php%3Fid%3D1275778523' type='text/javascript'%3E%3C/script%3E"));

</script>

</html>
