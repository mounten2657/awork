<?php

namespace core;

class App
{

    /** @var array PATH_INFO 解析结果集 */
    private static $_pathInfo = [];

    /**
     * 应用初始化
     * @return bool
     */
    private static function _init()
    {
        // 全局安全过滤
        array_walk_recursive($_GET,		'awork_filter');
        array_walk_recursive($_POST,	'awork_filter');
        array_walk_recursive($_REQUEST,	'awork_filter');

        // 定义当前请求的系统常量
        define('NOW_TIME',      $_SERVER['REQUEST_TIME']);
        define('REQUEST_METHOD',$_SERVER['REQUEST_METHOD']);
        define('IS_GET',        REQUEST_METHOD =='GET' ? true : false);
        define('IS_POST',       REQUEST_METHOD =='POST' ? true : false);
        define('IS_PUT',        REQUEST_METHOD =='PUT' ? true : false);
        define('IS_DELETE',     REQUEST_METHOD =='DELETE' ? true : false);

        // 定义应用目录层
        define('APP_MODULE_LAYER', 'http');
        define('APP_MODULE_LAYER_GROUP', 'api,facade,show');
        define('APP_ROUTE_LAYER', 'route');

        // 设置时区
        date_default_timezone_set(config('default_timezone'));
        // 设置路由解析方式
        define('ROUTE_MODE', config('default_route_mode'));

        return true;
    }

    /**
     * 应用执行 - 通过反射类
     * @throws \ReflectionException
     * @return bool
     */
    private static function _exec()
    {
        // init request parameters
        self::_initParameters();

        // check module exist
        if (!is_dir(APP_PATH.APP_MODULE_LAYER.DIRECTORY_SEPARATOR.MODULE_NAME)) {
            throw new \Exception('MODULE NOT EXIST', 404);
        }

        // invoke app
        $controllerName = self::_getControllerName();
        $controllerInstance = new $controllerName();
        $methodInstance = new \ReflectionMethod($controllerInstance, ACTION_NAME);
        $methodInstance->invoke($controllerInstance);

        return true;
    }

    /**
     * 整合请求参数
     */
    private static function _initParameters()
    {
        // 保证$_REQUEST正常取值
        $prefix = config('url_dispatcher.var_prefix');
        unset($_GET[$prefix.config('url_dispatcher.var_pathinfo')]);
        unset($_GET[$prefix.config('url_dispatcher.var_module')]);
        unset($_GET[$prefix.config('url_dispatcher.var_controller')]);
        unset($_GET[$prefix.config('url_dispatcher.var_action')]);
        $_REQUEST = array_merge($_POST, $_GET);
    }

    /**
     * 获取控制类位置
     * @return string
     */
    private static function _getControllerName()
    {
        $appLayer = explode('/',substr(APP_PATH,0,-1));
        $controllerName = end($appLayer).'\\'.APP_MODULE_LAYER.'\\'.MODULE_NAME.'\\';

        foreach (explode(',',APP_MODULE_LAYER_GROUP) as $layer) {
            if (false !== strpos(CONTROLLER_NAME, ucfirst($layer))) {
                $length = strlen($layer);
                $controllerName .= strtolower(substr(CONTROLLER_NAME, -$length, $length));
            }
        }

        return str_replace('/', '\\', $controllerName.'\\'.ucfirst(CONTROLLER_NAME));
    }

    /**
     * 应用执行
     * @return bool
     */
    public static function run()
    {
        try {
            // 初始化
            self::_init();

            // PATH INFO 解析
            UrlDispatcher::dispatch(self::$_pathInfo);

            // 自定义路由模式
            if (ROUTE_MODE == 'route') {
                Router::loader(self::$_pathInfo);
            }

            // 定义模块名
            define('MODULE_NAME', self::$_pathInfo[0]);
            // 定义控制器名
            define('CONTROLLER_NAME', self::$_pathInfo[1]);
            // 定义操作名
            define('ACTION_NAME', self::$_pathInfo[2]);

            // 应用执行
            self::_exec();
        } catch (\Exception $e) {
            // 捕获异常
            error($e->getMessage(), $e->getCode());
        }

        return true;
    }

}