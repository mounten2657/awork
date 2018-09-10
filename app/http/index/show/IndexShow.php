<?php

namespace app\http\index\show;

use app\http\BaseShow;
use app\http\index\facade\IndexFacade;
use core\Log;

class IndexShow extends BaseShow
{

    public function index()
    {
        dump(intval(floatval(2.05) * 100));
        dump(intval(2.05 * 1000 /10));

        dump(config('awork_version'));
        
        $list = IndexFacade::getOperationTreeList();
        dump($list);

        $this->display();
    }

    public function getClientIp()
    {
        dump(ROUTE_PATH);
        dump($_REQUEST['catch']);
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

        $this->ajaxReturn([
            'code' => '000000',
            'sig' => $sign
        ]);
    }

}