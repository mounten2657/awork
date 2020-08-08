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
use database\Db;

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
        $target = sapp()->request()->get('tcode', 'index');
        if ($target != 'index') {
            return $this->$target();
        }
        echo "Current ID : " . md5(time()) . "<br>";
        $listHtml = '';
        $methods = get_class_methods($this);
        foreach ($methods as $key => $method) {
            if ($key == 0) continue;
            $listHtml .= "--$key. [<a href='/test/index?tcode={$method}' target='_blank'>$method</a>]&nbsp;";
            if ($key % 4 == 0) {
                $listHtml .= "<br>";
            }
        }
        echo $listHtml;
    }

    /**
     * merge test
     */
    public function mergeTest()
    {
        echo '<pre>';
        $ar1 = array('b' => 'xx=123','h' => array('aa','bb'),'t' => array(1,2,4));
        $ar2 = array('b' => array('xx' => 221),'h' => array('aa','bb','cc'),'t' => array(1,3,4));
        $ar3 = array_merge($ar1, $ar2);
        print_r($ar3);
    }

    /**
     * generate short css
     */
    public function getShortCss()
    {
        $str = '';
        for ($i = 0; $i <= 50; $i++) {
            $str .= '.mg-'.$i.' {margin: '.$i.'px;}'.PHP_EOL;
            $str .= '.mg-t-'.$i.' {margin-top: '.$i.'px;}'.PHP_EOL;
            $str .= '.mg-r-'.$i.' {margin-right: '.$i.'px;}'.PHP_EOL;
            $str .= '.mg-b-'.$i.' {margin-bottom: '.$i.'px;}'.PHP_EOL;
            $str .= '.mg-l-'.$i.' {margin-left: '.$i.'px;}'.PHP_EOL;
            $str .= PHP_EOL;
            $str .= '.pd-'.$i.' {padding: '.$i.'px;}'.PHP_EOL;
            $str .= '.pd-t-'.$i.' {padding-top: '.$i.'px;}'.PHP_EOL;
            $str .= '.pd-r-'.$i.' {padding-right: '.$i.'px;}'.PHP_EOL;
            $str .= '.pd-b-'.$i.' {padding-bottom: '.$i.'px;}'.PHP_EOL;
            $str .= '.pd-l-'.$i.' {padding-left: '.$i.'px;}'.PHP_EOL;
            $str .= PHP_EOL;
        }
        for ($i = 0; $i <= 30; $i ++) {
            $str .= '.lh-'.(str_replace('.', '_', $i*10/100)).' {line-height: '.($i*10/100).'em;}'.PHP_EOL;
        }
        echo $str;
    }

    /**
     * sacPostTest
     * @return bool
     */
    public function sacPostTest()
    {
        $request = sapp()->request()->all();
        $header = sapp()->request()->header();
        $request = array_merge($request, array('header' => $header));
        $data = ['code' => 0, 'data' => $request, 'message' => 'sacPostTest'];
        return sapp()->response()->data($data)->debug(0);
    }

    /**
     * sacDelTest
     * @return bool
     */
    public function sacDelTest()
    {
        $request = sapp()->request()->all();
        return sapp()->response()->data(['code' => 0, 'data' => $request, 'message' => 'sacDelTest']);
    }

    /**
     * xlsTest
     * @return bool
     */
    public function xlsTest()
    {
        $config = ['path' => '/tmp/'];
        $excel  = new \Vtiful\Kernel\Excel($config);

        $filename = "t01.xlsx";
        $filePath = $excel->fileName($filename, 'sheet1')
            ->header(['Item', 'Cost'])
            ->data([
                ['Rent', 1000],
                ['Gas',  100],
                ['Food', 300],
                ['Gym',  50],
            ])
            ->output();
        //return sapp()->response()->ok(['path' => $filePath]);
        return sapp()->download()->setOption([
            'file' => $config['path'].$filename,
        ])->down();
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

    /**
     * phpinfo
     */
    public function phpinfo()
    {
        phpinfo();
    }

    /**
     * first index
     * @return mixed
     */
    public function first()
    {
        $methods = get_class_methods($this);
        $method = $methods[1];
        return $this->$method();
    }

}