<?php

return [
    // 日志相关
    'log_level' => 'info',
    'log_file_size' => 2097152,
    'log_date_format' => 'Ymd',
    'log_time_format' => 'H',
    'log_path' => [
        'default'          => LOG_PATH.'default',
        'catch'            => LOG_PATH.'catch',
        'http'             => LOG_PATH.'http',
        'index/client'     => LOG_PATH.'index/client',
        'index/test'       => LOG_PATH.'index/test',
        'index/sign'       => LOG_PATH.'index/sign',

    ]
];
