<?php
//页面开始执行
main();

function main(){
    /**
     * 锤子大爷网吧模拟登陆
     */
    $header = [
        'Accept: application/json, text/javascript, */*; q=0.01',
        'Referer: http://yun3.daye666.com/Bars',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
        'Origin : http://yun3.daye666.com',
        "X-Requested-With: XMLHttpRequest",
        ];

    //1. 第一步

    //模拟登陆 - 这家没有验证码
    $username = 'lindada';
    $password = strtoupper(md5('z123123'));

    $url = 'http://yun3.daye666.com/bars/Login/verify';
    $postData = [];
    $postData['u'] = $username;
    $postData['p'] = $password;
    $data =  Http::post($url,$postData,$header,true);
    //获取登录的session
    if(preg_match('/ew_bars=([\s\S]*?);/',$data,$matches)){
        $sessionId = $matches[1];
    }
    //获取返回信息
    $dataArr = explode("\n",$data);
    $result = end($dataArr);
    $resultArr = json_decode($result,true);
    if(true !== $resultArr["success"]){
        echo "登录失败" . $resultArr["msg"];
        exit;
    }
    echo 'login : ';dump($resultArr);

    //2. 第二步
    //获取验证的key
    $url = 'http://yun3.daye666.com/bars/main';
    $getKeyHeader = $header;
    $getKeyHeader[] =  "Cookie: ew_bars={$sessionId}";
    $data = Http::get($url,[],$getKeyHeader,true);

    //获取请求的token信息
    $tokenCookie = '';
    if(preg_match('/__RequestVerificationToken=([\s\S]*?);/',$data,$matches)){
        $tokenCookie = $matches[1];
    }
    //获取请求的验证token信息
    $tokenParam = '';
    if(preg_match('/<input name="__RequestVerificationToken" type="hidden" value="([\s\S]*?)" \/>/',$data,$matches)){
        $tokenParam = $matches[1];
    }

    //设置头信息回话标识
    $header[] = "Cookie: __RequestVerificationToken={$tokenCookie}; ew_bars={$sessionId}";


    //3 . 第三步

    //获取网吧列表
    $url = 'http://yun3.daye666.com/bars/main/get';
    $postData = [];
    $postData["__RequestVerificationToken"]  = $tokenParam;
    $postData["CusQueryKey"] = 'bars';

    $data =  Http::post($url,$postData,$header,false);
    $dataArr = json_decode($data,true);
    echo 'netbar : ';dump($dataArr);

    //4 .第四步

    //切换网吧 - 默认选择一个网吧
    $netbarInfo = $dataArr[0];
    $barId = $netbarInfo["BarID"];
    $barIdg = $netbarInfo["BarIDG"];
    $url = 'http://yun3.daye666.com/bars/main/ChangeBar';
    $postData = [];
    $postData["barid"] = $barId;
    $postData["baridg"] = $barIdg;
    $postData["__RequestVerificationToken"] = $tokenParam;
    $data = Http::post($url,$postData,$header,false);
    $dataArr = json_decode($data,true);
    if(true !== $dataArr["success"]){
        echo "切换网吧失败";
        exit;
    }


    //第五步 - 获取用户列表
    //$url = 'http://yun3.daye666.com/Bars/Members/Get';
    $url = 'http://yun3.daye666.com/bars/Members/Get?CusQueryKey=newmember';

    $postData = [];
    $postData["_search"] = false;
    $postData["nd"] = time() * 1000;
    $postData["rows"] = 50;
    $postData["page"]  = 1;//页数 - 第一页
    $postData["sidx"]  = "LastUpdateTime";
    $postData["sord"]  = "desc";
    $postData["cSearchAdvanced"] = '{"barid":'.$barId.',"__RequestVerificationToken":"'.$tokenParam.'"}';
    $postData["__RequestVerificationToken"] = $tokenParam;
    $data = Http::post($url,$postData,$header,false);
    $data = json_decode($data, true);
    echo 'user list : ';dump($data); //这里面直接返回的json

}

function dump($var){echo "<pre>";var_dump($var);echo "</pre>";}

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
