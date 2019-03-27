<?php
//页面开始执行
main();

function main()
{

    /**
     * 熊猫网吧模拟登陆
     */
    $header = [
        'Accept: application/json, text/javascript, */*; q=0.01',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36',
        "X-Requested-With: XMLHttpRequest",
        ];
    //$sessionId = '220dg5lhm4t30ab59l0l27gi02'; //这个验证码可以自己生成没问题
    $sessionId = '8i2d7xvs67kifcaxusp3k7fca8';
    $header[] = "Cookie: PHPSESSID={$sessionId}";

    if(false){
        //1. 第一步
        //获取验证码
        $url = 'https://manager.xiongmaozhanggui.com/user/login/captcha?t=1523460826740';
        $data = Http::get($url,[],$header,false);
        file_put_contents("p.png",$data);
        echo '<img src="p.png" /><br/>';
        die;
    }else{
        //2. 第二步
        //模拟登录
        $url = 'https://manager.xiongmaozhanggui.com/user/login/dologin';
        $username = 'lindada';
        $password = 'z123123';
        $captcha  = '1288';

        $postData = [];
        $postData["user_name"] = $username;
        $postData["password"]  = $password;
        $postData["captcha"]   = $captcha;

        $data = Http::post($url,$postData,$header);
        echo 'login: ';dump($data);
        $dataArr = json_decode($data,true);
        if(1 !=$dataArr["status"]){
            echo $data;
            exit;
        }


        //获取会员列表
        $url = 'https://manager.xiongmaozhanggui.com/base/member/getMember?page=1&keyword=&search_type=1&start_reg_time=&end_reg_time=&start_login_time=&end_login_time=&integral_start=&integral_end=&online_start=&online_end=';
        $data = Http::get($url,[],$header);
        echo 'user list:';dump($data);

        //这里返回的json - VC 得到列表之后,再获取用户详细信息,一起给我
        //$data = json_decode($data,true);
        //$returnData = [];
        //if(!empty($data)){
        //    $returnData = $data["tips"];
        //    foreach ($returnData["list"]["data"] as $key =>  $info){
        //        $mid = $info["member_id"];
        //        $getDetailUrl = 'https://manager.xiongmaozhanggui.com/base/member/details?mid='. $mid;
        //        $detail = Http::get($getDetailUrl,[],$header);
        //        $returnData["list"]["data"][$key]["detail"] = $detail;
        //    }
        //}
        //$returnData = json_encode($returnData);



        // 登录进销存
        $url = 'https://manager.xiongmaozhanggui.com/user/netbar/invLogin';
        $data = Http::get($url,[],$header);
        $data = json_decode($data, true);
        echo 'invoicing login url :';dump($data['tips']);

        //'https://invoicing.xiongmaozhanggui.com/apis/auto?time=1550742481.75377000&token=qxz465ejixvso8tss58wwg8ocwixqq5u&security=5624fd498bb15e8d976928a7efc4327a'
        $url = $data['tips'];
        $data = Http::get($url,[],$header, true);
        echo 'invoicing info:';dump(htmlspecialchars($data));

        //拿sid
        $sid = '';
        if (preg_match('/panda_invoincing_session=([\s\S]*?);/', $data, $matches)) {
            $sid = $matches[1];
        }
        dump($sid, 'sid : ');
        //拿token
        $token = '';
        if (preg_match('/XSRF-TOKEN=([\s\S]*?);/', $data, $matches)) {
            $token = $matches[1];
        }
        dump($token, 'token : ');


        $url = 'https://invoicing.xiongmaozhanggui.com/apis/goods/goods/data';
        $header[] = "Cookie: X-XSRF-TOKEN={$token};panda_invoincing_session={$sid}";
        $header[] = "X-XSRF-TOKEN: {$token}";

        $params = [];
        $params['page'] = 1;
        $params['pageSize'] = 1;
        $params['_token'] = '';
        //$params['category'] = '';
        //$params['goods_type'] = '';
        //$params['is_enable'] = '';
        //$params['keyword'] = '';
        //$params['order_by'] = '';
        //$params['sort'] = '';
        $data = Http::get($url, $params,$header, true);
        dump(htmlspecialchars($data), 'goods list : ');

    }

    /**
     * 提交给我的信息结构\
     *
     * {
        page: 1,
        list: {
        count: 2,
        data: [
        {
        member_id: "20254886",
        account: "miji2006",
        nickname: "miji2006",
        mobile: "13989868383",
        recent_login_time: "1525673246",
        current_integral: "0",
        internet_times: "1",
        detail: "{"status":1,"msg":"\u6210\u529f","tips":{"base":"\n\t\u4f1a\u5458\u8d26\u53f7<\/td>\n\tmiji2006<\/td>\n\t\u4f1a\u5458\u6635\u79f0<\/td>\n\tmiji2006<\/td>\n<\/tr>\n\n\t\u624b\u673a\u53f7\u7801<\/td>\n\t13989868383<\/td>\n\t\u51fa\u751f\u65e5\u671f<\/td>\n\t<\/td>\n<\/tr>\n\n\tQQ\u53f7\u7801<\/td>\n\t<\/td>\n\t\u6027\u522b<\/td>\n\t<\/td>\n<\/tr>\n\n\t\u6ce8\u518c\u65f6\u95f4<\/td>\n\t2018-05-07 14:07:26<\/td>\n\t\u6700\u8fd1\u767b\u5f55<\/td>\n\t2018-05-07 14:07:26<\/td>\n<\/tr>\n\n\t\u8eab\u4efd\u8bc1\u53f7<\/td>\n\t<\/td>\n<\/tr>","account":"\n\t\u7d2f\u8ba1\u79ef\u5206<\/td>\n\t0<\/td>\n\t\u5f53\u524d\u79ef\u5206<\/td>\n\t0<\/td>\n<\/tr>\n\n\t\n\t\u7b7e\u5230\u6b21\u6570<\/td>\n\t0<\/td>\n\t\u5728\u7ebf\u65f6\u957f<\/td>\n\t0\u5c0f\u65f6<\/td>\n<\/tr>\n\n"}}"
        },
        {
        member_id: "19411221",
        account: "",
        nickname: "虚言丶丶",
        mobile: "",
        recent_login_time: "1523869556",
        current_integral: "2",
        internet_times: "1",
        detail: "{"status":1,"msg":"\u6210\u529f","tips":{"base":"\n\t\u4f1a\u5458\u8d26\u53f7<\/td>\n\t<\/td>\n\t\u4f1a\u5458\u6635\u79f0<\/td>\n\t\u865a\u8a00\u4e36\u4e36<\/td>\n<\/tr>\n\n\t\u624b\u673a\u53f7\u7801<\/td>\n\t<\/td>\n\t\u51fa\u751f\u65e5\u671f<\/td>\n\t<\/td>\n<\/tr>\n\n\tQQ\u53f7\u7801<\/td>\n\t<\/td>\n\t\u6027\u522b<\/td>\n\t<\/td>\n<\/tr>\n\n\t\u6ce8\u518c\u65f6\u95f4<\/td>\n\t2018-04-16 17:05:56<\/td>\n\t\u6700\u8fd1\u767b\u5f55<\/td>\n\t2018-04-16 17:05:56<\/td>\n<\/tr>\n\n\t\u8eab\u4efd\u8bc1\u53f7<\/td>\n\t<\/td>\n<\/tr>","account":"\n\t\u7d2f\u8ba1\u79ef\u5206<\/td>\n\t2<\/td>\n\t\u5f53\u524d\u79ef\u5206<\/td>\n\t2<\/td>\n<\/tr>\n\n\t\n\t\u7b7e\u5230\u6b21\u6570<\/td>\n\t0<\/td>\n\t\u5728\u7ebf\u65f6\u957f<\/td>\n\t0\u5c0f\u65f6<\/td>\n<\/tr>\n\n"}}"
        }
        ]
        },
        total_page: 1
        }
     */

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
