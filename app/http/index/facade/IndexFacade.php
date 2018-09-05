<?php

namespace app\http\index\facade;

use app\data\cache\coobar\OperationTreeCache;

/**
 * 首页 Facade
 */
class IndexFacade
{

    public static function getName()
    {
        return 'index facade';
    }

    public static function getOperationTreeList()
    {
        $sql = 'select * from cb_operation_tree limit 2;';
        $list = OperationTreeCache::getList($sql);
        return $list;
    }

}