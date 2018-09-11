<?php

namespace app\data\cache\coobar;

use app\data\model\coobar\OperationTreeModel;
use database\Cache;

/**
 * 操作树 Cache
 */
class OperationTreeCache extends Cache
{

    public static function getModel()
    {
        if (null === self::$_model) {
            self::$_model = new OperationTreeModel();
        }
        return self::$_model;
    }

    public static function getList()
    {
        return self::getModel()->getList();
    }

}