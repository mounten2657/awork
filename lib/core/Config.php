<?php

namespace core;

/**
 * 配置类
 */
class Config
{

    // 配置参数
    private static $config = [];
    // 参数作用域
    private static $range = '_SYSTEM_';

    /**
     * 加载配置文件（多种格式）
     * @param string    $file 配置文件名
     * @param string    $name 配置名（如设置即表示二级配置）
     * @param string    $range  作用域
     * @return mixed
     */
    public static function load($file, $name = '', $range = '')
    {
        $range = $range ?: self::$range;
        if (!isset(self::$config[$range])) {
            self::$config[$range] = [];
        }
        if (is_file($file)) {
            $type = pathinfo($file, PATHINFO_EXTENSION);
            if ('php' == $type) {
                return self::set(include $file, $name, $range);
            } elseif ('yaml' == $type && function_exists('yaml_parse_file')) {
                return self::set(yaml_parse_file($file), $name, $range);
            } elseif ('ini' == $type) {
                return self::set(parse_ini_file($file, true), $name, $range);
            } elseif ('json' == $type) {
                return self::set(json_decode(file_get_contents($file), true), $name, $range);
            }
        }
        return self::$config[$range];
    }

    /**
     * 检测配置是否存在
     * @param string    $name 配置参数名（支持二级配置 .号分割）
     * @param string    $range  作用域
     * @return bool
     */
    public static function has($name, $range = '')
    {
        $range = $range ?: self::$range;

        if (!strpos($name, '.')) {
            return isset(self::$config[$range][strtolower($name)]);
        } else {
            // 二维数组设置和获取支持
            $name = explode('.', $name);
            return isset(self::$config[$range][strtolower($name[0])][$name[1]]);
        }
    }

    /**
     * 获取配置参数 为空则获取所有配置
     * @param string    $name 配置参数名（支持二级配置 .号分割）
     * @param string    $range  作用域
     * @return mixed
     */
    public static function get($name = null, $range = '')
    {
        $range = $range ?: self::$range;
        // 无参数时获取所有
        if (empty($name) && isset(self::$config[$range])) {
            return self::$config[$range];
        }

        if (!strpos($name, '.')) {
            $name = strtolower($name);
            return isset(self::$config[$range][$name]) ? self::$config[$range][$name] : null;
        } else {
            // 二维数组设置和获取支持
            $name    = explode('.', $name);
            $name[0] = strtolower($name[0]);
            return isset(self::$config[$range][$name[0]][$name[1]]) ? self::$config[$range][$name[0]][$name[1]] : null;
        }
    }

    /**
     * 设置配置参数 name为数组则为批量设置
     * @param string|array  $name 配置参数名（支持二级配置 .号分割）
     * @param mixed         $value 配置值
     * @param string        $range  作用域
     * @return mixed
     */
    public static function set($name, $value = null, $range = '')
    {
        $range = $range ?: self::$range;
        if (!isset(self::$config[$range])) {
            self::$config[$range] = [];
        }
        if (is_string($name)) {
            if (!strpos($name, '.')) {
                self::$config[$range][strtolower($name)] = $value;
            } else {
                // 二维数组设置和获取支持
                $name = explode('.', $name);
                self::$config[$range][strtolower($name[0])][$name[1]] = $value;
            }
            return [];
        } elseif (is_array($name)) {
            // 批量设置
            if (!empty($value)) {
                self::$config[$range][$value] = isset(self::$config[$range][$value]) ?
                    array_merge(self::$config[$range][$value], $name) :
                    self::$config[$range][$value] = $name;
                return self::$config[$range][$value];
            } else {
                return self::$config[$range] = array_merge(self::$config[$range], array_change_key_case($name));
            }
        } else {
            // 为空直接返回 已有配置
            return self::$config[$range];
        }
    }

}