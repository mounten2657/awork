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
        $list['select'] = $this
            ->field('operation_tree_id,controller_name,biz_desc')
            ->where('is_deleted', 0)
            ->where('source_type', 0)
            ->where('controller_name','like', 'rental%')
            ->order('operation_tree_id desc')
            ->limit(0, 2)
            ->select();
        $list['find'] = $this
            ->field('operation_tree_id,controller_name,biz_desc,COUNT(1) as count')
            ->where(['is_deleted' => 0, 'source_type' => 0])
            ->find();
        $list['sql'] = $this->getLastSql();
        return $list;
    }

}