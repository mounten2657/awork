<?php

namespace app\data\cache\coobar;

use app\data\model\coobar\OperationTreeModel;
use database\Cache;

/**
 * 操作树 Cache
 */
class OperationTreeCache extends Cache
{

    private static function _getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new OperationTreeModel();
        }
        return self::$_instance;
    }

    public static function getList($sql)
    {
        return self::_getInstance()->getList($sql);
    }

}