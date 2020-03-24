<?php
/**
 * FileNotes
 * @copyright (c) 2012-2020, Hangzhou Awork Tech Co., Ltd.
 * This is NOT a freeware, use is subject to license terms.
 * @package TestApi.php
 * @link http://www.awork.com
 * @author wujun
 * @: TestApi.php 311001 2020-03-24 15:28:54 wujun $
 * */

namespace app\http\index\api;

use app\http\index\facade\IndexFacade;
use core\Http;
use core\Log;

/**
 * ���� API
 * Class TestApi
 * @package app\http\index\api
 */
class TestApi
{

    /**
     * index
     */
    public function index()
    {
        echo "current: " . md5(time());
    }

    /**
     * mathTest
     */
    public function mathTest()
    {
        $math = [
            'intval(floatval(2.05) * 100)' => intval(floatval(2.05) * 100),
            'intval(2.05 * 1000 /10)' => intval(2.05 * 1000 /10),
        ];
        dump($math);
    }

    /**
     * getClientIp
     */
    public function getClientIp()
    {
        dump(ROUTE_PATH);
        $list = IndexFacade::getOperationTreeList();
        dump($list);
        Log::record('getClientIp: '.gethostbyname(gethostname()), 'index/client');
        dump(IndexFacade::getName());
    }

    /**
     * getSign
     */
    public function getSign()
    {
        $param = $_GET;
        $appid = isset($param['appid']) ? $param['appid'] : '';
        $username = isset($param['username']) ? $param['username'] : '';
        $timestamp = isset($param['timestamp']) ? $param['timestamp'] : '';
        $apptoken = '2137f21b35015e74d88bde55175af45d';

        Log::record($param, 'index/sign');

        $sign = md5($appid . $username . $timestamp . $apptoken);

        Log::record($sign, 'index/sign');

        Http::ajaxReturn([
            'code' => '000000',
            'sig' => $sign
        ]);
    }

}