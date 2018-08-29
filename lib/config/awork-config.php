<?php

return [

    // 版本号
    'awork_version' => '1.0.0',

    // 默认时区
    'default_timezone' => 'PRC',

    // 默认ajax返回
    'default_ajax_return' => 'json',

    // 默认路由解析方式，route mode list: mvc, route
    // [!] mvc 模式不支持多于三层以上的路由
    // [!] 强烈建议采用 route 模式
    'default_route_mode' => 'route',

    // 路由解析
    'url_dispatcher' => [
        'var_prefix' => 'awork:',
        'var_pathinfo' => 's',
        'var_module' => 'm',
        'var_controller' => 'c',
        'var_action' => 'a',
        'default_module' => 'index',
        'default_controller' => 'indexShow',
        'default_action' => 'index',
        'url_case_insensitive' => false,
        'url_html_suffix' => 'html',
        'url_pathinfo_depr' => '/',
        'module_allow_list' => '',
    ],

    // 日志相关
    'log_level' => 'info',
    'log_file_size' => 2097152,
    'log_date_format' => 'Ymd',
    'log_time_format' => 'H',
    'log_path' => [
        'default'          => LOG_PATH.'default',
        'autoload'         => LOG_PATH.'autoload',
    ],

    // 默认数据库
    'database' => [
        'default' => [
            // 数据库类型
            'type'           => 'mysql',
            // 数据库连接DSN配置
            'dsn'            => '',
            // 服务器地址
            'hostname'       => 'localhost',
            // 数据库名
            'database'       => 'awork',
            // 数据库用户名
            'username'       => 'root',
            // 数据库密码
            'password'       => '123456',
            // 数据库连接端口
            'hostport'       => '3306',
            // 数据库连接参数
            'params'         => [],
            // 数据库编码默认采用utf8
            'charset'        => 'utf8',
            // 数据库表前缀
            'prefix'         => '',
            // 数据库调试模式
            'debug'          => false,
            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy'         => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate'    => false,
            // 读写分离后 主服务器数量
            'master_num'     => 1,
            // 指定从服务器序号
            'slave_no'       => '',
            // 是否严格检查字段是否存在
            'fields_strict'  => true,
            // 自动写入时间戳字段
            'auto_timestamp' => false,
        ],
    ],

];
