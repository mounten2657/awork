<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>awork</title>
    <link rel="stylesheet" type="text/css" href="{{base_url()}}/assets/common/css/bootstrap_v3_3_0.min.css?v={{$awork_updated_at}}">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}/assets/common/layui-v2.5.6/css/layui.css">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}/assets/common/css/short.css">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}/assets/awork/css/index.css?v={{$awork_updated_at}}">
</head>

<body style="
    background-color: rgba(125, 125, 125, 0.02);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-color: #181A1B;
">

<div class="container" style="width: auto; line-height: 3em;">
    <h4 class="text-center" style="color: #AAA;">Awork {{$awork_version}} index
        <small>
            --- last updated at {{$awork_updated_at}}
        </small>
    </h4>
    <div class="row">

        <div class="col-lg-6">
            <!-- Tool for timestamp -->
            <h4 class="text-info mg-b-15">Tool for timestamp</h4>
            <div class="row time-sm-line lh-1_5">
                <div class="col-sm-5">
                    <span class="mg-r-20"></span><code id="now_time">/</code>
                    <button type="button" class="btn btn-danger btn-xs" id="now_stop" data-val="1">Stop</button>
                    <code id="now_time_record">/</code>
                </div>
                <code id="now_date_record">--</code>
            </div>
            <div class="row time-sm-line">
                <div class="col-sm-5 form-group form-inline">
                    <span class="mg-r-20"></span>
                    <input type="text" class="form-control" id="time_in" placeholder="Timestamp">
                    <label for="time_in"><button type="button" class="btn btn-primary btn-xs">Date</button></label>
                </div>
                <code id="time_out">/</code>
            </div>
            <div class="row time-sm-line">
                <div class="col-sm-5 form-group form-inline">
                    <span class="mg-r-20"></span>
                    <input type="text" class="form-control" id="date_in" placeholder="DateTime">
                    <label for="date_in"><button type="button" class="btn btn-primary btn-xs">Time</button></label>
                </div>
                <code id="date_out">/</code>
            </div><hr style="background-color: #000;">
            <!-- Tool for platform -->
            <h4 class="text-info mg-b-15">Tool for platform</h4>
            <!-- Api -->
            <div class="row platform-sm-line">
                <div class="col-sm-2 form-group"><span class="mg-r-20"></span><code>Api</code></div>
                <label><a href="{{base_url()}}/api/awork/index" target="_blank" type="button" class="btn btn-primary btn-xs">Api List</a></label>
                <label><a href="{{base_url()}}/api/awork/index?t_code=phpVersion" target="_blank" type="button" class="btn btn-primary btn-xs">PHP Version</a></label>
                <label><a href="{{base_url()}}/api/awork/index?t_code=clientIp" target="_blank" type="button" class="btn btn-primary btn-xs">Client IP</a></label>
                <label><a href="{{base_url()}}/api/awork/index?t_code=clientDns" target="_blank" type="button" class="btn btn-primary btn-xs">Client DNS</a></label>
                <label><a href="{{base_url()}}/api/awork/index?t_code=clientUa" target="_blank" type="button" class="btn btn-primary btn-xs">User Agent</a></label>
                <label><a href="{{base_url()}}/cnzz" target="_blank" type="button" class="btn btn-primary btn-xs">Cnzz</a></label>
            </div>
            <!-- Server -->
            <div  class="row platform-sm-line">
                <div class="col-sm-2 form-group"><span class="mg-r-20"></span><code>Server</code></div>
                <label><a href="https://joplin.smplote.com" target="_blank" type="button" class="btn btn-primary btn-xs">Joplin</a></label>
                <label><a href="https://synology.smplote.com/photo" target="_blank" type="button" class="btn btn-primary btn-xs">Photo Station</a></label>
                <label><a href="https://synology.smplote.com/video" target="_blank" type="button" class="btn btn-primary btn-xs">Video Station</a></label>
                <label><a href="https://synology.smplote.com/audio" target="_blank" type="button" class="btn btn-primary btn-xs">Audio Station</a></label>
                <label><a href="https://synology.smplote.com" target="_blank" type="button" class="btn btn-primary btn-xs">Synology</a></label>
                <label><a href="https://pannael.somplote.com/f3a1cb39/" target="_blank" type="button" class="btn btn-primary btn-xs">BaoTa</a></label>
            </div>
            <!-- File -->
            <div class="row platform-sm-line">
                <div class="col-sm-2 form-group"><span class="mg-r-20"></span><code>File</code></div>
                <label><a href="https://www.smplote.com/kodbox/#explorer" target="_blank" type="button" class="btn btn-primary btn-xs">File List</a></label>
                <label><a href="https://www.smplote.com/kodbox/index.php?desktop" target="_blank" type="button" class="btn btn-primary btn-xs">Desktop</a></label>
                <label><a href="https://www.smplote.com/kodbox/index.php?share/folder&user=1&sid=4biYpd8J" target="_blank" type="button" class="btn btn-primary btn-xs">Images</a></label>
                <label><a href="https://www.smplote.com/kodbox?share/folder&user=1&sid=M8Ud6WQK" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #0a9afe">Documents</a></label>
                <label><a href="https://www.smplote.com/kodbox/plugins/adminer/adminer/" target="_blank" type="button" class="btn btn-primary btn-xs">Mysql Adminer</a></label>
                <label><a href="https://www.smplote.com/layui" target="_blank" type="button" class="btn btn-primary btn-xs">Layui</a></label>
            </div>
            <!-- Mark -->
            <div class="row lh-2">
                <div id="d_mark" class="col-sm-2 form-group"><span class="mg-r-20"></span><code>Mark</code></div>
                <label><a href="https://www.baidu.com/" target="_blank" type="button" class="btn btn-primary btn-xs">Baidu</a></label>
                <label><a href="https://fanyi.baidu.com/" target="_blank" type="button" class="btn btn-primary btn-xs">BaiduFanYi</a></label>
                <label><a href="https://translate.google.cn/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #1A73E8">GTranslate</a></label>
                <label><a href="https://www.google.com/" target="_blank" type="button" class="btn btn-primary btn-xs">Google</a></label>
                <label><a href="https://ip.sb/" target="_blank" type="button" class="btn btn-primary btn-xs">IP1</a></label>
                <label><a href="https://www.ipaddress.com/" target="_blank" type="button" class="btn btn-primary btn-xs">IP2</a></label>
                <label><a href="http://www.bejson.com/" target="_blank" type="button" class="btn btn-primary btn-xs">BEJSON</a></label>
                <label><a href="https://tool.chinaz.com/" target="_blank" type="button" class="btn btn-primary btn-xs">ChinaZ</a></label>

                </br>
                <label><a href="https://gitee.com/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #C71D23">Gitee</a></label>
                <label><a href="https://github.com/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #24292E">GitHub</a></label>
                <label><a href="https://hub.docker.com/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #099CEC">DockerHub</a></label>
                <label><a href="https://hub.docker.com/u/library" target="_blank" type="button" class="btn btn-primary btn-xs">DockerLib</a></label>
                <label><a href="https://bitbucket.org/" target="_blank" type="button" class="btn btn-primary btn-xs">BitBucket</a></label>
                <label><a href="https://msdn.itellyou.cn/" target="_blank" type="button" class="btn btn-primary btn-xs">ITELLU</a></label>
                <label><a href="https://github.com/yeszao/dnmp" target="_blank" type="button" class="btn btn-primary btn-xs">Dnmp</a></label>

                </br>
                <label><a href="https://www.layui.com/" target="_blank" type="button" class="btn btn-primary btn-xs">Layui</a></label>
                <label><a href="https://echarts.apache.org/zh/index.html" target="_blank" type="button" class="btn btn-primary btn-xs">EChart</a></label>
                <label><a href="https://fontawesome.dashgame.com/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #0A0A0A">Font Awesome</a></label>
                <label><a href="https://uniapp.dcloud.io/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #2B9939">Uni App</a></label>
                <label><a href="https://www.kancloud.cn/logoove/we7/678511" target="_blank" type="button" class="btn btn-primary btn-xs">PHP Web</a></label>
                <label><a href="https://cli.im/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #56A059">QR Code</a></label>
                <label><a href="http://www.netbian.com/dongman1920_1080/" target="_blank" type="button" class="btn btn-primary btn-xs">Wall Paper</a></label>

                </br>
                <label><a href="http://coolaf.com/tool/post" target="_blank" type="button" class="btn btn-primary btn-xs">POST</a></label>
                <label><a href="http://coolaf.com/tool/md" target="_blank" type="button" class="btn btn-primary btn-xs">Markdown</a></label>
                <label><a href="https://tableconvert.com/" target="_blank" type="button" class="btn btn-primary btn-xs">TableConvert</a></label>
                <label><a href="http://www.1ppt.com/" target="_blank" type="button" class="btn btn-primary btn-xs">PPT</a></label>
                <label><a href="https://www.photopea.com/" target="_blank" type="button" class="btn btn-primary btn-xs">Photo Pea</a></label>
                <label><a href="http://note.youdao.com/" target="_blank" type="button" class="btn btn-primary btn-xs" style="background: #257FE6">YouDao Net</a></label>
                <label><a href="https://www.processon.com/" target="_blank" type="button" class="btn btn-primary btn-xs">Process On</a></label>

            </div>
        </div>

        <div class="col-lg-6 string-sm-line">
            <!-- Tool for string -->
            <h4 class="text-info">Tool for string</h4>
            <input type="text" class="form-control" id="text_in" placeholder="Input...">
            <label id="json_decode"><button type="button" class="btn btn-primary btn-xs">json decode</button></label>
            <label id="json_encode"><button type="button" class="btn btn-primary btn-xs">json encode</button></label>
            <label id="url_decode"><button type="button" class="btn btn-primary btn-xs" title="双击再解密">url decode</button></label>
            <label id="url_encode"><button type="button" class="btn btn-primary btn-xs" title="双击再加密">url encode</button></label>
            <label id="implode"><button type="button" class="btn btn-primary btn-xs">implode</button></label>
            <label id="explode"><button type="button" class="btn btn-primary btn-xs">explode</button></label>
            <label id="uni_decode"><button type="button" class="btn btn-primary btn-xs">unicode decode</button></label>
            <label id="unicode"><button type="button" class="btn btn-primary btn-xs">unicode</button></label>
            <label><span style="width: 100px; display: none" class="col-lg-2"></span></label>
            <label id="rand_passwd"><button type="button" class="btn btn-primary btn-xs">rand passwd</button></label>
            <label id="sql_format"><button type="button" class="btn btn-primary btn-xs" title="双击精简">sql format</button></label>
            <label id="xml_format"><button type="button" class="btn btn-primary btn-xs" title="双击精简">xml format</button></label>
            <label id="md5"><button type="button" class="btn btn-warning btn-xs" title="双击再加密">md5</button></label>
            <label id="base64_encode"><button type="button" class="btn btn-primary btn-xs" title="双击替换">base64 encode</button></label>
            <label id="base64_decode"><button type="button" class="btn btn-primary btn-xs" title="双击替换">base64 decode</button></label>
            <label id="sha256"><button type="button" class="btn btn-primary btn-xs">sha256</button></label>
            <label id="sha512"><button type="button" class="btn btn-primary btn-xs">sha512</button></label>
            <textarea title="" id="text_out" class="form-control" rows="20" placeholder="" style="resize: none;" ></textarea>
        </div>

    </div>

    <!-- Select Host -->
    <div id="host_form" class="none pd-t-30">
        <form class="layui-form" action="">
            <div class="layui-form-item"><label class="layui-form-label" >Host&nbsp;&nbsp;&nbsp;</label>
                <div class="layui-input-block pd-r-30">
                    <select name="HostIP" id="HostIP">
                        <option value="172.18.0.12">172.18.0.12</option>
                        <option value="192.168.50.128">192.168.50.128</option>
                        <option value="192.168.50.210">192.168.50.210</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item"><label class="layui-form-label">Branch</label>
                <div class="layui-input-block pd-r-30">
                    <select name="CodeBranch" id="CodeBranch">
                        <option value="html_latest">release/html_latest</option>
                        <option value="huaweiweb">release/huaweiweb</option>
                        <option value="v1906">release/v1906</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item"><label class="layui-form-label">Version</label>
                <div class="layui-input-block pd-r-30">
                    <select name="PHPVersion" id="PHPVersion">
                        <option value="7.2">PHP 7.2</option>
                        <option value="5.3">PHP 5.3</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item text-muted"><label class="layui-form-label pd-t-15">*</label>
                <div class="layui-input-block pd-r-30">
                    The last project is setting by host <i id="host_text">192.168.50.210</i>
                    and branch <i id="branch_text">release/v1906</i>
                    and version <i id="version_text">PHP 5.3</i>.
                </div>
            </div>
        </form>
    </div>

    <div class="row" style="display: none">
        <div class="col-sm-12">
            <a id="big_data" href="javascript:" ><img src="{{base_url()}}/assets/awork/img/big_data.png"></a>
        </div>
    </div>

    <footer style="text-align: center; padding: 45px; color:#AAA;">© 2020-2030 awork. all rights reserved.</footer>

</div>

<script src="{{base_url()}}/assets/common/js/vue_v2_2_2.min.js"></script>
<script src="{{base_url()}}/assets/common/js/jquery_v2_1_1.min.js"></script>
<script src="{{base_url()}}/assets/common/layui-v2.5.6/layui.all.js"></script>
<script src="{{base_url()}}/assets/common/js/public.js"></script>
<script src="{{base_url()}}/assets/common/js/md5.js"></script>
<script src="{{base_url()}}/assets/common/js/base64.js"></script>
<script src="{{base_url()}}/assets/awork/js/index_function.js?v={{$awork_updated_at}}"></script>
<script src="{{base_url()}}/assets/awork/js/index.js?v={{$awork_updated_at}}" charset="gb2312"></script>

</body>
</html>
