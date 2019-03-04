<?php

use core\Router;

/**
 * 首页路由
 */

Router::get('index/indexShow/index', 'index/IndexShow/index');
Router::get('index/indexShow/cnzz', 'index/IndexShow/cnzz');
Router::get('index/indexShow/client', 'index/IndexShow/getClientIp');
Router::get('index/indexShow/sign', 'index/IndexShow/getSign');