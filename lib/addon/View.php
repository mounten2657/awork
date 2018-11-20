<?php

namespace addon;

/**
 * 视图类
 */
class View
{

    /**
     * 模板输出变量
     * @var mixed tVar
     * @access protected
     */
    protected $tVar = [];

    /**
     * 输出内容文本可以包括Html
     * @access private
     * @param string $content 输出内容
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     */
    private function render($content, $charset = '', $contentType = '')
    {
        $charset = $charset ? : config('tmpl_default_charset');
        $contentType = $contentType ? : config('tmpl_content_type');
        // 网页字符编码
        header('Content-Type:' . $contentType . '; charset=' . $charset);
        // 页面缓存控制
        header('Cache-control: ' . config('tmpl_cache_control'));
        header('X-Powered-By: Awork');
        // 输出模板文件
        echo $content;
    }

    /**
     * 加载模板和页面输出 可以返回输出内容
     * @access public
     * @param array  $assign 模板变量
     * @param string $templateFile 模板文件名
     * @param string $charset 模板输出字符集
     * @param string $contentType 输出类型
     * @param string $content 模板输出内容
     */
    public function display($assign, $templateFile, $charset, $contentType, $content)
    {
        $this->assign($assign);
        // 解析并获取模板内容
        $content = $this->fetch($templateFile, $content);
        // 输出模板内容
        $this->render($content, $charset, $contentType);
    }

    /**
     * 模板变量赋值
     * @access public
     * @param mixed $name
     * @param mixed $value
     */
    public function assign($name, $value = '')
    {
        if (is_array($name)) {
            $this->tVar = array_merge($this->tVar, $name);
        } elseif (!empty($name)) {
            $this->tVar[$name] = $value;
        }
    }

    /**
     * 解析和获取模板内容 用于输出
     * @access public
     * @param string $templateFile 模板文件名
     * @param string $content 模板输出内容
     * @return string
     */
    public function fetch($templateFile, $content)
    {
        $templateFile = $templateFile ? : ACTION_NAME;
        $templateFile = APP_PATH . 'html/' . MODULE_NAME . '/view/' . $templateFile . config('tmpl_file_suffix');
        // 模板文件不存在直接返回
        if (!is_file($templateFile)) {
            throw new \Exception('Template not exist: ' . $templateFile);
        }
        // 页面缓存
        ob_start();
        ob_implicit_flush(0);
        // 直接载入PHP模板
        empty($content) ? include $templateFile : eval(' ?>' . $content);
        // 获取并清空缓存
        $html = ob_get_clean();
        // 模板变量替换
        $find = $replace = [];
        foreach ($this->tVar as $key => $val) {
            $find[] = str_replace('__VALUE__', $key, config('tmpl_assign_rule'));
            $replace[] = (is_array($val) || is_object($val)) ? '<pre>'.var_export($val, true).'</pre>' : $val;
        }
        $html = str_replace($find, $replace, $html);
        // 输出模板文件
        return $html;
    }

}