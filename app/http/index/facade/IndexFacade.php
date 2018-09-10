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
        $list = OperationTreeCache::getList();
        return $list;
    }

}