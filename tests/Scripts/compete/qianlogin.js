function base64_encode(str) {
    var c1, c2, c3;
    var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    var i = 0, len = str.length, string = '';

    while (i < len) {
        c1 = str.charCodeAt(i++) & 0xff;
        if (i == len) {
            string += base64EncodeChars.charAt(c1 >> 2);
            string += base64EncodeChars.charAt((c1 & 0x3) << 4);
            string += "==";
            break;
        }
        c2 = str.charCodeAt(i++);
        if (i == len) {
            string += base64EncodeChars.charAt(c1 >> 2);
            string += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
            string += base64EncodeChars.charAt((c2 & 0xF) << 2);
            string += "=";
            break;
        }
        c3 = str.charCodeAt(i++);
        string += base64EncodeChars.charAt(c1 >> 2);
        string += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
        string += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
        string += base64EncodeChars.charAt(c3 & 0x3F)
    }
    return string
}

function showTab(index) {
    $("div.tabs-panels > div.panel").removeClass("panel-selected").eq(index).addClass('panel-selected')
    $("ul.tabs li").removeClass("tabs-selected").eq(index).addClass('tabs-selected')
}

function showTip(message) {
    var sDom = '<div class="errorTip" style="display:none;">' +
        '<span class="icon-tipError"></span>' +
        '<p style="margin-left:20px;">' + message + '</p>' +
        '</div>';
    var $dom = $(sDom);
    $("div.tabs-container").append($dom);
    $dom.show();
    setTimeout(function () {
        $dom.hide("normal", function () {
            $(this).remove();
        });
    }, 5000);
}

