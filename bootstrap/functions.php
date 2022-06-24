<?php

use Illuminate\Support\Facades\Redis;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Formatter\LineFormatter;

if (!function_exists('glog')) {
    /**
     * 写日志(自定义日志文件)
     *
     * @param string $logfile 日志文件名
     * <li>日志会建立在系统 storage/logs/{$logfile}.log 下</li>
     * @return Monolog\Logger
     * @example glog('sms')->addInfo('sms_send', ['id'=>rand(1000, 9999)]);
     */
    function glog(string $logfile): Logger {
        static $oLoger = [];
        if (!isset($oLoger[$logfile])){
            $oLoger[$logfile] = new Logger($logfile);
            $oHandler = new RotatingFileHandler(storage_path('logs/'. $logfile .'.log'), 5);
            //重定义格式
            $output = '{"t":"%datetime%","level":"%level_name%","msg":"%message%","dt":%context%}'. PHP_EOL;
            $oHandler->setFormatter(new LineFormatter($output));
            $oLoger[$logfile]->pushHandler($oHandler);
        }
        return $oLoger[$logfile];
    }
}

if (!function_exists('gredis')) {
    /**
     * 获取 redis 实例
     *
     * @param string $sName    redis 配置项
     * @return Illuminate\Support\Facades\Redis|Predis\Client
     * <li> Client </li>
     * @date 2022/01/24 14:17
     * @example gredis()->get('xxx');
     */
    function gredis(string $sName = 'default') {
        static $aRedis = [];
        if (!isset($aRedis[$sName])) {
            $aRedis[$sName] = Redis::connection($sName);
        }
        return $aRedis[$sName];
    }
}

if (!function_exists('baseUrl')) {
    /**
     * 获取项目域名
     *
     * @param mixed $sPath 相对路径  eg: /x/y/z.html | false
     * @return mixed 完整项目链接
     * @author smplote@google.com
     * @date 2021/12/25 20:15
     * <li> http://localhost </li>
     */
    function baseUrl($sPath = ''){
        $sUrl = config('app.url') ?: env('APP_URL');
        // 去除结尾多余的 /
        if ('/' === substr($sUrl, -1, 1)) {
            $sUrl = substr($sUrl, 0, -1);
        }
        if (false !== $sPath) {
            return $sUrl . '/' . $sPath;
        }
        return $sUrl;
    }
}
