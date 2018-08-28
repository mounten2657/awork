<?php

use core\Router;

/**
 * 首页路由
 */

Router::get('index/show/index', 'index/indexShow/index');
Router::get('index/show/client', 'index/indexShow/getClientIp');
Router::get('index/show/sign', 'index/indexShow/getSign');
Router::get('index/show/version', 'v10000/index/indexShow/getVersion');