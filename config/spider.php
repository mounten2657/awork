<?php

// 爬虫配置
return [
    // name 为爬虫关键字，不区分大小写 | time 为阻断时间，单位秒， 0 代表永久阻断
    'deny_list' => [
        ['name' => 'YisouSpider', 'time' => '10'],
        ['name' => 'The Knowledge AI', 'time' => '10'],
        ['name' => 'python', 'time' => '0'],
        ['name' => 'Java', 'time' => '0'],
    ],
];
