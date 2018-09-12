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
        $list['model'] = OperationTreeCache::getModel();
        $list['list'] = OperationTreeCache::getList();
        return $list;
    }

}