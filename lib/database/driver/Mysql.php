<?php

namespace database\driver;

use database\Db;

/**
 * Mysql 驱动类
 */
class Mysql
{

    /** @var null 驱动实例 */
    private $_driver = null;

    /** @var array 数据库配置 */
    private $_option = [];

    /**
     * Mysql constructor.
     * @param $option
     */
    public function __construct($option)
    {
        $this->_option = $option;
    }

    /**
     * Get PDO Link for Mysql
     * @return null | \PDO
     */
    public function getInstance()
    {
        return $this->_driver = Db::connection($this->_option);
    }

    /**
     * Get PDO dsn for Mysql
     * @return string
     */
    public function parseDsn()
    {
        $option = $this->_option;
        return "{$option['type']}:host={$option['hostname']};dbname={$option['database']};port={$option['hostport']};charset={$option['charset']};";
    }

}