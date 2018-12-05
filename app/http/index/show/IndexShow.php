<?php

namespace app\http\index\show;

use app\http\BaseShow;
use app\http\index\facade\IndexFacade;
use core\Http;
use core\Log;

class IndexShow extends BaseShow
{

    /**
     * 首页
     */
    public function index()
    {
        $aworkVersion = config('awork_version');

        $math = [
            'intval(floatval(2.05) * 100)' => intval(floatval(2.05) * 100),
            'intval(2.05 * 1000 /10)' => intval(2.05 * 1000 /10),
            //'test' => 'TEST',
        ];
        //$rest = $math['test'];
        $this->display([
            'awork_version' => $aworkVersion,
            'math' => $math,
        ]);
    }

    public function getClientIp()
    {
        dump(ROUTE_PATH);
        $list = IndexFacade::getOperationTreeList();
        dump($list);
        Log::record('getClientIp: '.gethostbyname(gethostname()), 'index/client');
        dump(IndexFacade::getName());
    }

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