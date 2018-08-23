<?php

namespace core;

class Router
{

    private static $_router = [];

    private static function _get($rule = '')
    {
        if (!empty($rule)) {
            return self::$_router[$rule];
        }
        return self::$_router;
    }

    private static function _set($rule, $route)
    {
        if (isset(self::$_router[$rule])) {
            return self::$_router[$rule];
        }
        return self::$_router[$rule] = $route;
    }

    public static function bind($rule, $route)
    {
        return self::_set($rule, $route);
    }

    public static function loader()
    {
        // 扫描文件
        $routerFile = AutoLoader::scanFile(APP_PATH.APP_ROUTE_LAYER);
        foreach ($routerFile as $file) {
            if (is_file($file)) {
                include $file;
            }
        }
        // 获取路由
        $router = self::_get();

        throw new \Exception(var_export($router, true),1000);
    }



}