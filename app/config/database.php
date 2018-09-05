<?php

return [

    'database' => [
        // 默认数据库
        'default' => [
            'type'           => 'mysql',
            'hostname'       => '127.0.0.1',
            'database'       => 'awork',
            'username'       => 'root',
            'password'       => '123456',
            'hostport'       => '3306',
            'charset'        => 'utf8',
            'prefix'         => 'aw_',
            'params'         => [],
        ],

        // 默认数据库
        'coobar' => [
            'type'           => 'mysql',
            'hostname'       => '127.0.0.1',
            'database'       => 'coobar',
            'username'       => 'root',
            'password'       => '123456',
            'hostport'       => '3306',
            'charset'        => 'utf8',
            'prefix'         => 'cb_',
            'params'         => [],
        ],

    ]
];
