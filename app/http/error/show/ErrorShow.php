<?php

namespace app\http\error\show;

class ErrorShow
{

    /**
     * ErrorShow constructor.
     */
    public function __construct()
    {
        $code = input('get.code', 400, 'intval');
        $message = input('get.message', 'Bad Request', 'strval');
        return $this->_view($code, $message);
    }

    /**
     * 错误信息输出
     * @param $code
     * @param $message
     * @return mixed
     */
    private function _view($code, $message)
    {
        return die(json_encode(['code' => $code, 'message' => $message]));
    }

    /**
     * 默认错误页面
     */
    public function defaultPage() {}

    /**
     * 404 页面
     */
    public function notFoundPage() {}

    /**
     * 405 页面
     */
    public function notAllowedPage() {}

}