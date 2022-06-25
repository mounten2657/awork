<?php

// 随意填
$sessionId = '6q2t1mst09ednrkiomt2e7ibp6';
$data = '{"info":"登录成功！","status":1,"url":""}';
if(false){
    $data = Linghang::verifyCode($sessionId);
    file_put_contents('lh.png',Http::getContent($data));
    echo '<img src="lh.png" /><br/>';
    die;
}elseif(true){
    //2. 登录
    $verifycode = '9333';
    //$data = Linghang::login("xuanhuanwangka","123456",$sessionId,$verifycode);
    dump($data, 'login : ');

    $url = 'https://gl-lh.wwwscn.com/netbar.php?m=Netbar&c=Netbar&a=baseInfo';
    $data = Http::get($url,[],$sessionId);
    //dump(htmlspecialchars($data), 'netbar info : ');

    $netbarName = '';
    if(preg_match('/\$\(\'#name\'\)\.html\(([\s\S]*?)\)/',$data,$matches)){
        $netbarName = $matches[1];
    }
    dump($netbarName, 'netbarName : ');

    //3. 获取用户信息 - 此信息丢给PHP解析 - 获取用户列表
    $url = 'https://gl-lh.wwwscn.com/netbar.php?m=Netbar&c=User&a=index&istmpl=0&_order=&_sort=&searchtype=&re_b=&re_e=&log_b=&log_e=&t1=&t2=&f1=&f2=&v1=-1&v2=-1&is_tmpl=0&func=&isbig=&p=1'; // p=页数
    $data = Http::get($url,[],$sessionId);
    dump(htmlspecialchars($data), 'user list : ');

    //4 . PHP返回的列表 - VC请求顺网的详细信息,返回返回给我解析 - 写入前一步返回的json中,base
    $url = 'https://gl-lh.wwwscn.com/netbar.php?m=Netbar&c=User&a=edit&uid=622287'; // uid = 用户ID
    $data = Http::get($url,[],$sessionId);
    dump(htmlspecialchars($data), 'user info : ');

}

class Linghang
{
    public static function verifyCode($sessionId){
        $getData = [];
        $getData['m'] = "Master";
        $getData['c'] = "Public";
        $getData['a'] = "verify";
        return Http::get("https://gl-lh.wwwscn.com/index.php",$getData,$sessionId);
    }

    //http://lh.wwwscn.com
    /**
    username:aaaaaa
    key:d7fc148a470d03607f8957a1a8c92009
    t:1522682905
    key1:736c31448a2a27fdbd3dfadd2b42757d
    verifycode:7932
    from:web
    _changeids:username,key,t,key1,verifycode
    */
    public static function login($username,$password,$sessionId,$verifycode){
        $postData = [];
        $postData['username'] = $username;
        $postData['t'] = time();
        $postData['key1'] = md5('pass_111*'.$username.$password);
        $postData['key'] = md5('pass_111*'.$username.$postData['t'].$postData['key1']);
        $postData['verifycode'] = $verifycode;
        $postData['from'] = "web";
        $postData['_changeids'] = "username,key,t,key1,verifycode";
        return Http::post("https://gl-lh.wwwscn.com/index.php?m=Master&c=Public&a=checkLogin",$postData,$sessionId);
    }
}

function dump($var, $msg = ''){echo $msg;echo "<pre>";var_dump($var);echo "</pre>";}

class Http
{
    private static $_headers = [
        'Referer: https://gl-lh.wwwscn.com/index.php?m=Master&c=Public&a=login_new&from=web',
        'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.108 Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
        'Origin: https://gl-lh.wwwscn.com'
        ];

    public static function getContent($data){
        list($head,$content) = explode("\r\n\r\n",$data);
        return $content;
    }

    public static function get($url, $params=array(), $sessionId=''){
        if(!empty($params)){
            $aGet = array();
            foreach($params as $key => $val){
                $aGet[] = $key."=".urlencode($val);
            }
            $url = $url."?".join("&",$aGet);
        }
        return self::_get($url, $sessionId);
    }

    private static function _get($url, $sessionId=''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        if(!empty($sessionId)){
            curl_setopt($ch, CURLOPT_COOKIE,'PHPSESSID='.$sessionId.';');
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function post($url, $params=array(), $sessionId=''){
        return self::_post($url, $params, $sessionId);
    }

    private static function _post($url, $params='', $sessionId=''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::$_headers);
        if(!empty($sessionId)){
            curl_setopt($ch, CURLOPT_COOKIE,'PHPSESSID='.$sessionId.';');
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
