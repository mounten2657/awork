<?php

namespace database;

/**
 * 模型类
 */
class Model
{

    /** @var null|object 数据库对象 */
    protected $db = null;

    /** @var array 数据库配置 */
    protected $option = [];

    /** @var mixed|string 数据库名 */
    protected $dbName = 'default';

    /** @var null|string|string[] 表名 */
    protected $tableName = '';

    /** @var mixed|string 表前缀 */
    protected $prefix = '';

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->_initialize();
        $this->dbName = self::_getDbName();
        $this->tableName = self::_getTableName();
        $this->option = config('database.'.$this->dbName);
        $this->prefix = isset($this->option['prefix']) ? $this->option['prefix'] : '';
        $this->db = Db::getInstance($this->dbName);
    }

    /**
     * initialize variable
     */
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

    /**
     * 获取类名信息
     * @return array
     */
    private function _getClassName()
    {
        $className = get_class($this);
        return explode('\\', $className) ? : [];
    }

    /**
     * 获取数据库名
     * @return mixed|string
     */
    private function _getDbName()
    {
        $className = self::_getClassName();
        $modelLayer = config('default_model_layer');
        $key = array_search($modelLayer, $className);
        if ($key && array_key_exists($key + 1, $className)) {
            return $className[$key + 1];
        }
        return '';
    }

    /**
     * 获取表明（不带前缀）
     * @return null|string|string[]
     */
    private function _getTableName()
    {
        $className = self::_getClassName();
        return humpToLine(end($className)) ? : '';
    }

}