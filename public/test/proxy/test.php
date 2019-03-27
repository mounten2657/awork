<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/03/20
 * @internal wujun
 */

// 页面执行
main();

// 主函数
function main()
{
    $test = new TestClass();
    $methodAry = get_class_methods($test);
    $methodName = $methodAry[0];
    $data = $test->$methodName();
    dump($data);
    return true;
}

// 打印函数
function dump($var){echo "<pre>";var_dump(htmlspecialchars(var_export($var, true)));echo "</pre>";}

/**
 * 测试函数
 * [!] 执行第一个方法为测试方法
 * Class TestClass
 */
class TestClass
{
    private static $count = 0;

    public function testGuzzle()
    {
        $url = 'http://www.xiaobaibar.cn/api/admin/outside/articleinfo';
        $params = ['article_id' => 34];
        $method = 'GET';

        require '../../../vendor/autoload.php';
        $client = new \GuzzleHttp\Client();
        $params = strtoupper($method) == 'GET' ? ['query' => $params] : ['form_params' => $params];
        $response = $client->request($method, $url, $params);
        $data = $response->getBody()->getContents();
        $data = json_decode($data, true);
        return $data;
    }

    public function testPhpinfo()
    {
        return phpinfo();
    }

    public function testCount()
    {
        $test1 = new TestClass();
        $test2 = new TestClass();
        $test3 = new TestClass();

        echo $test1->getCount()."<br>";  //3
        unset($test3);
        echo $test1->getCount()."<br>";  //2
        return true;
    }

    public function __construct()
    {
        self::$count += 1;
        //echo "<br>construct---:".self::$count."---<br>";
    }

    public function getCount()
    {
        return self::$count;
    }

    public function __destruct()
    {
        self::$count -= 1;
        //echo "<br>destruct---:".self::$count."---<br>";
    }
}