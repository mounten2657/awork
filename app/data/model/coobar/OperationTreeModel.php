<?php

namespace app\data\model\coobar;

use database\Model;

/**
 * 操作树 Model
 */
class OperationTreeModel extends Model
{

    protected $dbName = 'coobar';

    public function _initialize()
    {
        //$this->dbName = '';
    }

    public function getList($sql)
    {
        //return $this->tableName;
        return $this->query($sql);
    }

}