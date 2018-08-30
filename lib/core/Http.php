<?php

namespace core;

class Http
{

    /**
     * 请求类型
     */
    const REQUEST_TYPE_GET    = 'GET';
    const REQUEST_TYPE_POST   = 'POST';
    const REQUEST_TYPE_PUT    = 'PUT';
    const REQUEST_TYPE_DELETE = 'DELETE';

    /**
     * 常用状态码
     * @var array
     */
    private static $_status = [
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

    /**
     * 错误页面
     * @var array
     */
    private static $_errorPage = [
        400 => 'error/default',
        404 => 'error/404',
        405 => 'error/405',
    ];

    /**
     * 发送HTTP状态
     * @param integer $code                      状态码
     * @param string $content                    提示信息
     * @return mixed
     */
    public static function abort($code, $content = '')
    {
        if (empty($content) && isset(self::$_status[$code])) {
            $content = self::$_status[$code];
        }
        header('HTTP/1.1 '.$code.' '.$content);
        // 确保FastCGI模式下正常
        header('Status:'.$code.' '.$content);
        // 展示错误
        return self::error($content, $code);
    }

    /**
     * 错误跳转输出
     * @param string $message                    错误信息
     * @param int $code                          错误码
     * @return mixed
     */
    public static function error($message, $code = 400)
    {
        $param = ['message' => $message, 'from' => defined('ROUTE_PATH') ? ROUTE_PATH : 'Unknown', 'time' => time()];
        $url = isset(self::$_errorPage[$code]) ? self::$_errorPage[$code] : self::$_errorPage[400];
        return self::redirect($url, $param);
    }

    /**
     * 页面跳转
     * @param string $url                        跳转链接
     * @param array $param                       链接参数
     * @param int $wait                          等待时间
     * @return bool
     */
    public static function redirect($url, $param = [], $wait = 0)
    {
        if ($wait) {
            sleep($wait);
        }
        $param = http_build_query($param);
        echo "<script type='text/javascript'>window.location.href='/$url?$param'</script>";
        return true;
    }

    /**
     * 获取http请求参数
     * @param string $name                       参数名
     * @param string $default                    默认值
     * @param string $filter                     过滤器
     * @return null|string                       参数值
     */
    public static function input($name, $default = '', $filter = '')
    {
        if (strpos($name, '.')) {
            $name = explode('.', $name, 2);
        } else {
            $name = [$name, ''];
        }

        if (self::REQUEST_TYPE_GET == strtoupper($name[0])) {
            $input = $_GET;
        } elseif (in_array(strtoupper($name[0]), [self::REQUEST_TYPE_POST, self::REQUEST_TYPE_DELETE])) {
            $input = $_POST;
        } elseif (self::REQUEST_TYPE_PUT == strtoupper($name[0])) {
            $uri = @file_get_contents('php://input');
            parse_str($uri, $input);
            $input = $input ? : null;
        } else {
            $input = null;
        }

        if (!empty($name[1]) && $name[1] != '*') {
            $input = isset($input[$name[1]]) ? $input[$name[1]] : null;
        }

        if (!is_array($input)) {
            if (null !== $input) {
                if (!empty($filter)) {
                    $input = $filter($input);
                }
            } else {
                $input = $default;
            }
        }

        return $input;
    }

    /**
     * 通过 POST 方式请求
     * @param string $url
     * @param array $postData
     * @param array $header
     * @param bool $headerBool
     * @return bool|mixed
     */
    public static function post($url, $postData = [], $header = [], $headerBool=true)
    {
        $curl = curl_init();

        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_HEADER, $headerBool);
        } else {
            curl_setopt($curl, CURLOPT_HEADER, false);
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 显示输出结果
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            Log::record('[CURL_POST] '.curl_error($curl), 'http', Log::ERR);
            return false;
        }

        curl_close($curl);
        return $result;
    }

    /**
     * 通过 GET 方式请求
     * @param string $url
     * @param array $getData
     * @param array $header
     * @param bool $encode
     * @return bool|mixed
     */
    public static function get($url, $getData = [], $header = [], $encode = true)
    {
        $curl = curl_init();

        if ( count($getData) > 0) {
            $queryData = $encode ? http_build_query($getData) : urldecode(http_build_query($getData));
            curl_setopt($curl, CURLOPT_URL, $url.'?'.$queryData);
        } else {
            curl_setopt($curl, CURLOPT_URL, $url);
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // 显示输出结果
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            Log::record('[CURL_GET] '.curl_error($curl), 'http', Log::ERR);
            return false;
        }

        curl_close($curl);
        return $result;
    }

    /**
     * 通过 PUT 方式请求
     * @param string $url
     * @param array $putData
     * @return bool|mixed
     */
    public static function put($url, $putData = [])
    {
        $curl = curl_init();
        $header = ["X-HTTP-Method-Override: put"];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $putData);
        $result = curl_exec($curl);

        if (curl_errno($curl)) {
            Log::record('[CURL_PUT] '.curl_error($curl), 'http', Log::ERR);
            return false;
        }

        curl_close($curl);
        return $result;
    }

    /**
     * 通过 DELETE 方式请求
     * @param string $url
     * @param array $header
     * @return bool|mixed
     */
    public static function delete($url, $header = [])
    {
        $curl = curl_init ();
        curl_setopt ( $curl, CURLOPT_URL, $url);
        curl_setopt ( $curl, CURLOPT_FILETIME, true );
        curl_setopt ( $curl, CURLOPT_FRESH_CONNECT, false );

        curl_setopt ( $curl, CURLOPT_HEADER, true );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $curl, CURLOPT_TIMEOUT, 5184000 );
        curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 120 );
        curl_setopt ( $curl, CURLOPT_NOSIGNAL, true );
        curl_setopt ( $curl, CURLOPT_CUSTOMREQUEST, 'DELETE' );
        $res = curl_exec ( $curl );

        if (curl_errno($curl)) {
            Log::record('[CURL_DELETE] '.curl_error($curl), 'http', Log::ERR);
            return false;
        }

        curl_close($curl);
        return $res;
    }

    /**
     * 将 xml 转为 array
     * @param $xml
     * @return mixed
     */
    static public function xmlToArray($xml)
    {
        // 将XML转为array
        $arrayData = json_decode(json_encode (simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $arrayData;
    }

    /**
     * array 转 xml
     * @param $array
     * @return string
     */
    static public function arrayToXml($array)
    {
        $xml = "<xml>";
        foreach ( $array as $key => $val ) {
            if (is_numeric ( $val )) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";
        return $xml;
    }

}