//layout
;(function () {
    function onResize() {
        var height = $(window).height();
        $("body").attr("class", "");
        if (height >= 970) $("body").addClass("height_970");
        if (height >= 800 && height < 970) $("body").addClass("height_800");
    }

    function init() {
        $(window).on("resize.default", onResize);
        onResize();
        //待重构
        $(document).on("click.triggerBannerLink", "div.container", function (e) {
            window.s.clickLink();
        }).on("click.triggerBannerLink", "div.tabs-container", function (e) {
            e.stopPropagation();
        });
    }

    $(function () {
        init();
    })
})();
//main
$(function () {
    enableInputPlaceHolder();
    if (!isIE6()) {
        $("div.input input").each(function () {
            $(this).on("focus.focus", function () {
                $(this).parent().addClass("focus");
            }).on("blur.focus", function () {
                $(this).parent().removeClass("focus");
            })
        });
    }
    $("input").prev(".icon").bind("click.default", function (e) {
        $(this).next("input").trigger("focus");
    });
    $("#submit1").click(function (e) {
        e.preventDefault();
        if ($.trim($("#txtLoginName1").val()) == "") {
            showTip("请输入" + $("#txtLoginName1").data("placeholder"));
            if (!isIE6()) {
                $("#txtLoginName1").parent().addClass("error")
                $("#txtLoginName1").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else if ($.trim($("#txtPassword1").val()) == "") {
            showTip("请输入" + $("#txtPassword1").data("placeholder"));
            if (!isIE6()) {
                $("#txtPassword1").parent().addClass("error")
                $("#txtPassword1").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else if ($("#txtVerify1").is(":visible") && $.trim($("#txtVerify1").val()) == "") {
            showTip("请输入" + $("#txtVerify1").data("placeholder"));
            if (!isIE6()) {
                $("#txtVerify1").parent().addClass("error")
                $("#txtVerify1").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else {
            var pwd = $.trim($("#txtPassword1").val());
            var pwdShow = pwd;
            $("#txtPassword1").val(base64_encode(pwd));
        }
        //获取帐号版本信息
        var systemVersion = getVersion($.trim($("#txtLoginName1").val()));
        if(systemVersion=="new"){
            //新版本调用董映登录
            var tokenData = getToken($.trim($("#txtLoginName1").val()),pwdShow);
            //解析返回值，如果返回code为0，则调用成功,将token加到url后面
            if (tokenData.code == 0){
                var tokenStr = tokenData.result.access_token;
                if (tokenStr!=""||tokenStr!=null||tokenStr!="null"){
                    window.location.href = "https://qian.sicent.com/7.0/?token="+tokenStr;
                }
            }else{
                //code不为0，异常情况，打印错误信息
                showTip(tokenData.msg);
                return;
            }
        }else {
            $("#form1").submit();
        }
    });
    $("#submit2").click(function (e) {
        e.preventDefault();
        if ($.trim($("#txtLoginName2").val()) == "") {
            showTip("请输入" + $("#txtLoginName2").data("placeholder"));
            if (!isIE6()) {
                $("#txtLoginName2").parent().addClass("error")
                $("#txtLoginName2").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else if ($.trim($("#txtOperater").val()) == "") {
            showTip("请输入" + $("#txtOperater").data("placeholder"));
            if (!isIE6()) {
                $("#txtOperater").parent().addClass("error")
                $("#txtOperater").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else if ($.trim($("#txtPassword2").val()) == "") {
            showTip("请输入密码！若没有设置密码，请先用老板账号登录，进入员工管理设置员工登录密码。");
            if (!isIE6()) {
                $("#txtPassword2").parent().addClass("error");
                $("#txtPassword2").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else if ($("#txtVerify2").is(":visible") && $.trim($("#txtVerify2").val()) == "") {
            showTip("请输入" + $("#txtVerify2").data("placeholder"));
            if (!isIE6()) {
                $("#txtVerify2").parent().addClass("error")
                $("#txtVerify2").off("focus.validate").on("focus.validate", function () {
                    $(this).parent().removeClass("error");
                });
            }
            return;
        } else {
            var pwd = $.trim($("#txtPassword2").val())
            var pwdShow = pwd;
            $("#txtPassword2").val(base64_encode(pwd));
        }

        var systemVersion = getVersion($.trim($("#txtLoginName2").val()));
        if(systemVersion=="new"){
            var tokenData = getToken2($.trim($("#txtLoginName2").val()),$.trim($("#txtOperater").val()),pwdShow);
            //解析返回值，如果返回code为0，则调用成功,将token加到url后面
            if (tokenData.code == 0){
                var tokenStr = tokenData.result.access_token;
                if (tokenStr!=""||tokenStr!=null||tokenStr!="null"){
                    window.location.href = "https://qian.sicent.com/7.0/?token="+tokenStr;
                }
            }else{
                //code不为0，异常情况，打印错误信息
                showTip(tokenData.msg);
                return;
            }
        }else {
            $("#form2").submit();
        }
    });
    $(document).unbind("keydown.enter").bind("keydown.enter", function (e) {
        var keyCode = e.keyCode;
        if (keyCode == 13) {
            if ($("#submit1").is(":visible"))
                $("#submit1").trigger("click");
            else if ($("#submit2").is(":visible"))
                $("#submit2").trigger("click");
        }
    });
})
//brower
;(function () {
    function isIE6() {
        var userAgent = navigator.userAgent.toLowerCase();
        if (userAgent.match(/msie/) != null) {
            var version = (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
            if (version == "6.0") {
                return true;
            }
        }
        return false;
    }

    function isLteIE10() {
        var userAgent = navigator.userAgent.toLowerCase();
        if (userAgent.match(/msie/) != null) {
            var version = (userAgent.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
            if (parseInt(version) < 10) {
                return true;
            }
        }
        return false;
    }

    window.isIE6 = isIE6;
    window.isLteIE10 = isLteIE10;
})();
//cookie
;(function () {
    function setCookie(c_name, value, expiredays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + expiredays);
        document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString());
    }

    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            var c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) {
                    c_end = document.cookie.length;
                }
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "";
    }

    window.setCookie = setCookie;
    window.getCookie = getCookie;
})();
//input
;(function () {
    function enableInputPlaceHolder() {
        $("input[data-placeholder]").each(function () {
            var $this = $(this)
            if (isLteIE10()) {
                var style = $this.val() == "" ? "" : "display:none;";
                $this.after("<label class='placeholder' style='" + style + "' onclick='document.getElementById(\"" + $this.attr("id") + "\").focus();'>" + $this.data("placeholder") + "</label>");
                $this.on("focus.placeholder", function (e) {
                    $(this).siblings("label.placeholder").hide();
                });
                $this.on("blur.placeholder", function (e) {
                    if ($(this).val() == "")
                        $(this).siblings("label.placeholder").show();
                });
                $this.on("keyup.placeholder", function (e) {
                    $(this).siblings("label.placeholder").hide();
                    if ($(this).val() == "")
                        $(this).siblings("label.placeholder").show();
                });
            }
            else
                $this.attr("placeholder", $this.data("placeholder"));
        })
    }

    window.enableInputPlaceHolder = enableInputPlaceHolder;
})();
//scrollBanner
;(function () {
    var intervalTime = 5000;

    function ScrollNews(options) {
        this.selector = options.selector;
        this.nSelector = $(this.selector);
        this.entry = options.entry;
        this.time = options.time;
        this.i = options.startIndex || 0;
        this.currentIndex = this.nSelector.find("ul li:visible").index();
        this.count = this.nSelector.find("ul li").length;
        if (window.scrollNews_interval) {
            clearInterval(window.scrollNews_interval);
        }
        window.scrollNews_interval = setInterval(this.entry + ".showIndex(null)", this.time);
    }

    ScrollNews.prototype = {
        showIndex: function (index, stop) {
            if (window.scrollNews_interval) clearInterval(window.scrollNews_interval);
            if (this.nSelector.find("ul li").length < 2) return;
            if (stop !== true) window.scrollNews_interval = setInterval(this.entry + ".showIndex()", this.time);
            if (index != null) this.i = index;
            if (this.i == this.count) this.i = 0;
            this.nSelector.find("ul li").fadeOut(1000).eq(this.i).fadeIn(1000);
            this.nSelector.find("ol li a").removeClass("active").eq(this.i).addClass("active");
            this.currentIndex = this.i;
            this.i++;
        },
        removeInterval: function () {
            if (window.scrollNews_interval) clearInterval(window.scrollNews_interval);
        },
        addInterval: function () {
            window.scrollNews_interval = setInterval(this.entry + ".showIndex()", this.time);
        },
        clickLink: function () {
            var index = this.currentIndex;
            var $link = this.nSelector.find("ul li a").eq(index);
            if ($link.attr("href").indexOf("javascript:") == -1) {
                $link[0].click();
            }
        }
    }

    function init() {

        var $banner = $("#view_img > ul li");
        var $bannerControl = $("ol.activeOL li a");
        var firstIndex = Math.floor(Math.random() * $banner.length);
        var startIndex = firstIndex + 1 == $banner.length ? 0 : firstIndex + 1;
        $banner.hide().eq(firstIndex).show();
        $bannerControl.filter(".active").removeClass("active");
        $bannerControl.eq(firstIndex).addClass("active");
        window.s = new ScrollNews({selector: "#view_img", entry: "s", time: intervalTime, startIndex: startIndex});
        $("ol.activeOL li a").each(function (i) {
            $(this).bind("click.default", function () {
                window.s.showIndex(i, true);
                return false;
            });
        });
        $("ol.activeOL").mouseleave(function () {
            window.s.addInterval();
        });
        $("ol.activeOL").mouseenter(function () {
            window.s.removeInterval();
        });
    }

    $(function () {
        init();
    });
})();

var result1 = "";
function getVersion(snbid) {
    $.ajax(
        {
            url: '/Login/checkClientVersion.do',
            type: "POST",
            data: {
                snbid: snbid
            },
            dataType: "text",
            async: false,
            success: function (data) {
                result1 = data;
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                result1 = "old";
            }
        });
    return result1;
}

var result2 = "";
function getToken(snbid,password) {
    $.ajax(
        {
            url: 'https://qian.sicent.com/api/service-auth-server/oauth/token',
            type: "POST",
            data: {
                snbid: snbid,
                password: password,
                grant_type: "password",
                client_id: "a2b79b93fb5d11f14ddd0de745e7f7f1",
                client_secret: "b7758a3e2701e4fc501a4c563a7eac0f"
            },
            dataType: 'json',
            async: false,
            success: function (data) {
                result2 = data;
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                result2 = JSON.parse(XMLHttpRequest.responseText);
            }
        });
    return result2;
}

var result3 = "";
function getToken2(snbid,employee,password) {
    $.ajax(
        {
            url: 'https://qian.sicent.com/api/service-auth-server/oauth/token',
            type: "POST",
            data: {
                snbid: snbid,
                password: password,
                employee: employee,
                grant_type: "password",
                client_id: "a2b79b93fb5d11f14ddd0de745e7f7f1",
                client_secret: "b7758a3e2701e4fc501a4c563a7eac0f"
            },
            dataType: 'json',
            async: false,
            success: function (data) {
                result3 = data;
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                result3 = JSON.parse(XMLHttpRequest.responseText);
            }
        });
    return result3;
}