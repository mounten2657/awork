<?php

namespace database;

/**
 * 数据库基类
 */
class Db
{

    /** @var null 数据库实例 */
    private static $_instance = null;

    /** @var null 数据库驱动类 */
    private static $_driver = null;

    /** @var null PDO 连接 */
    private static $_connection = null;

    /**
     * 获取数据库配置
     * @param $database
     * @return mixed
     */
    private static function _getOption($database)
    {
        $database = $database ? : 'default';
        $option = self::_parseOption(config('database.'.$database));
        if (empty($option['params'])) {
            $option['params'] = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_CASE               => \PDO::CASE_LOWER,
                \PDO::ATTR_ORACLE_NULLS       => \PDO::NULL_NATURAL,
                \PDO::ATTR_STRINGIFY_FETCHES  =>  false,
            ];
        }
        return $option;
    }

    /**
     * 检查配置参数
     * @param $option
     * @return mixed
     */
    private static function _parseOption($option)
    {
        $needle = ['type', 'hostname', 'database', 'username', 'password', 'hostport', 'params', 'charset', 'prefix'];
        $result = array_diff($needle, array_keys($option));
        if (!empty($result)) {
            throw new \Exception('Db option invalid, these keys not exist: '.implode(',', $result), 550);
        }
        return $option;
    }

    /**
     * 获取数据库驱动
     * @param $option
     * @return object
     */
    private static function _getDriver($option)
    {
        if (null === self::$_driver) {
            $driver =  "\\database\\driver\\".ucfirst($option['type']);
            if (!class_exists($driver)) {
                throw new \Exception("Db driver not ready for ".$option['type'], 551);
            }
            self::$_driver = new $driver($option);
        }
        return self::$_driver;
    }

    /**
     * 获取数据库实例
     * @param string $database
     * @return null | object
     */
    public static function getInstance($database = '')
    {
        if (null === self::$_instance) {
            $option = self::_getOption($database);
            self::$_instance = self::_getDriver($option)->getInstance();
        }
        return self::$_instance;
    }

    /**
     * 连接 PDO
     * @param $option
     * @return null | \PDO
     */
    public static function connection($option)
    {
        try {
            $dsn = self::_getDriver($option)->parseDsn();
            self::$_connection = new \PDO($dsn, $option['username'], $option['password'], $option['params']);
        } catch (\PDOException $e) {
            throw new \Exception("Connecting Db failed: ".$e->getMessage(), $e->getCode());
        }
        return self::$_connection;
    }

}