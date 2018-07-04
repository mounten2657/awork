<?php

namespace core;

class AutoLoader
{

    /**
     * 文件后缀
     */
    const EXT = '.php';

    /**
     * 自动加载文件
     * @var array
     */
    private static $_AUTOLOAD_FILES = [];

    /**
     * 自动加载配置
     * @var array
     */
    private static $_AUTOLOAD_CONFIG = [];

    /**
     * 查找类文件
     * @param $class
     * @return string
     */
    private static function _findClassFile($class)
    {
        // 查找类文件
        if(false !== strpos($class,'\\')){
            $name           =   strstr($class, '\\', true);
            if(in_array($name, self::$_AUTOLOAD_CONFIG['AUTOLOAD_LIBRARY']) || is_dir(LIB_PATH.$name)){
                // lib目录下面的命名空间自动定位
                $path       =   LIB_PATH;
            }else{
                // 检测自定义命名空间 否则就以模块为命名空间
                $namespace  =   self::$_AUTOLOAD_CONFIG['AUTOLOAD_NAMESPACE'];
                $path       =   isset($namespace[$name]) ? dirname($namespace[$name]) . DIRECTORY_SEPARATOR : ROOT_PATH;
            }
            $filename       =   $path . str_replace('\\', DIRECTORY_SEPARATOR, $class) . self::EXT;
            if(is_file($filename)) {
                return $filename;
            }
        }
        // 返回本类文件
        return strtr($class, '\\', DIRECTORY_SEPARATOR) . self::EXT;
    }

    /**
     * 查找配置文件
     * @param $path
     * @return array
     */
    private static function _findConfigFile($path)
    {
        $configFile = [];
        if (!isset(self::$_AUTOLOAD_FILES[$path])) {
            self::$_AUTOLOAD_FILES[$path] = [];
        }
        if (in_array($path, ['AUTOLOAD_COMMON', 'AUTOLOAD_CONFIG'])) {
            foreach (self::$_AUTOLOAD_CONFIG[$path] as $dir) {
                $files = self::_scanFile($dir);
                foreach ($files as $file) {
                    $fileName = $dir.DIRECTORY_SEPARATOR.$file;
                    if (!in_array($fileName, self::$_AUTOLOAD_FILES[$path])) {
                        if (is_file($fileName)) {
                            $configFile[] = $fileName;
                            self::$_AUTOLOAD_FILES[$path][] = $fileName;
                        }
                    }
                }
            }
        }
        return $configFile;
    }

    /**
     * 扫描文件
     * @param $path
     * @return array
     */
    private static function _scanFile($path)
    {
        $item = scandir($path);
        foreach ($item as $k=>$v) {
            if ($v == '.' || $v == '..') {
                continue;
            }
            $v = $path.DIRECTORY_SEPARATOR.$v;
            if (is_dir($v)) {
                return self::_scanFile($v);
            }else{
                $file[] = basename($v);
            }
        }
        return $file;
    }

    /**
     * 自动加载
     * @param $class
     * @return bool
     */
    public static function autoload($class)
    {
        // 加载类文件
        if ($file = self::_findClassFile($class)) {
            // Win环境严格区分大小写
            if (IS_WIN && pathinfo($file, PATHINFO_FILENAME) != pathinfo(realpath($file), PATHINFO_FILENAME)) {
                return false;
            }
            include $file;
        }
        // 加载配置文件
        foreach (array_keys(self::$_AUTOLOAD_CONFIG) as $path) {
            foreach (self::_findConfigFile($path) as $file) {
                $config = include $file;
                if (is_array($config)) {
                    Config::load($file);
                }
            }
        }
        return true;
    }

    /**
     * 注册自动加载机制
     * @param string $autoload
     */
    public static function register($autoload = '')
    {
        // 注册系统自动加载
        spl_autoload_register($autoload ? : 'core\\AutoLoader::autoload', true, true);
        // 加载基本配置文件
        if (empty(self::$_AUTOLOAD_CONFIG)) {
            $file = LIB_PATH.'core/auto-path'.self::EXT;
            self::$_AUTOLOAD_CONFIG = is_file($file) ? include $file : [];
        }
        // 设定错误和异常处理
        self::setError();
    }

    /**
     * 错误和异常处理
     */
    public static function setError()
    {
        error_reporting(E_ALL);
        // 错误处理方法
        set_error_handler([__CLASS__, 'appError']);
        // 异常处理方法
        set_exception_handler([__CLASS__, 'appException']);
        // 应用关闭方法
        register_shutdown_function([__CLASS__, 'appShutdown']);
    }

    /**
     * Error Handler
     * @param  integer $errno   错误编号
     * @param  integer $errstr  详细错误信息
     * @param  string  $errfile 出错的文件
     * @param  integer $errline 出错行号
     */
    public static function appError($errno, $errstr, $errfile, $errline) {
        switch ($errno) {
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                ob_end_clean();
                $errorStr = "$errstr ".$errfile." 第 $errline 行.";
                break;
            default:
                $errorStr = "[$errno] $errstr ".$errfile." 第 $errline 行.";
                break;
        }
        Log::record($errorStr, 'erra', Log::ERR);
        dump($errorStr);
        abort(405);
    }

    /**
     * Exception Handler
     * @param mixed $e 异常对象
     */
    public static function appException($e) {
        $error = array();
        $error['message']   =   $e->getMessage();
        $trace              =   $e->getTrace();
        if('E'==$trace[0]['function']) {
            $error['file']  =   $trace[0]['file'];
            $error['line']  =   $trace[0]['line'];
        }else{
            $error['file']  =   $e->getFile();
            $error['line']  =   $e->getLine();
        }
        $error['trace']     =   $e->getTraceAsString();
        Log::record($error, 'erra', Log::ERR);
        dump($error);
        // 发送404信息
        abort(404);

    }

    /**
     * Shutdown Handler
     */
    public static function appShutdown() {
        if ($e = error_get_last()) {
            switch($e['type']){
                case E_ERROR:
                case E_PARSE:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:
                    ob_end_clean();
                    break;
            }
            dump($e);
            Log::record($e, 'erra', Log::ERR);
            abort(403);
        }
    }

}
