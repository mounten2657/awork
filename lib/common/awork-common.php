<?php

/**
 * 发送HTTP状态
 * @param integer $code                          状态码
 * @param string $content                        提示信息
 * @return mixed
 */
function abort($code, $content = '')
{
    $_status = [
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily ',  // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    ];
    if (empty($content) && isset($_status[$code])) {
        $content = $_status[$code];
    }
    header('HTTP/1.1 '.$code.' '.$content);
    // 确保FastCGI模式下正常
    header('Status:'.$code.' '.$content);
    // 展示错误
    return error($content, $code);
}

/**
 * 错误输出
 * @param $message
 * @param int $code
 * @return mixed
 */
function error($message, $code = 400)
{
    return die(json_encode(['code' => $code, 'message' => $message]));
}

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
 * 获取和设置配置参数
 * @param string|array  $name                    参数名
 * @param mixed         $value                   参数值
 * @param string        $range                   作用域
 * @return mixed
 */
function config($name = '', $value = null, $range = '')
{
    if (is_null($value) && is_string($name)) {
        return 0 === strpos($name, '?') ? \core\Config::has(substr($name, 1), $range) : \core\Config::get($name, $range);
    } else {
        return \core\Config::set($name, $value, $range);
    }
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
