<?php

use core\Router;

/**
 * 首页路由
 */

Router::get('index/show/index', 'index/IndexShow/index');
Router::get('index/show/client', 'index/IndexShow/getClientIp');
Router::get('index/show/sign', 'index/IndexShow/getSign');