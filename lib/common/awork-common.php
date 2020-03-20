<?php

/**
 * 过滤参数
 * @param string $value
 */
function awork_filter(&$value)
{
    // 过滤查询特殊字符
    if(preg_match('/^(EXP|NEQ|GT|EGT|LT|ELT|OR|XOR|LIKE|NOTLIKE|NOT BETWEEN|NOTBETWEEN|BETWEEN|NOTIN|NOT IN|IN)$/i', $value)){
        $value .= ' ';
    }
}

/**
 * 发送 HTTP 状态
 * @param integer $code                          状态码
 * @param string $content                        提示信息
 * @return mixed
 */
function abort($code, $content = '')
{
    return \core\Http::abort($code, $content);
}

/**
 * 错误跳转输出
 * @param string $message                        错误信息
 * @param int $code                              错误码
 * @return mixed
 */
function error($message, $code = 400)
{
    return \core\Http::error($message, $code);
}

/**
 * 获取 HTTP 请求参数
 * @param string $name                           参数名
 * @param string $default                        默认值
 * @param string $filter                         过滤器
 * @return null|string                           参数值
 */
function input($name, $default = '', $filter = '')
{
    return \core\Http::input($name, $default, $filter);
}

/**
 * HTTP 链接跳转
 * @param string $url                            跳转链接
 * @param array $param                           跳转参数
 * @param int $wait                              等待时间
 * @return bool
 */
function redirect($url, $param = [], $wait = 0)
{
    return \core\Http::redirect($url, $param, $wait);
}

/**
 * 获取和设置配置参数
 * @param string|array  $name                    参数名
 * @param mixed         $value                   参数值
 * @param string        $range                   作用域
 * @return mixed
 */
function config($name = '', $value = null, $range = '')
{
    if (is_null($value) && is_string($name)) {
        $config = (0 === strpos($name, '?') ? \core\Config::has(substr($name, 1), $range) : \core\Config::get($name, $range));
    } else {
        $config = \core\Config::set($name, $value, $range);
    }
    return empty($config) ? '' : $config;
}

/**
 * 加密函数
 * @param string $string                         待加密字符串
 * @param string $key                            秘钥字符串
 * @return bool|mixed|string
 */
function encrypt($string, $key = '')
{
    return \addon\Encrypt::encrypt($string, $key);
}

/**
 * 解密函数
 * @param string $string                         待解密字符串
 * @param string $key                            秘钥字符串
 * @return bool|mixed|string
 */
function decrypt($string, $key = '')
{
    return \addon\Encrypt::decrypt($string, $key);
}

/**
 * 获取后缀名
 * @param $path
 * @return mixed
 */
function getExt($path)
{
    $pathAry = explode('.', $path);
    return strtolower(array_pop($pathAry));
}

/**
 * 下划线转驼峰
 * @param $str
 * @return null|string|string[]
 */
function lineToHump($str)
{
    $str = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
        return strtoupper($matches[2]);
    }, $str);
    return $str;
}

/**
 * 驼峰转下划线
 * @param $str
 * @return null|string|string[]
 */
function humpToLine($str){
    $str = preg_replace_callback('/([A-Z]{1})/',function($matches){
        return '_'.strtolower($matches[0]);
    }, $str);
    if (0 === strpos($str, '_')) {
        $str = substr($str, 1);
    }
    return $str;
}

/**
 * 获取客户端IP地址
 * @param integer $type                          返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @param boolean $adv                           是否进行高级模式获取（有可能被伪装）
 * @return mixed
 */
function ip($type = 0, $adv = true)
{
    $type      = $type ? 1 : 0;
    static $ip = null;
    if (null !== $ip) {
        return $ip[$type];
    }
    if ($adv) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            $ip = trim(current($arr));
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 打印信息
 * @param $var
 */
function dump($var)
{
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    if (IS_CLI) {
        $output = PHP_EOL . $output . PHP_EOL;
    } else {
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, ENT_SUBSTITUTE);
        }
        $output = '<pre>' . $output . '</pre>';
    }
    echo $output;
}

/**
 * get sapp instance
 * [!] please use loadSimpleClass() first
 * @param string $name
 * @return mixed|\simple\Sapp
 */
function sapp($name = '')
{
    $app = new \simple\Sapp();
    if ($name) {
        return $app->$name();
    }
    return $app;
}

