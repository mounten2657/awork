<?php
/**
 * common functions
 * @copyright (c) 2012-2020, Hangzhou Awork Tech Co., Ltd.
 * This is NOT a freeware, use is subject to license terms.
 * @package common.php
 * @link http://www.awork.com
 * @author wujun
 * @: common.php 311001 2020-08-24 15:28:54 wujun $
 * */

/**
 * get current environment is test or not.
 * @return bool
 */
function isTestEnv()
{
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    if (false !== strpos($host, '192.168') || false !==  strpos($host, '127.0')) {
        return true;
    }
    return false;
}

/**
 * get base uri
 * @param bool $hasPort
 * @return string
 */
function getBaseUri($hasPort = false)
{
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
    if (!$hasPort) {
        $host = explode(':', $host);
        $host = $host[0];
    }
    $http = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
    return $http . '://' . $host;
}

if (!function_exists('dd')) {
    /**
     * print var
     * @param $var
     * @param $die
     */
    function dd($var, $die = 1)
    {
        echo "<br><pre>";
        print_r($var);
        echo "</pre>";
        $die && die;
    }
}



