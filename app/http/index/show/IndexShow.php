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

        dump(IndexFacade::getName());
        dump(config('awork_version'));
        dump(config('database.type'));

        dump($_REQUEST);

        $this->display();
    }

    public function getSign()
    {
        $param = $_GET;
        $appid = isset($param['appid']) ? $param['appid'] : '';
        $username = isset($param['username']) ? $param['username'] : '';
        $timestamp = isset($param['timestamp']) ? $param['timestamp'] : '';
        $apptoken = '2137f21b35015e74d88bde55175af45d';

        Log::record($param, 'idxs');

        $sign = md5($appid . $username . $timestamp . $apptoken);

        Log::record($sign, 'idxs');

        $this->ajaxReturn([
            'code' => '000000',
            'sig' => $sign
        ]);
    }

}