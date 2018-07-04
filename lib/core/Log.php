<?php

namespace core;

class Log
{
    /**
     * 日志文件后缀名
     */
    const EXT       = '.log';

    /**
     * 日志级别 从上到下，由高到低
     */
    const EMERG     = 'EMERG';   // 严重错误: 导致系统崩溃无法使用
    const ALERT     = 'ALERT';   // 警戒性错误: 必须被立即修改的错误
    const CRIT      = 'CRIT';    // 临界值错误: 超过临界值的错误，例如一天24小时，而输入的是25小时这样
    const ERR       = 'ERR';     // 一般错误: 一般性错误
    const WARN      = 'WARN';    // 警告性错误: 需要发出警告的错误
    const NOTICE    = 'NOTIC';   // 通知: 程序可以运行但是还不够完美的错误
    const INFO      = 'INFO';    // 信息: 程序输出信息
    const DEBUG     = 'DEBUG';   // 调试: 调试信息
    const SQL       = 'SQL';     // SQL：SQL语句 注意只在调试模式开启时有效

    /**
     * 日志写入
     * @param mixed $message                     日志信息
     * @param string $module                     日志模块
     * @param string $level                      日志级别
     * @param string $file                       日志文件
     * @return mixed                             写入结果
     */
    private static function _write($message, $module, $level, $file)
    {
        if(is_array($message) || is_object($message)) {
            $message = var_export($message,true);
        }
        $logPath = self::_getLogPath($module);
        if(false === $logPath){
            return false;
        }
        $file = $file ? : date(config('log_date_format')).'/'.date(config('log_time_format')).self::EXT;
        $destination = $logPath.'/'.$file;
        $path = dirname($destination);
        // 避免文件读写出现问题而造成整个挂掉
        try{
            // 检测目录是否存在
            if (!is_dir($path)) {
                if (!mkdir($path, 0755, true)) {
                    return false;
                }
            }
            //检测日志文件大小，超过配置大小则备份日志文件重新生成
            if(is_file($destination) && floor(config('log_file_size')) <= filesize($destination) ){
                $destination = dirname($destination).'/'.basename($destination).'-over'.self::EXT;
            }
            $result = error_log('['.date("Y-m-d H:i:s").']['.ip().']['.$level.'] '.$message."\n", 3,$destination);
        }catch (\Exception $e){
            return false;
        }
        return $result;
    }

    /**
     * 获取日志存放路径
     * @param $module
     * @return mixed
     */
    private static function _getLogPath($module)
    {
        $config = config('log_path');
        if ('' == $module) {
            $logPath = $config['default'];
        } elseif (isset($config[$module])) {
            $logPath = $config[$module];
        } else {
            return false;
        }
        return $logPath;
    }

    /**
     * 记录日志 并且会过滤未经设置的级别
     * @param mixed $message                     日志信息
     * @param string $module                     日志模块
     * @param string $level                      日志级别
     * @param string $file                       日志文件
     * @return mixed                             写入结果
     */
    public static function record($message, $module, $level = self::INFO, $file = '') {
        if(false !== stripos(config('log_level'), $level)) {
            return false;
        }
        return self::_write($message, $module, $level, $file);
    }


}