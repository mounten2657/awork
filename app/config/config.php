<?php

return [

    // 版本号
    'awork_version' => '1.0.5',
    'awork_updated_at' => '2021.01',

    // 日志相关
    'log_level' => 'info',
    'log_file_size' => 2097152,
    'log_date_format' => 'Ymd',
    'log_time_format' => 'H',
    'log_path' => [
        'default'          => LOG_PATH.'default',
        'catch'            => LOG_PATH.'catch',
        'http'             => LOG_PATH.'http',
    ],

    // 错误显示相关
    'error_show_all' => true,
    'error_show_time' => 3,

    // 加密秘钥
    'encrypt_key' => 'Awork@v1.0.1',

    // 数据库相关
    'database' => [
        // 默认数据库
        'default' => [
            // 数据库类型
            'type'           => 'mysql',
            // 服务器地址
            'hostname'       => '127.0.0.1',
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
            'prefix'         => 'aw_',
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
