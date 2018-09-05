<?php

namespace app\data\model\coobar;

use database\Model;

/**
 * 操作树 Model
 */
class OperationTreeModel extends Model
{

    public function getList($sql)
    {
        return $this->query($sql);
    }

}