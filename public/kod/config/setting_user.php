<?php 
$config['database'] = array (
  'DB_TYPE' => 'mysqli',
  'DB_HOST' => '192.168.50.128',
  'DB_PORT' => 3306,
  'DB_USER' => 'root',
  'DB_PWD' => '123456',
  'DB_NAME' => 'kodbox',
  'DB_SQL_LOG' => true,
  'DB_FIELDS_CACHE' => true,
  'DB_SQL_BUILD_CACHE' => false,
);
$config['cache']['sessionType'] = 'redis';
$config['cache']['cacheType'] = 'redis';
$config['cache']['redis']['host'] = '192.168.50.128';
$config['cache']['redis']['port'] = '6379';