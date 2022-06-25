<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/02/27
 * @internal wujun
 */


//页面执行
main();

function main()
{

    //Request Header
    $header = [
        'Accept: application/json, text/javascript, */*; q=0.01',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
        'X-Requested-With: XMLHttpRequest'
    ];
    $sessionId = 'DBB16FB6BE4399E3904830824D9F9DB1';


    //第一步 模拟登陆
    $username = '41140210001481';
    $password = '18937001381';
    $url = 'https://qian.sicent.com/Login/Login.do';
    $params = [];
    $params['txtLoginName'] = $username;
    $params['txtPassword'] = base64_encode($password);
    $params['txtVerify'] = '';
    $params['showCode'] = false;
    $data =  Http::post($url,$params,$header, true);
    //dump(htmlspecialchars($data), 'login : ');

    //匹配错误信息
    $message = '';
    if (preg_match('/showTip\("([\s\S]*?)"\)/', $data, $matches)) {
        $message = $matches[1];
    }
    if ($message) {
        dump($message, 'login : ');
        die;
    }
    dump($data, 'login : ');

    //获取 sessionId
    if(preg_match('/JSESSIONID=([\s\S]*?);/',$data,$matches)){
        $sessionId = $matches[1];
    }
    $header[] = "Cookie: JSESSIONID={$sessionId}";

    //第二步 获取网吧信息
    $url = 'https://qian.sicent.com/ucenter/accountSafe.do';
    $params = [];
    $data =  Http::get($url,$params,$header,true);
    //dump(htmlspecialchars($data), 'netbar : ');

    $netbarName = '';
    if(preg_match('/<div class="item"><span class="title">网吧名称：<\/span><span class="text">([\s\S]*?)<\/span><\/div>/',$data,$matches)){
        $netbarName = trim($matches[1]);
    }
    dump($netbarName, 'netbarName : ');


    //拿uuid
    $url = 'https://qian.sicent.com/Qdd/gamedesk.do';
    $params = [];
    $data =  Http::get($url,$params,$header,true);

    $uuid = '';
    if (preg_match('/\&uuid=([\s\S]*?)\&/', $data, $matches)) {
        $uuid = $matches[1];
    }
    dump($uuid, 'uuid : ');


    //拿sessionid (qdd.wxdesk.com)
    $url = 'https://qdd.wxdesk.com/login/';

    $params = [];
    $params['barshop_callback'] = 'chain/to-blank-page.do';
    $params['snbid'] = '3302220083';
    $params['childAccount'] = '';
    $params['userName'] = '';
    $params['uuid'] = $uuid;
    $params['snbidType'] = '2';
    $params['ptype'] = '1';
    $params['isSet'] = '1';
    $params['env'] = 'sicent';
    $params['tm'] = time() * 1000;

    //echo Http::_getInit($url, $params);die;
    $data =  Http::get($url,$params,$header,true);
    dump($data, 'cookies : ');

    $sid = 'xk8p0ebbs1zsyzrxqzammluntirjt8gv';
    if (preg_match('/sessionid=([\s\S]*?);/', $data, $matches)) {
        $sid = $matches[1];
    }
    dump($sid, 'sid : ');
    $token = '1c247230e4b940be95fd75a618710bb3';
    if (preg_match('/auth_token=([\s\S]*?);/', $data, $matches)) {
        $token = $matches[1];
    }
    dump($token, 'token : ');



    //第三步 获取用户列表
    $url = 'https://qdd.wxdesk.com/customer/customers';
    $header[] = "Cookie: snbid={$username}; sessionid={$sessionId}; auth_token={$token}";

    $params = [];
    $params['page'] = 1;
    $params['per_page_count'] = 2;
    $params['_'] = time()*1000;

    $data =  Http::get($url,$params,$header,true);
    dump(htmlspecialchars($data), 'user list : ');


    //第四步 获取商品列表
    //1. 登录获取 token
    $url = 'http://auth.wxdesk.com/auth/login';

    $params = [];
    $params['con_new'] = 'true';
    $params['con_ver'] = '5100';
    $params['password'] = $password;
    $params['snbid'] = $username;

    $data = Http::post($url, $params, $header, true);
    dump(htmlspecialchars($data), 'token : ');

    $data = explode("\n", $data);
    $data = end($data);
    $data = json_decode($data, true);
    $token = $data['data']['token'];

    //2. 获取商品列表
    $url = 'https://barshop.wxdesk.com/bar/barshop/commodity';

    $params = [];
    $params['token'] = $token;

    $data = Http::get($url, $params, $header, true);
    dump(htmlspecialchars($data), 'goods list : ');


    ////拿uuid
    //$url = 'https://qian.sicent.com/Qdd/barshopnewindex.do';
    //$params = [];
    //$data =  Http::get($url,$params,$header,true);
    //
    //$uuid = '';
    //if (preg_match('/\&uuid=([\s\S]*?)\&/', $data, $matches)) {
    //    $uuid = $matches[1];
    //}
    //dump($uuid, 'uuid : ');
    //
    ////拿sessionid (qdd.wxdesk.com)
    //$url = 'https://qdd.wxdesk.com/loginPage/market/';
    //$params = [];
    //$params['barshop_callback'] = 'chain/to-blank-page.do';
    //$params['snbid'] = '3302220083';
    //$params['uuid'] = $uuid;
    //$params['snbidType'] = '2';
    //$params['ptype'] = '1';
    //$params['isSet'] = '1';
    //$params['env'] = 'sicent';
    //$params['tm'] = time() * 1000;
    ////dump(Http::_getInit($url, $params), 'market uri : ');die;
    //$data =  Http::get($url,$params,$header,true);
    //dump($data, 'cookies : ');
    //
    //$sid = '';
    //if (preg_match('/sessionid=([\s\S]*?);/', $data, $matches)) {
    //    $sid = $matches[1];
    //}
    //dump($sid, 'sid : ');
    ////拿token
    //$token = '';
    //if (preg_match('/auth_token=([\s\S]*?);/', $data, $matches)) {
    //    $token = $matches[1];
    //}
    //dump($token, 'token : ');
    //
    ////JSESSIONID
    //$url = 'https://javabarshop.wxdesk.com/barshop/chain/to-blank-page.do';
    //$params = [];
    //$params['token'] = $token;
    //$data =  Http::get($url,$params,$header,true);
    //$jsid = '';
    //if (preg_match('/JSESSIONID=([\s\S]*?);/', $data, $matches)) {
    //    $jsid = $matches[1];
    //}
    //dump($jsid, 'JSESSIONID : ');
    //
    ////第四步 获取商品列表
    //$url = 'https://javabarshop.wxdesk.com/barshop/info/products-list.do';
    //$header[] = "Cookie: JSESSIONID={$jsid}";
    //$params = [];
    //$data =  Http::get($url,$params,$header,true);
    //dump(htmlspecialchars($data), 'goods list : ');


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