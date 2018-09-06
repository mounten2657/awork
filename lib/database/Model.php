<?php

namespace database;

/**
 * 模型类
 */
class Model
{

    /** @var int 查询类型 */
    const QUERY_TYPE_SELECT = 1;
    /** @var int 插入类型 */
    const QUERY_TYPE_INSERT = 2;
    /** @var int 更新类型 */
    const QUERY_TYPE_UPDATE = 3;
    /** @var int 删除类型 */
    const QUERY_TYPE_DELETE = 4;

    /** @var array 条件运算符 */
    private $_operator = ['<', '>', '=', '<=', '>=', '<>', '!=', 'IN', 'BETWEEN', 'LIKE', 'NOT IN', 'NOT LIKE'];

    /** @var null|object 数据库对象 */
    protected $db = null;

    /** @var mixed|string 数据库名 */
    protected $dbName = '';

    /** @var null|string|string[] 表名 */
    protected $tableName = '';

    /** @var mixed|string 表前缀 */
    protected $prefix = '';

    /** @var array 预执行信息 */
    protected $query = [];

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->_initialize();
        $this->dbName = self::_getDbName();
        $this->tableName = self::_getTableName();
        $option = config('database.'.$this->dbName);
        $this->prefix = isset($option['prefix']) ? $option['prefix'] : '';
        $this->db($this->dbName);
    }

    /**
     * initialize variable
     */
    public function _initialize()
    {
        // to initialize model variable
    }

    /**
     * 获取数据库名
     * @return mixed|string
     */
    private function _getDbName()
    {
        if ($this->dbName) {
            return $this->dbName;
        }
        $className = self::_getClassName();
        $modelLayer = config('default_model_layer');
        $key = array_search($modelLayer, $className);
        if ($key && array_key_exists($key + 1, $className)) {
            $dbName = $className[$key + 1];
        } else {
            $dbName = '';
        }
        return $this->dbName = $dbName;
    }

    /**
     * 获取表名（不带前缀）
     * @return null|string|string[]
     */
    private function _getTableName()
    {
        if ($this->tableName) {
            return $this->tableName;
        }
        $className = self::_getClassName();
        $tableName = humpToLine(end($className)) ? : '';
        return $this->tableName = $tableName;
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
     * 切换数据库对象
     * @param $dbName
     * @return $this
     */
    public function db($dbName)
    {
        if ($this->dbName == $dbName) {
            return $this;
        }
        $this->dbName = $dbName;
        $this->db = Db::getInstance($dbName);
        return $this;
    }

    /**
     * 切换数据表
     * @param $tableName
     * @return $this
     */
    public function table($tableName)
    {
        if ($this->tableName == $tableName) {
            return $this;
        }
        $this->tableName = $tableName;
        return $this;
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
     * 构建 SQL 语句
     * @param int $queryType
     * @return string
     */
    public function buildSql($queryType = self::QUERY_TYPE_SELECT)
    {
        switch ($queryType) {
            case self::QUERY_TYPE_SELECT :
                $sql = '';
                break;
            case self::QUERY_TYPE_INSERT :
                $sql = '';
                break;
            case self::QUERY_TYPE_UPDATE :
                $sql = '';
                break;
            case self::QUERY_TYPE_DELETE :
                $sql = '';
                break;
            default :
                $sql = '';
                break;
        }
        return $sql;
    }

    /**
     * 绑定条件参数
     * @param $stmt
     * @param $param
     * @return mixed
     */
    public function bindParam($stmt, $param)
    {
        foreach ($param as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        return $stmt;
    }

    /**
     * 添加子查询
     * @param $sql
     * @return Model
     */
    public function subSql($sql)
    {
        return $this->table($sql);
    }

    /**
     * 获取最新操作 SQL
     * @return mixed
     */
    public function lastSql()
    {
        return $this->query['sql'];
    }

    /**
     * 增加操作字段
     * @param $field
     * @return $this
     */
    public function field($field)
    {
        $field = strval($field) ? : '*';
        $this->query['field'] = $field;
        return $this;
    }

    /**
     * 增加操作条件
     * @param $field
     * @param string $operator
     * @param string $value
     * @return $this
     */
    public function where($field, $operator = '', $value = '')
    {
        if (is_array($field)) {
            $this->query['where'] = $field;
        } else {
            $field = strval($field) ? : '';
            $operator = in_array(strtolower($operator), $this->_operator) ? $operator : '';
            if (empty($value)) {
                $this->query['where'][$field] = $operator;
            } else {
                $this->query['where'][$field] = [$operator, $value];
            }
        }
        return $this;
    }

    /**
     * 增加排序规则
     * @param $order
     * @return $this
     */
    public function order($order)
    {
        $this->query['order'] = $order;
        return $this;
    }

    /**
     * 增加分组规则
     * @param $group
     * @return $this
     */
    public function group($group)
    {
        $this->query['group'] = $group;
        return $this;
    }

    /**
     * 增加操作条数限制
     * @param $offset
     * @param int $limit
     * @return $this
     */
    public function limit($offset, $limit = 0)
    {
        $this->query['limit'] = strval($offset);
        if ($limit) {
            $this->query['limit'] .= ",".strval($limit);
        }
        return $this;
    }

    public function select()
    {

    }

    public function find()
    {

    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}