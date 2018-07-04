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
    protected $view     =  null;

    /**
     * 控制器参数
     * @var array config
     * @access protected
     */
    protected $config   =   [];

    /**
     * 架构函数 取得模板对象实例
     * @access public
     */
    public function __construct() {
        //实例化视图类
        $this->view     = new View();
        //控制器初始化
        if(method_exists($this,'_initialize'))
            $this->_initialize();
    }

    /**
     * 模板显示 调用内置的模板引擎显示方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @return void
     */
    protected function display($templateFile='',$charset='',$contentType='',$content='') {
        $this->view->display($templateFile,$charset,$contentType,$content);
    }

    /**
     * 输出内容文本可以包括Html 并支持内容解析
     * @access protected
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @return mixed
     */
    protected function show($content,$charset='',$contentType='') {
        $this->view->display('',$charset,$contentType,$content);
    }

    /**
     *  获取输出页面内容
     * 调用内置的模板引擎fetch方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $content 模板输出内容
     * @return string
     */
    protected function fetch($templateFile='',$content='') {
        return $this->view->fetch($templateFile,$content);
    }

    /**
     * 模板主题设置
     * @access protected
     * @param string $theme 模版主题
     * @return $this
     */
    protected function theme($theme){
        $this->view->theme($theme);
        return $this;
    }

    /**
     * 模板变量赋值
     * @access protected
     * @param mixed $name 要显示的模板变量
     * @param mixed $value 变量的值
     * @return $this
     */
    protected function assign($name,$value='') {
        $this->view->assign($name,$value);
        return $this;
    }

    public function __set($name,$value) {
        $this->assign($name,$value);
    }

    /**
     * 取得模板显示变量的值
     * @access protected
     * @param string $name 模板显示变量
     * @return mixed
     */
    public function get($name='') {
        return $this->view->get($name);
    }

    public function __get($name) {
        return $this->get($name);
    }

    /**
     * 检测模板变量的值
     * @access public
     * @param string $name 名称
     * @return boolean
     */
    public function __isset($name) {
        return $this->get($name);
    }

    /**
     * 魔术方法 有不存在的操作的时候执行
     * @access public
     * @param string $method 方法名
     * @param array $args 参数
     * @return mixed
     */
    public function __call($method,$args) {
        return $this->$method($args);
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @param int $json_option 传递给json_encode的option参数
     * @return void
     */
    protected function ajaxReturn($data,$type='',$json_option=0) {
        if(empty($type)) $type  =   config('default_ajax_return');
        switch (strtoupper($type)){
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data,$json_option));
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(json_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                //$handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                $handler  =   isset($_GET['callback']) ? $_GET['callback'] : 'jsonpReturn';
                exit($handler.'('.json_encode($data,$json_option).');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            default     :
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data,$json_option));
        }
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
