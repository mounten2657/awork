<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/02/26
 * @internal wujun
 */

//页面执行
main();

function main(){

    //Request Header
    $header = [
        'Accept: application/json, text/javascript, */*; q=0.01',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
    ];
    $data = '{"status":1,"message":"登陆成功","data":{"_url":"/site"}}';
    $sessionId = 'vptdkdet8i1lf4ikt4cr8m42ao123';

    //第一步 模拟登陆
    $username = 'mohaiyang';
    $password = '123456';
    $url = 'https://a.guanliyuangong.com/login';
    $params = [];
    $params['username'] = $username;
    $params['password'] = $password;
    $data =  Http::post($url,$params,$header, true);
    dump(htmlspecialchars($data), 'login : ');

    if(preg_match('/backend=([\s\S]*?);/',$data,$matches)){
        $sessionId = $matches[1];
    }
    //dump($sessionId, 'sessionId : ');
    $data = explode("\n", $data);
    $data = end($data);
    $data = json_decode($data, true);
    if (1 != $data['status']) {
        die('登录失败： '.$data['message']);
    }

    $token = '';
    $header[] = "cookie: backend={$sessionId};_csrf-backend={$token}";


    //第二步 获取网吧信息
    $url = 'https://a.guanliyuangong.com/site';
    $params = [];
    $data =  Http::get($url,$params,$header,true);
    //dump(htmlspecialchars($data), 'netbar : ');

    $netbarName = '';
    if(preg_match('/<i class="linea-icon linea-basic fa fa-th"\><\/i\><br\/\>([\s\S]*?)<\/a\>/',$data,$matches)){
        $netbarName = trim($matches[1]);
    }
    dump($netbarName, 'netbarName : ');


    //第三步 获取用户列表
    $url = 'https://a.guanliyuangong.com/user/index';
    $params = [];
    $data =  Http::get($url,$params,$header,true);
    dump(htmlspecialchars($data), 'user list : ');


    //第四步 获取商品列表
    $url = 'https://a.guanliyuangong.com/goods/index';
    $params = [];
    $data =  Http::get($url,$params,$header,true);
    dump(htmlspecialchars($data), 'goods list : ');


}

function dump($var, $msg = ''){echo $msg;echo "<pre>";var_dump($var);echo "</pre>";}

class Http
{

    private static function _getInit($url, $params)
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
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
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
