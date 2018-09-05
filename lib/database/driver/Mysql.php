<?php

namespace database\driver;

/**
 * Mysql 驱动类
 */
class Mysql extends Driver
{

    /**
     * Get PDO dsn for Mysql
     * @return string
     */
    public function parseDsn()
    {
        $option = $this->option;
        return "{$option['type']}:host={$option['hostname']};dbname={$option['database']};port={$option['hostport']};charset={$option['charset']};";
    }

}