<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/01/16
 * @internal wujun
 */

return [

    'stat' => [
        // 数据库类型
        'type'            => 'mysql',
        // 服务器地址
        'hostname'        => '47.98.50.195',
        // 数据库名
        'database'        => 'xiaobai_stat',
        // 用户名
        'username'        => 'manager',
        // 密码
        'password'        => '123456',
        // 端口
        'hostport'        => '3306',
    ],

    'head' => '<!DOCTYPE html><html><head><meta charset="utf-8"><title>__TITLE__</title>
    <link rel="stylesheet" href="src_bootstrap.min.css">
    <script src="src_jquery.min.js"></script>
    <script src="src_bootstrap.min.js"></script>
    <script src="src_echarts.min.js"></script></head><body>',

    'menu' => '<div class="row" style="margin: 20px">
        <div class="col-md-2"><a href="index.php">账号注册和购买数据</a></div>
        <div class="col-md-2"><a href="service.php">服务功能数据</a></div>
        <div class="col-md-2"><a href="activity.php">举办活动数据</a></div>
        <div class="col-md-2"><a href="client.php">客户端数据</a></div>
        <div class="col-md-2"><a href="console.php">控制台数据</a></div>
        <div class="col-md-2"><a href="online.php">在线情况曲线图</a></div>
    </div>',

    'foot' => '<div style="height: 80px"></div></body></html>',

];