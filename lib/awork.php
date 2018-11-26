<?php

// 框架入口文件
header("Content-type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.4.0','<'))  die('require PHP > 5.4.0 !');

// 定义目录
define('ROOT_PATH', './../');
define('LIB_PATH', ROOT_PATH.'lib/');
define('LOG_PATH', ROOT_PATH.'log/');
define('HTML_PATH', APP_PATH.'html/');

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

// 载入加载类
require LIB_PATH.'core/AutoLoader.php';
core\AutoLoader::register();

// 应用运行
core\App::run();
