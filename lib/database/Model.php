<?php

namespace database;

/**
 * 模型类
 */
class Model
{

    /** @var int 查询类型 */
    const SQL_TYPE_SELECT = 1;
    /** @var int 插入类型 */
    const SQL_TYPE_INSERT = 2;
    /** @var int 更新类型 */
    const SQL_TYPE_UPDATE = 3;
    /** @var int 删除类型 */
    const SQL_TYPE_DELETE = 4;

    /** @var array 条件运算符 */
    private $_operator = ['<', '>', '=', '<=', '>=', '<>', '!=', 'IN', 'LIKE', 'BETWEEN', 'NOT IN', 'NOT LIKE', 'NOT BETWEEN'];

    /** @var array 数据库对象池 */
    private $_instance = [];

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
        $tableName = substr($tableName, 0, -6);
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
     * 解析 where 条件参数
     * @return array
     */
    private function _parseWhere()
    {
        $whereStr = '';
        $wherePar = [];
        if (!isset($this->query['where'])) {
            return [$whereStr, $wherePar];
        }
        foreach ($this->query['where'] as $field => $where) {
            if ('__string' == $field) {
                $whereStr .= "AND $where ";
            } elseif (!is_array($where)) {
                $whereStr .= "AND $field = 'w:$field' ";
                $wherePar["w:$field"] = $where;
            } elseif (isset($where[0]) && isset($where[1]) && in_array(strtoupper($where[0]), $this->_operator)) {
                if (in_array(strtolower($where[0]), ['in', 'between', 'not in', 'not between'])) {
                    $where[0] = strtoupper($where[0]);
                    if (is_array($where[1])) {
                        $where[1] = '('.implode(',', $where[1]).')';
                    }
                }
                $whereStr .= "AND $field {$where[0]} 'w:$field' ";
                $wherePar["w:$field"] = $where[1];
            } else {
                continue;
            }
        }
        if (!empty($whereStr)) {
            $whereStr = substr($whereStr, 4);
        }
        return [$whereStr, $wherePar];
    }

    /**
     * 解析 insert 插入参数
     * @return array
     */
    private function _parseInsert()
    {
        $insertStr = '';
        $insertPar = [];
        if (!isset($this->query['insert'])) {
            return [$insertStr, $insertPar];
        }
        foreach ($this->query['insert'] as $key => $insert) {
            $insertStr .= ", ('i:[$key]".substr(implode("', 'i:[$key]", array_keys($insert)), 3).')';
            array_map(function ($val) use (&$insertPar, $key) {
                $insertPar["i:$key"] = $val;
            },array_values($insert));
        }
        if (!empty($insertStr)) {
            $insertStr = substr($insertStr, 2);
        }
        return [$insertStr, $insertPar];
    }

    /**
     * 解析 update 更新参数
     * @return array
     */
    private function _parseUpdate()
    {
        $updateStr = '';
        $updatePar = [];
        if (!isset($this->query['update'])) {
            return [$updateStr, $updatePar];
        }
        foreach ($this->query['update'] as $key => $update) {
            $updateStr .= ", $key = 'u:$key'";
            $updatePar["u:$key"] = $update;
        }
        if (!empty($updateStr)) {
            $updateStr = substr($updateStr, 1);
        }
        return [$updateStr, $updatePar];
    }

