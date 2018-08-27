<?php

namespace core;

class Router
{

    private static $_router = [];

    private static $_request_type = ['get', 'post', 'put', 'delete'];

    private static function _get($rule = '')
    {
        if (!empty($rule)) {
            return self::$_router[$rule];
        }
        // get route
        return self::$_router;
    }

    private static function _set($rule, $route, $method)
    {
        if (isset(self::$_router[$rule])) {
            return self::$_router[$rule];
        }
        // set route
        // @example ['get:idx' => 'index/indexShow/index']
        return self::$_router[$method.':'.$rule] = $route;
    }

    public static function bind($rule, $route, $method)
    {
        if (!in_array($method, self::$_request_type)) {
            return false;
        }
        // request parameters filter

        return self::_set($rule, $route, $method);
    }

    public static function get($rule, $route)
    {
        return self::bind($rule, $route, 'get');
    }

    public static function post($rule, $route)
    {
        return self::bind($rule, $route, 'post');
    }

    public static function put($rule, $route)
    {
        return self::bind($rule, $route, 'put');
    }

    public static function delete($rule, $route)
    {
        return self::bind($rule, $route, 'delete');
    }

    public static function loader(&$path)
    {
        // 扫描文件
        $routerFile = AutoLoader::scanFile(APP_PATH.APP_ROUTE_LAYER);
        foreach ($routerFile as $file) {
            if (is_file($file)) {
                include $file;
            }
        }
        // 获取路由列表
        $routeList = self::_get();

        // 获取路由是否已添加
        $sParm = config('url_dispatcher.var_prefix').config('url_dispatcher.var_pathinfo');
        $rule = strtolower($_SERVER['REQUEST_METHOD']).':'.substr($_GET[$sParm],1);
        if (strpos($rule, '?')) {
            $rule = strstr($rule, '?', true);
        }
        if (!in_array($rule, array_keys($routeList))) {
            throw new \Exception('MODULE NOT OPEN : '.$rule, 405);
        }
        // 解析路由规则
        list($module, $controller, $action) = explode('/', $routeList[$rule], 3);

        // 保存解析结果
        $path = [$module , $controller, $action];

        // unset GET & REQUEST parameters awork:s
        unset($_GET[$sParm]);
        unset($_REQUEST[$sParm]);

        return true;
    }



}