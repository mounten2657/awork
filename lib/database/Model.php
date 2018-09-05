<?php

namespace database;

/**
 * 模型类
 */
class Model
{

    protected $db = null;

    protected $dbName = 'default';

    protected $tableName = '';

    protected $prefix = '';

    public function __construct()
    {
        $this->_initialize();
        $this->tableName = get_class($this);
        $this->db = Db::getInstance($this->dbName);
    }

    public function _initialize()
    {
        // to initialize model variable
    }

    /**
     * 查询操作
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * 执行操作
     * @param $sql
     * @param $param
     * @return mixed
     */
    public function execute($sql, $param = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->excute($param);
        return $stmt->rowCount();
    }

}