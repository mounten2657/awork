<?php

use core\Router;

/**
 * [!] 放在此处的路由优先级最高
 * [!] 此处用于放置通用或常用路由
 * [!] 禁止在此处复写子模块路由
 */

// 默认访问首页
Router::get('', 'index/IndexShow/index');
Router::get('index/indexShow/index', 'index/IndexShow/index');

// 错误页面
Router::get('error/default', 'error/ErrorShow/defaultShow');
Router::get('error/404', 'error/ErrorShow/_404');
Router::get('error/405', 'error/ErrorShow/_405');