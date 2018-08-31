<?php

namespace app\http\error\show;

use core\Log;

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
            self::$_from = isset($param['from']) ? $param['from'] : '';
            self::$_time = isset($param['time']) ? $param['time'] : 0;
        }
    }

    /**
     * 错误信息预处理
     */
    private function _beforeShow()
    {
        // record error message
        $record = true;
        foreach (self::$_logFilter as $word) {
            if (strpos(self::$_message, $word)) {
                $record = false;
            }
        }
        if (true === $record && (time() - self::$_time <= config('error_show_time'))) {
            Log::record(self::$_message, 'http', Log::ERR);
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
        self::_beforeShow();
        return die(json_encode(['code' => $code, 'message' => self::$_message, 'from' => self::$_from]));
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