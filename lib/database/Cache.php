<?php

namespace database;

/**
 * 缓存类
 */
class Cache
{

    /** @var null 缓存实例 */
    protected static $_instance = null;

    /** @var null 模型实例 */
    protected static $_model = null;

    /**
     * 获取模型实例
     * @return null
     */
    public static function getModel()
    {
        $cache = get_called_class();
        if (is_callable([$cache, '_getModel'], true,$callName)) {
            return $callName();
        }
        return self::$_model;
    }

}