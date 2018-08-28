<?php

use core\Router;

/**
 * [!] 放在此处的路由优先级最高
 * [!] 此处用于放置通用或常用路由
 * [!] 禁止在此处复写子模块路由
 */

// 默认访问首页
Router::get('', 'index/indexShow/index');
Router::get('index/indexShow/index', 'index/indexShow/index');