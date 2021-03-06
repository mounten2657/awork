<?php

namespace app\http\error\show;

use core\Log;

/**
 * 错误展示类
 */
class ErrorShow
{

    /** @var int error code */
    private static $_code = 400;

    /** @var string error message */
    private static $_message = 'Bad Request';

    /** @var string from route */
    private static $_from = '/';

    /** @var int error time */
    private static $_time = 0;

    /** @var array unrecord log filter */
    private static $_logFilter = ['APP_ERROR', 'APP_EXCEPTION', 'APP_SHUTDOWN'];

    /**
     * ErrorShow constructor.
     */
    public function __construct()
    {
        $param = input('get.auth', '', 'decrypt');
        if ($param = json_decode($param, true)) {
            self::$_message = isset($param['message']) ? $param['message'] : '';
            self::$_code = isset($param['code']) ? $param['code'] : self::$_code;
            self::$_from = isset($param['from']) ? $param['from'] : '';
            self::$_time = isset($param['time']) ? $param['time'] : 0;
        }
    }

    /**
     * 错误信息预处理
     * @param $code
     */
    private function _beforeShow($code)
    {
        self::$_code = $code;
        // record error message
        $record = true;
        foreach (self::$_logFilter as $word) {
            if (strpos(self::$_message, $word)) {
                $record = false;
            }
        }
        if (true === $record && (time() - self::$_time <= config('error_show_time'))) {
            $errorType = 'HTTP_ERROR';
            if (strpos(self::$_message, 'SQLSTATE') !== false) {
                $errorType = 'SQL_ERROR';
            }
            Log::record("[{$errorType}] ".self::$_message, 'catch', Log::ERR);
        }
        // filter file info
        if (!config('error_show_all') && strpos(self::$_message, '[File]')) {
            self::$_message = strstr(self::$_message, '[File]', true);
        }
    }

    /**
     * 错误信息输出
     * @param $code
     * @return mixed
     */
    private function _show($code)
    {
        self::_beforeShow($code);
        $url = self::$_from;
        $content = json_encode(['code' => $code, 'message' => self::$_message." ".date('Y-m-d H:i:s', self::$_time), 'url' => $url]);
        $html  = "<br/><button id='error_show_back'><-- Back</button><br/>";
        $html .= "<div style='padding-left: 100px'>{$content}</div>";
        $html .= "<script type='text/javascript'>window.onload = function () {document.getElementById('error_show_back').onclick = function() {window.location.href= '{$url}';}}</script>";
        return exit($html);
    }

    /**
     * 默认错误页面
     */
    public function defaultShow()
    {
        return $this->_show(self::$_code);
    }

    /**
     * 404 页面
     */
    public function _404()
    {
        return $this->_show(404);
    }

    /**
     * 405 页面
     */
    public function _405()
    {
        return $this->_show(405);
    }

}