<?php

namespace addon;

class View
{


    const THEME_PATH           = APP_PATH.'html/'.MODULE_NAME.'/view/';
    const DEFAULT_CHARSET      = 'utf-8';
    const TMPL_CONTENT_TYPE    = 'text/html';
    const HTTP_CACHE_CONTROL   = 'private';
    const TMPL_TEMPLATE_SUFFIX = '.html';

    /**
     * 模板输出变量
     * @var mixed tVar
     * @access protected
     */
    protected $tVar     =   array();

    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name,$value='')
    {
        if(is_array($name)) {
            $this->tVar   =  array_merge($this->tVar,$name);
        }else {
            $this->tVar[$name] = $value;
        }
    }

    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param string $templateFile 模板文件名
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @param string $content 模板输出内容
     */
    public function display($templateFile='',$charset='',$contentType='',$content='')
    {
        // 解析并获取模板内容
        $content = $this->fetch($templateFile,$content);
        // 输出模板内容
        $this->render($content,$charset,$contentType);
    }

    /**
     * 输出内容文本可以包括Html
     * @access private
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     */
    private function render($content,$charset='',$contentType='')
    {
        if(empty($charset))  $charset = self::DEFAULT_CHARSET;
        if(empty($contentType)) $contentType = self::TMPL_CONTENT_TYPE;
        // 网页字符编码
        header('Content-Type:'.$contentType.'; charset='.$charset);
        header('Cache-control: '.self::HTTP_CACHE_CONTROL);  // 页面缓存控制
        header('X-Powered-By:Awork');
        // 输出模板文件
        echo $content;
    }

    /**
     * 解析和获取模板内容 用于输出
     * @access public
     * @param string $templateFile 模板文件名
     * @param string $content 模板输出内容
     * @return string
     */
    public function fetch($templateFile='',$content='')
    {
        $templateFile = $templateFile ? : ACTION_NAME;
        $templateFile   =   self::THEME_PATH.$templateFile.self::TMPL_TEMPLATE_SUFFIX;
        // 模板文件不存在直接返回
        if(!is_file($templateFile)) {
            throw new \Exception('Template not exist: '.$templateFile);
        }
        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        $_content   =   $content;
        // 模板阵列变量分解成为独立变量
        extract($this->tVar);
        // 直接载入PHP模板
        empty($_content) ? include $templateFile : eval(' ?>'.$_content);
        // 获取并清空缓存
        $content = ob_get_clean();
        // 输出模板文件
        return $content;
    }

}