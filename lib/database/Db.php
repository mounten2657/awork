<?php


class Db
{

    /** @var string MYSQL 数据库类型 */
    const DB_TYPE_MYSQL = 'mysql';

    /** @var null 数据库实例 */
    private static $_instance = null;

    /**
     * 获取数据库配置
     * @param $database
     * @return mixed
     */
    private static function _getOption($database)
    {
        $database = $database ? : 'default';
        $option = config('database.'.$database);
        $option['dsn'] = self::_getDsn($option);
        if (empty($option['params'])) {
            $option['params'] = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,      // 默认是 \PDO::ERRMODE_SILENT, 0, 忽略错误模式
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // 默认是 \PDO::FETCH_BOTH, 4, assoc 和 num 都返回
            ];
        }
        return $option;
    }

    /**
     * 获取 PDO 连接 dsn
     * @param $option
     * @return string
     */
    private static function _getDsn($option)
    {
        switch ($option['type']) {
            case self::DB_TYPE_MYSQL :
                $dsn = "{$option['type']}:host={$option['hostname']};"
                    ."dbname={$option['database']};port={$option['hostport']};charset={$option['charset']};";
                break;
            default :
                $dsn = "";
                break;
        }
        return $dsn;
    }

    /**
     * 获取数据库实例
     * @param string $database
     * @return null|PDO
     */
    public static function getInstance($database = '')
    {
        if (null === self::$_instance) {
            try {
                $option = self::_getOption($database);
                self::$_instance = new \PDO($option['dsn'], $option['username'], $option['password'], $option['params']);
            } catch (\PDOException $e) {
                throw new \Exception($e->getMessage(), $e->getCode());
            }
        }
        return self::$_instance;
    }

}