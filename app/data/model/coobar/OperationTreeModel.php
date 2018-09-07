<?php

namespace app\data\model\coobar;

use database\Model;

/**
 * 操作树 Model
 */
class OperationTreeModel extends Model
{

    public function getList()
    {
        $list = $this
            ->where('is_deleted', '=', 0)
            ->where('source_type', '0')
            //->where('controller_name', 'rental')
            ->order('operation_tree_id desc')
            ->limit(2)
            ->select();
        $list['sql'] = $this->lastSql();
        return $list;
    }

}