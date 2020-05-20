<?php

use core\Router;

/**
 * 首页路由
 */

Router::get('index/indexShow/index', 'index/IndexShow/index');
Router::get('index/indexShow/cnzz', 'index/IndexShow/cnzz');
Router::get('index/indexShow/client', 'index/IndexShow/getClientIp');
Router::get('index/indexShow/sign', 'index/IndexShow/getSign');

Router::get('test/index', 'index/TestApi/index');

Router::post('index/api/generateBat', 'index/IndexApi/generateBat');
Router::get('index/api/downloadBat', 'index/IndexApi/downloadBat');

// Test Api
Router::get('v1/online-users', 'index/TestApi/sacPostTest');
Router::post('v1/online-users', 'index/TestApi/sacPostTest');
Router::delete('v1/online-users', 'index/TestApi/sacDelTest');
