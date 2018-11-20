<?php

namespace app\http;

use addon\View;

abstract class BaseShow
{

    /**
     * 视图实例对象
     * @var mixed view
     * @access protected
     */
    protected $view = null;

    /**
     * 控制器参数
     * @var array config
     * @access protected
     */
    protected $config = [];

    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct()
    {
        //实例化视图类
        $this->view = new View();
        //控制器初始化
        if (method_exists($this, '_initialize')) {
            $this->_initialize();
        }
    }

    /**
     * 模板显示 调用内置的模板引擎显示方法，
     * @access protected
     * @param array  $assign
     * @param string $templateFile 指定要调用的模板文件（默认为空 由系统自动定位模板文件）
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @return void
     */
    protected function display($assign = [], $templateFile = '', $charset = '', $contentType = '', $content = '')
    {
        $this->view->display($assign, $templateFile, $charset, $contentType, $content);
    }

    /**
     * 输出内容文本可以包括Html 并支持内容解析
     * @access protected
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return void
     */
    protected function show($content, $charset = '', $contentType = '')
    {
        $this->view->display([], '', $charset, $contentType, $content);
    }

    /**
     *  获取输出页面内容
     * 调用内置的模板引擎fetch方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件（默认为空 由系统自动定位模板文件）
     * @param string $content 模板输出内容
     * @return string
     */
    protected function fetch($templateFile = '', $content = '')
    {
        return $this->view->fetch($templateFile, $content);
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return $this
     */
    protected function assign($name, $value = '')
    {
        $this->view->assign($name, $value);
        return $this;
    }

    /**
     * 取得模板显示变量的值
     * @access protected
     * @param string $name 模板显示变量
     * @return mixed
     */
    public function get($name = '')
    {
        return $this->view->get($name);
    }

    /**
     * 检测模板变量的值
     * @access public
     * @param string $name 名称
     * @return boolean
     */
    public function __isset($name)
    {
        return $this->get($name);
    }

    /**
     * 魔术方法 有不存在的操作的时候执行
     * @access public
     * @param string $method 方法名
     * @param array $args 参数
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->$method($args);
    }

    /**
     * 魔术方法 设置变量值
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->assign($name, $value);
    }

    /**
     * 魔术方法 获取变量值
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * 析构方法
     * @access public
     */
    public function __destruct()
    {
        return null;
    }

}
