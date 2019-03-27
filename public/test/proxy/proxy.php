<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/02/28
 * @internal wujun
 */

//页面执行
main();
//载入Html
//loadHtml();

function main()
{

    header("Content-type: text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");

    $domain = 'http://yun.xiaobaibar.net/proxy?proxy_url=';

    $url = 'https://qian.pubwinol.com/Qdd/barshopnewindex.do';
    $url = 'https://qdd.wxdesk.com/customer/customers';
    $url = 'https://a.guanliyuangong.com';
    $url = 'https://barshop.wxdesk.com/bar/barshop/commodity';

    $url = 'https://qian.sicent.com/Frame/Index.do';
    $url = 'https://qdd.wxdesk.com/loginPage/market/';
    $url = 'https://qdd.wxdesk.com/login/';
    $url = 'https://qdd.wxdesk.com/plaza/home/index.html';
    $url = 'https://fanyi.baidu.com/sug';

    $params = [];
    $header = [];

    //$sessionId = '5686770F80466AE8336128C96506F2B5';
    //$header[] = "Cookie: JSESSIONID={$sessionId} ; Path=/barshop/";

    $params['kw'] = 'domain';

    $data = Http::post($url, $params, $header, false);
    $data = json_decode($data, true);
    dump($data, 'data : ');
}

function loadHtml()
{
    $html = <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Proxy</title>
            <script src="./src_jquery.min.js"></script>
        </head>
        <body>
        
        <h3>请求地址</h3>
        <p id="test_url">test_url</p>
        
        <h3>请求结果</h3>
        <p id="test_res">test_res</p>
        
        </body>
        </html>
        
        <script  type="text/javascript">
        
            $(function () {
        
                let domain = 'http://yun.xiaobaibar.net/proxy?proxy_url=';
                let loginUrl = 'https://qian.pubwinol.com/Login/Login.do';
                let url = domain + loginUrl;
                let data = {};
                
                
                url = 'http://apiproxy.yun.com:82/Login/Login.do';
                data.txtLoginName = '41140210001481';
                data.txtPassword = 'MTg5MzcwMDEzODE=';
                data.txtVerify = '';
                data.showCode = 'false';
                
                console.log(data);
        
                $('#test_url').html(url);
        
                $.ajax({
                    dataType: 'text',
                    type: 'post',
                    url: url,
                    data: data,
                    success: function (res, textStatus, jqXHR) {
                        console.log(res);
                        $('#test_res').html(textStatus);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.log(XMLHttpRequest);
                        $('#test_res').html(textStatus);
                    },
                });

            });

        
        </script>
HTML;
    echo $html;
}

function dump($var, $msg = ''){echo $msg;echo "<pre>";var_dump($var);echo "</pre>";}

class Http
{

    public static function _getInit($url, $params)
    {
        if(!empty($params)){
            $aGet = array();
            foreach($params as $key => $val){
                $aGet[] = $key."=".urlencode($val);
            }
            $url = $url."?".join("&",$aGet);
        }
        return $url;
    }

    public static function get($url, $params,$header,$headerInfo = false){
        $ch = curl_init();
        $url = self::_getInit($url,$params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,$headerInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function post($url, $params,$header,$headerInfo = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,$headerInfo);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}
