<?php

namespace core;

class UrlDispatcher
{

    /**
     * 路由参数
     * @var
     */
    private static $varPath;
    private static $varModule;
    private static $varController;
    private static $varAction;
    private static $urlCase;
    private static $depr;

    /**
     * 路由初始化
     * @return bool
     */
    private static function _init()
    {
        // 获取基本配置
        self::$varPath = config('url_dispatcher.var_pathinfo');
        self::$varModule = config('url_dispatcher.var_module');
        self::$varController = config('url_dispatcher.var_controller');
        self::$varAction = config('url_dispatcher.var_action');
        self::$urlCase = config('url_dispatcher.url_case_insensitive');
        self::$depr = config('url_dispatcher.url_pathinfo_depr');

        // 模式参数判断
        if (isset($_GET[self::$varPath])) { // 判断URL里面是否有兼容模式参数
            $_SERVER['PATH_INFO'] = $_GET[self::$varPath] ? : $_SERVER['REQUEST_URI'];
            unset($_GET[self::$varPath]);
        } elseif (IS_CLI) { // CLI模式下 index.php module/controller/action/params/...
            $_SERVER['PATH_INFO'] = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '';
        } else {
            $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI'];
        }

        // 参数处理
        self::_analyzeParams();

        return true;
    }

    /**
     * 参数分析和处理
     * @return bool
     */
    private static function _analyzeParams()
    {
        // 获取模块名
        if (empty($_SERVER['PATH_INFO'])) {
            abort(404);
        } else {
            $info = trim($_SERVER['PATH_INFO'], '/');
            // URL后缀
            $ext = strtolower(pathinfo($_SERVER['PATH_INFO'], PATHINFO_EXTENSION));
            $_SERVER['PATH_INFO'] = $info;
            $paths = explode(self::$depr, $info, 2);
            $allowList = config('url_dispatcher.module_allow_list'); // 允许的模块列表
            $module = preg_replace('/\.' . $ext . '$/i', '', $paths[0]);
            if (empty($allowList) || (is_array($allowList) && in_array(strtolower($module), $allowList))) {
                $_GET[self::$varModule] = $module;
                $_SERVER['PATH_INFO'] = isset($paths[1]) ? $paths[1] : '';
            }
        }

        // 去除URL后缀
        $htmlSuffix = config('url_dispatcher.url_html_suffix');
        $_SERVER['PATH_INFO'] = preg_replace('/\.('.trim($htmlSuffix, '.').')$/i', '', $_SERVER['PATH_INFO']);

        // 获取控制器名和模块名
        $paths = explode(self::$depr, trim($_SERVER['PATH_INFO'], self::$depr));
        $_GET[self::$varController] = array_shift($paths);
        $_GET[self::$varAction] = array_shift($paths);
        $_GET[self::$varAction] = strstr($_GET[self::$varAction], '?', true);

        // 解析剩余的URL参数
        $var = [];
        preg_replace_callback('/(\w+)\/([^\/]+)/', function ($match) use (&$var) {
            if (false !== strpos($match[2],'?')) {
                $match[2] = strstr($match[2],'?',true);
            }
            $var[$match[1]] = strip_tags($match[2]);
        }, implode('/', $paths));

        //保证$_REQUEST正常取值
        $_GET = array_merge($var, $_GET);
        $_REQUEST = array_merge($_POST, $_GET);

        return true;
    }

    /**
     * 获取名称基本方法
     * @param $var
     * @return string
     */
    private static function _getPartName($var)
    {
        switch ($var) {
            case self::$varModule:
                $partName = !empty($_GET[$var]) ? $_GET[$var] : config('url_dispatcher.default_module');
                if (!is_dir(APP_PATH.APP_MODULE_LAYER.DIRECTORY_SEPARATOR.$partName)) {
                    throw new \Exception('MODULE NOT EXIST', 404);
                }
                break;
            case self::$varController:
                $partName = !empty($_GET[$var]) ? $_GET[$var] : config('url_dispatcher.default_controller');
                break;
            case self::$varAction:
                $partName = !empty($_GET[$var]) ? $_GET[$var] : config('url_dispatcher.default_action');
                break;
        }unset($_GET[$var]);
        // 返回名称
        return strip_tags(self::$urlCase ? strtolower($partName) : $partName);
    }

    /**
     * 路由解析
     * @return bool
     */
    public static function dispatch()
    {
        // 路由初始化
        self::_init();

        // 定义模块名
        define('MODULE_NAME', self::_getPartName(self::$varModule));

        // 定义控制器名
        define('CONTROLLER_NAME', self::_getPartName(self::$varController));

        // 定义操作名
        define('ACTION_NAME', self::_getPartName(self::$varAction));

        return true;
    }

}