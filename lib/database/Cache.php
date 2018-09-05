<?php

namespace database;

/**
 * 缓存类
 */
class Cache
{

    /** @var null 缓存实例 */
    protected static $_instance = null;

    /**
     * 获取 Model 类
     * @return null
     */
    public static function getModel()
    {
        return self::$_instance;
    }

}