    /**
     * 构建预处理 SQL 语句
     * @param int $sqlType
     * @return string
     */
    private function _buildPreSql($sqlType = self::SQL_TYPE_SELECT)
    {
        // parse bind param
        $this->query['parse']['insert'] = $this->_parseInsert();
        $this->query['parse']['update'] = $this->_parseUpdate();
        $this->query['parse']['where']  = $this->_parseWhere();
        $tableName = "{$this->prefix}{$this->tableName}";
        $field = isset($this->query['field']) ? $this->query['field'] : '*';
        // build sql
        switch ($sqlType) {
            case self::SQL_TYPE_SELECT :
                $sql = "SELECT {$field} FROM {$tableName} rule:where rule:order rule:group rule:limit;";
                $sql = str_replace(["rule:where", "rule:order", "rule:group", "rule:limit"], [
                    isset($this->query['parse']['where'][0]) ? "WHERE {$this->query['parse']['where'][0]}" : "",
                    isset($this->query['order']) ? "ORDER BY {$this->query['order']}" : "",
                    isset($this->query['group']) ? "GROUP BY {$this->query['group']}" : "",
                    isset($this->query['limit']) ? "LIMIT {$this->query['limit']}" : "",
                ], $sql);
                break;
            case self::SQL_TYPE_INSERT :
                $sql = "INSERT INTO {$tableName} rule:key VALUES rule:value;";
                $sql = str_replace(["rule:key", "rule:value"], [
                    isset($this->query['insert'][0]) ? "(".implode(',',array_keys($this->query['insert'][0])).")" : "",
                    isset($this->query['parse']['insert'][0]) ? "{$this->query['parse']['insert'][0]}" : "",
                ], $sql);
                break;
            case self::SQL_TYPE_UPDATE :
                $sql = "UPDATE {$tableName} SET rule:colunm rule:where rule:limit;";
                $sql = str_replace(["rule:colum", "rule:where", "rule:limit"], [
                    isset($this->query['parse']['update'][0]) ? "{$this->query['parse']['update'][0]}" : "",
                    isset($this->query['parse']['where'][0]) ? "WHERE {$this->query['parse']['where'][0]}" : "",
                    isset($this->query['limit']) ? "LIMIT ".intval($this->query['limit']) : "",
                ], $sql);
                break;
            case self::SQL_TYPE_DELETE :
                $sql = "DELETE FROM {$tableName} rule:where rule:limit;";
                $sql = str_replace(["rule:where", "rule:limit"], [
                    isset($this->query['parse']['where'][0]) ? "WHERE {$this->query['parse']['where'][0]}" : "",
                    isset($this->query['limit']) ? "LIMIT ".intval($this->query['limit']) : "",
                ], $sql);
                break;
            default :
                $sql = '';
                break;
        }
        // return sql
        return $sql;
    }

    /**
     * 绑定条件参数
     * @param $stmt
     * @param $param
     * @return mixed
     */
    private function _bindParam($stmt, $param)
    {
        foreach ($param as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        return $stmt;
    }

    /**
     * 切换数据库对象
     * @param $dbName
     * @return $this
     */
    public function db($dbName)
    {
        if (isset($this->_instance[$this->dbName])) {
            return $this;
        }
        $this->dbName = $dbName;
        $this->_instance[$this->dbName] = $dbName;
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
        $stmt->execute($param);
        return $stmt->rowCount();
    }

    /**
     * 构建 SQL 语句
     * @param int $sqlType
     * @return mixed|string
     */
    public function buildSql($sqlType = self::SQL_TYPE_SELECT)
    {
        $sql = $this->_buildPreSql($sqlType);
        foreach ($this->query['parse'] as $parse) {
            if (isset($parse[1]) && !empty($parse[1])) {
                $replace = $parse[1];
                $sql = str_replace(array_keys($replace), array_values($replace), $sql);
            }
        }
        return $sql;
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
    public function where($field, $operator = '', $value = null)
    {
        if (is_array($field)) {
            $this->query['where'] = $field;
        } else {
            $field = strval($field) ? : '';
            if (null === $value) {
                $this->query['where'][$field] = $operator;
            } else {
                if (is_string($value)) {
                    $value = "'$value'";
                }
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

    public function find()
    {

    }

    public function select()
    {
        $preSql = $this->_buildPreSql(self::SQL_TYPE_SELECT);
        $sql = $this->buildSql();
        $this->query['sql'] = $sql;
        $stmt = $this->db->prepare($preSql);
        $this->_bindParam($stmt, $this->query['parse']['where'][1]);
        return $this->query($preSql);
    }

    public function count()
    {

    }

    public function insert($data)
    {
        $this->query['insert'][] = $data;
    }

    public function insertAll($data)
    {
        foreach ($data as $item) {
            $this->insert($item);
        }
    }

    public function update($data)
    {
        $this->query['update'] = $data;
    }

    public function delete()
    {

    }

}