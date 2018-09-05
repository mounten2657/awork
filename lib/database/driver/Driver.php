<?php

namespace database\driver;

use database\Db;

class Driver
{

    /** @var null 驱动实例 */
    private $_driver = null;

    /** @var array 数据库配置 */
    protected $option = [];

    /**
     * Driver constructor.
     * @param $option
     */
    public function __construct($option)
    {
        $this->option = $option;
    }

    /**
     * Get PDO Link for Driver
     * @return null | \PDO
     */
    public function getInstance()
    {
        return $this->_driver = Db::connection($this->option);
    }

}