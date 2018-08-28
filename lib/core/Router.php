<?php

namespace core;

class Router
{

    /** @var array 路由集 */
    private static $_router = [];

    /** @var array 请求类型 */
    private static $_request_type = [
        'get'    => 'get',
        'post'   => 'post',
        'put'    => 'put',
        'delete' => 'delete'
    ];

    /**
     * 获取路由
     * @param string $rule
     * @return array|mixed
     */
    private static function _get($rule = '')
    {
        if (!empty($rule)) {
            return self::$_router[$rule];
        }
        // get route
        return self::$_router;
    }

    /**
     * 设置路由
     * @param $rule
     * @param $route
     * @param $method
     * @return mixed
     */
    private static function _set($rule, $route, $method)
    {
        if (isset(self::$_router[$rule])) {
            return self::$_router[$rule];
        }
        // set route
        return self::$_router[self::$_request_type[$method]][$rule] = $route;
    }

    /**
     * 绑定路由
     * @param $rule
     * @param $route
     * @param $method
     * @return bool|mixed
     */
    public static function bind($rule, $route, $method)
    {
        if (!in_array(strtolower($method), self::$_request_type)) {
            return false;
        }
        // request filter
        if (strtoupper($method) != $_SERVER['REQUEST_METHOD']) {
            return false;
        }

        return self::_set($rule, $route, $method);
    }

    /**
     * GET 路由绑定
     * @param $rule
     * @param $route
     * @return bool|mixed
     */
    public static function get($rule, $route)
    {
        return self::bind($rule, $route, self::$_request_type['get']);
    }

    /**
     * POST 路由绑定
     * @param $rule
     * @param $route
     * @return bool|mixed
     */
    public static function post($rule, $route)
    {
        return self::bind($rule, $route, self::$_request_type['post']);
    }

    /**
     * PUT 路由绑定
     * @param $rule
     * @param $route
     * @return bool|mixed
     */
    public static function put($rule, $route)
    {
        return self::bind($rule, $route, self::$_request_type['put']);
    }

    /**
     * DELETE 路由绑定
     * @param $rule
     * @param $route
     * @return bool|mixed
     */
    public static function delete($rule, $route)
    {
        return self::bind($rule, $route, self::$_request_type['delete']);
    }

    /**
     * 路由加载
     * @param $path
     * @return bool
     */
    public static function loader(&$path)
    {
        // 扫描文件
        $routerFile = AutoLoader::scanFile(APP_PATH.APP_ROUTE_LAYER);
        foreach ($routerFile as $file) {
            if (is_file($file)) {
                include_once $file;
            }
        }
        // 获取路由列表
        $routeList = self::_get();

        // 检测路由是否在列表中
        $sParm = config('url_dispatcher.var_prefix').config('url_dispatcher.var_pathinfo');
        $rule = substr($_GET[$sParm],1);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (!in_array($rule, array_keys($routeList[$method]))) {
            throw new \Exception("MODULE NOT OPEN : [{$_SERVER['REQUEST_METHOD']}] $rule", 405);
        }
        // 解析路由规则
        list($module, $controller, $action) = explode('/', $routeList[$method][$rule], 3);

        // 保存解析结果
        $path = [$module , $controller, $action];

        return true;
    }

}