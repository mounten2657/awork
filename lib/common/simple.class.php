<?php
/**
 * Simple Class Gather
 * @copyright (c) 2012-2020, Hangzhou Awork Tech Co., Ltd.
 * This is NOT a freeware, use is subject to license terms.
 * @package simpleclass.php
 * @link http://www.awork.com
 * @author wujun
 * @$Id: simpleclass.php 311001 2019-12-25 11:39:48 wujun $
 * */

namespace simple;

/**
 * Class SRequest
 * @package simple
 */
class SRequest
{

    /**
     * request
     * @var mixed
     */
    private $request;
    private $server;
    private $method;
    private $payload;
    private $file;

    /**
     * SRequest constructor.
     * @param array $request
     */
    public function __construct($request = array())
    {
        $this->request = empty($request) ? $_REQUEST : $request;
        $this->server = $_SERVER;
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'unkown';
        $this->payload = json_decode(file_get_contents('php://input'), true) ?: array();
        if (empty($this->payload)) {
            parse_str(file_get_contents('php://input') ?: '', $payload);
            $this->payload = $payload ?: array();
        }
        $this->file = $_FILES;
    }

    /**
     * get request
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name = '', $default = null)
    {
        return isset($this->request[$name]) ? $this->request[$name] : $default;
    }

    /**
     * get post request
     * @param string $name
     * @param null $default
     * @return |null
     */
    public function post($name = '', $default = null)
    {
        $this->request = array_merge($this->request, $this->payload);
        return isset($this->request[$name]) ? $this->request[$name] : $default;
    }

    /**
     * get request method
     * @return string
     */
    public function method()
    {
        return $this->method;
    }

    /**
     * get request server
     * @return mixed
     */
    public function server()
    {
        return $this->server;
    }

    /**
     * get request server
     * @return mixed
     */
    public function file()
    {
        return $this->file;
    }

    /**
     * get all request
     * @return array
     */
    public function all()
    {
        $file = $this->file ? array('file' => $this->file) : array();
        return array_merge($this->request, $this->payload, $file);
    }

    /**
     * get client ip
     * @return mixed|string
     */
    public function ip()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return '';
    }

}

/**
 * Class SResponse
 * @package simple
 */
class SResponse
{

    /**
     * response
     * @var array
     */
    private $response;

    /**
     * SResponse constructor.
     * @param array $response
     */
    public function __construct($response = array())
    {
        $this->response = $response;
    }

    /**
     * response with ok
     * @param array $data
     * @param string $msg
     * @return bool
     */
    public function ok($data = array(), $msg = 'ok')
    {
        return $this->sreturn(array('code' => 0, 'data' => $data, 'msg' => $msg));
    }

    /**
     * response with page
     * @param array $data
     * @param int $count
     * @param string $msg
     * @return bool
     */
    public function page($data = array(), $count = 1, $msg = 'ok')
    {
        return $this->sreturn(array('code' => 0, 'data' => $data, 'count' => $count, 'msg' => $msg));
    }

    /**
     * data
     * @param array $data
     * @return bool
     */
    public function data($data = array())
    {
        return $this->sreturn($data);
    }

    /**
     * response with fail
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return bool
     */
    public function fail($msg = 'fail', $data = array(), $code = 10001)
    {
        return $this->sreturn(array('code' => $code, 'data' => $data, 'msg' => $msg));
    }

    /**
     * gbk to utf8
     * @param $data
     * @return array|false|string
     */
    public function gbk2utf8($data)
    {
        if (is_array($data)) {
            return array_map(array($this, 'gbk2utf8'), $data);
        }
        return iconv('gbk', 'utf-8', $data);
    }

    /**
     * array to json
     * @param $data
     * @return false|string
     */
    public function json($data)
    {
        return json_encode($this->gbk2utf8($data));
    }

    /**
     * return with json format
     * @param array $data
     * @return bool
     */
    public function sreturn($data = array())
    {
        echo $this->json($data);
        return true;
    }

}

/**
 * Class SDownloads
 * @package simple
 */
class SDownloads
{

    /** @var mixed */
    private $file;
    private $name;
    private $content;

    /**
     * SDownloads constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->setOption($config);
    }

    /**
     * tmpFile
     * @param $file
     */
    public function tmpFile($file)
    {
        $this->file = $file;
    }

    /**
     * fileName
     * @param $name
     */
    public function fileName($name)
    {
        $this->name = $name;
    }

    /**
     * content
     * @param $content
     */
    public function content($content)
    {
        $this->content = $content;
    }

    /**
     * setOption
     * @param array $config
     * @return $this
     */
    public function setOption($config = array())
    {
        if (isset($config['file']) && $config['file']) {
            $this->tmpFile($config['file']);
        }
        if (isset($config['name']) && $config['name']) {
            $this->fileName($config['name']);
        }
        if (isset($config['content']) && $config['content']) {
            $this->content($config['content']);
        }
        return $this;
    }

    /**
     * down
     * @return bool
     */
    public function down()
    {
        if (file_exists($this->file)) {
            $filename = iconv("UTF-8", "GB2312", basename($this->file));
            header("Content-type:application/octet-stream");
            header("Content-Disposition:attachment;filename=" . $filename);
            header("Accept-ranges:bytes");
            header("Accept-length:".filesize($this->file));
            readfile($this->file);
            return true;
        }

        if ($this->name && $this->content) {
            $filename = iconv("UTF-8", "GB2312", basename($this->name));
            header("Content-Type: application/octet-stream");
            if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) ) {
                header('Content-Disposition:  attachment; filename="' . $filename . '"');
            } elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT'])) {
                header('Content-Disposition: attachment; filename*="utf8' .  $filename . '"');
            } else {
                header('Content-Disposition: attachment; filename="' .  $filename . '"');
            }
            echo $this->content;
            return true;
        }

        echo "<script>alert('File not exists.')</script>";
        return false;
    }

}

/**
 * Class SUploads
 * @package simple
 */
class SUploads
{

    /**
     * @var array 基本配置
     */
    private $config;
    private $maxSize;
    private $allowMime;
    private $allowExt;
    private $uploadPath;
    private $imgFlag;
    private $delimiter;
    private $fileInfo;
    private $error;
    private $ext;
    private $uniName;
    private $destination;
    private $file;
    private $files;
    private $inum;
    private $key;
    private $value;
    private $uploadFiles;

    /**
     * SUploads constructor.
     * @param array $config
     * @throws \Exception
     * @var bool $imgFlag
     * @var int $maxSize
     * @var array $allowExt
     * @var array $allowMime
     * @var array $uploadPath
     */
    public function __construct($config = array())
    {
        $config = $config ? : $this->getConfig();
        $this->setConfig($config);
        //构建上传文件的信息
        foreach ($_FILES as $this->file) {
            if (is_string($this->file['name'])) {
                $this->files[$this->inum] = $this->file;
                $this->inum++;
            } elseif (is_array($this->file['name'])) {
                foreach ($this->file['name'] as $this->key => $this->value) {
                    $this->files[$this->inum]['name'] = $this->file['name'][$this->key];
                    $this->files[$this->inum]['type'] = $this->file['type'][$this->key];
                    $this->files[$this->inum]['tmp_name'] = $this->file['tmp_name'][$this->key];
                    $this->files[$this->inum]['error'] = $this->file['error'][$this->key];
                    $this->files[$this->inum]['size'] = $this->file['size'][$this->key];
                    $this->inum++;
                }
            }
        }
    }

    /**
     * setConfig
     * @param array $config
     * @return $this
     */
    public function setConfig($config = array())
    {
        $config = $config ? : array(
            'type' => 'local',
            'upload_path' => '/var/www/html/images/local/',
            'realize_check' => true,
            'max_size' => 2 * 1024 * 1024,
            'allow_ext' => array('jpeg', 'jpg', 'png', 'gif'),
            'allow_mime' => array('image/jpeg', 'image/png', 'image/gif'),
            'delimiter' => 'images',
        );
        $this->config = $config;
        // init property
        $this->uploadPath = $config['upload_path'];
        $this->imgFlag = $config['realize_check'];
        $this->maxSize = $config['max_size'];
        $this->allowExt = $config['allow_ext'];
        $this->allowMime = $config['allow_mime'];
        $this->delimiter = $config['delimiter'];
        return $this;
    }

    /**
     * set upload option
     * @param $key
     * @param $value
     * @return $this
     */
    public function setOption($key, $value)
    {
        if (isset($this->config[$key])) {
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * getConfig
     * @return array|mixed|null
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 图片错误信息
     * @return bool
     */
    private function checkError()
    {
        $str = 'error';
        if ($this->fileInfo['error'] != 0) {
            switch ($this->fileInfo['error']) {
                case -1:
                    $str = '文件路径没有设置';
                    break;
                case -2:
                    $str = '文件不是目录或者不可写';
                    break;
                case -3:
                    $str = '文件超过指定大小';
                    break;
                case -4:
                    $str = 'mime类型不符合';
                    break;
                case -5:
                    $str = '文件后缀不符合';
                    break;
                case -6:
                    $str = '不是上传文件';
                    break;
                case -7:
                    $str = '移动失败';
                    break;
                case 1:
                    $str = '超出ini设置大小';
                    break;
                case 2:
                    $str = '超出html表单大小';
                    break;
                case 3:
                    $str = '文章只有部分上传';
                    break;
                case 4:
                    $str = '没有文件上传';
                    break;
                case 6:
                    $str = '找不到临时文件';
                    break;
                case 7:
                    $str = '文件写入失败';
                    break;
                case 8:
                    $str = "系统错误";
                    break;
            }
            $this->error = $str;
            return false;
        }
        return true;
    }

    /**
     * 检测图片后缀
     * @return bool
     */
    private function checkExt()
    {
        $this->ext = strtolower(pathinfo($this->fileInfo['name'], PATHINFO_EXTENSION));
        if (!in_array($this->ext, $this->allowExt)) {
            $this->error = '不允许的扩展名';
            return false;
        }
        return true;
    }

    /**
     * 检查图片大小
     * @return bool
     */
    private function checkSize()
    {
        if ($this->fileInfo['size'] > $this->maxSize) {
            $this->error = '上传文件过大';
            return false;
        }
        return true;
    }

    /**
     * 检测文件类型的
     * @return bool
     */
    private function checkMime()
    {
        if (!in_array($this->fileInfo['type'], $this->allowMime)) {
            $this->error = '不允许的文件类型';
            return false;
        }
        return true;
    }

    /**
     * 检查图片真实性
     * @return bool
     */
    private function checkTrueImg()
    {
        if ($this->imgFlag) {
            if (!@getimagesize($this->fileInfo['tmp_name'])) {
                $this->error = '不是真实图片';
                return false;
            }
        }
        return true;
    }

    /**
     * 是否通过HTTPPOST方式上传上来的
     * @return bool
     */
    private function checkHTTPPOST()
    {
        if (!is_uploaded_file($this->fileInfo['tmp_name'])) {
            $this->error = '文件传输方式有误';
            return false;
        }
        return true;
    }

    /**
     * 显示错误信息
     * @throws \Exception
     */
    private function showError()
    {
        throw new \Exception($this->error, 10021);
    }

    /**
     * 检查上传路径
     * @return bool
     */
    private function checkUploadPath()
    {
        if (!file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
        return true;
    }

    /**
     * 产生唯一字符串
     * @return string
     */
    private function getUniName()
    {
        return md5(uniqid(microtime(true), true));
    }

    /**
     * 获取短路径
     * @param $path
     * @param string $delimiter
     * @return false|string
     */
    private function getShortFilePath($path, $delimiter = '')
    {
        return $delimiter ? strstr($path, DIRECTORY_SEPARATOR . $delimiter . DIRECTORY_SEPARATOR) : $path;
    }

    /**
     * 上传文件
     * @throws \Exception
     */
    private function uploadFile()
    {
        if ($this->checkError()
            && $this->checkExt()
            && $this->checkSize()
            && $this->checkMime()
            && $this->checkTrueImg()
            && $this->checkHTTPPOST()) {
            $this->checkUploadPath();
            $this->uniName = $this->getUniName();
            $this->destination = $this->uploadPath . $this->uniName . '.' . $this->ext;
            if (@move_uploaded_file($this->fileInfo['tmp_name'], $this->destination)) {
                $this->uploadFiles[] = $this->getShortFilePath($this->destination, $this->delimiter);
            } else {
                $this->error = '文件移动失败';
                $this->showError();
            }
        } else {
            $this->showError();
        }
    }

    /**
     * uploads File
     * @return mixed
     * @throws \Exception
     */
    public function uploadsFile()
    {
        foreach ($this->files as $this->fileInfo) {
            $this->uploadFile();
        }
        return $this->uploadFiles;
    }

}

/**
 * Class SMysqlORM
 * @package simple
 */
class SMysqlORM
{

    /**
     * orm const
     */
    const SELECT = 'SELECT %1$s FROM %2$s';
    const JOIN = '%1$s JOIN %2$s';
    const WHERE = 'WHERE %1$s';
    const JOIN_ON = 'ON %1$s';
    const INSERT = 'INSERT %1$s INTO %2$s(%3$s) VALUES%4$s';
    const UPDATE = 'UPDATE %1$s SET %2$s';
    const DELETE = 'DELETE FROM %1$s';
    const INSERT_UPDATE = 'ON DUPLICATE KEY UPDATE %1$s';
    const JOIN_TYPE_INNER = 'INNER';
    const JOIN_TYPE_LEFT = 'LEFT';
    const JOIN_TYPE_RIGHT = 'RIGHT';
    const INSERT_IGNORE = 'IGNORE';
    private $sqlFormar = array(
        'group' => 'GROUP BY %1$s',
        'order' => 'ORDER BY %1$s',
        'limit' => 'LIMIT %1$s',
        'offset' => 'OFFSET %1$s',
    );

    /**
     * mysql pool
     * @var \PDO|\DBCLASS
     */
    public static $db;
    public static $exdb;
    public $sqlLog;
    public $where;
    public $dbConfig;
    public $offset;
    public $limit;
    public $order;
    public $columns = array('*');
    public $table;
    public $group;
    public $joins;
    public $ignore = '';
    public $reset = false;
    public $debug = true;
    public $isColumnVal = false;
    public $stop;
    public $tmpTable;
    private $orderField;
    public $preAttribute = array();
    public $search = array('select', 'join', 'where', 'group', 'order', 'limit', 'offset');

    /*****************************
     * orm参数配置区块 *
     *****************************/

    /**
     * 配置数据库配置
     * @param array $config pdo数据库配置
     * @return $this
     */
    public function setDbConfig($config)
    {
        $config = $config ?: array(
            'type' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'ASM',
            'user' => 'root',
            'passwd' => 'InfogoAsmPass168',
            'charset' => 'gbk',
            'prefix' => '',
            'debug' => false,
            'option' => array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_PERSISTENT => true,
                \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
            )
        );
        $this->dbConfig = $config;
        return $this;
    }

    /**
     * get db config
     * @return mixed
     */
    public function getConfig()
    {
        return $this->dbConfig;
    }

    /**
     * setDB
     * @param $db
     * @return \PDO|\DBCLASS
     * @throws \Exception
     */
    public function setDB($db)
    {
        if ($db) {
            self::$db = $db;
            self::$exdb = $db;
        } else {
            self::$db = $this->db();
        }
        return self::$db;
    }

    /**
     * get db
     * @param array $config
     * @return \PDO|\DBCLASS
     * @throws \Exception
     */
    public function db($config = array())
    {
        if (!self::$db) {
            try {
                $config = $config ? : $this->getConfig();
                $this->setDbConfig($config);
                $dsn = $this->dbConfig['type'] . ':host=' . $this->dbConfig['host'] . ';port=' . $this->dbConfig['port'] . ';dbname=' . $this->dbConfig['dbname'];
                $pdo = new \PDO($dsn, $this->dbConfig['user'], $this->dbConfig['passwd'], $this->dbConfig['option']);
                $pdo->exec('SET NAMES ' . $this->dbConfig['charset']);
                self::$db = $pdo;
            } catch (\PDOException $e) {
                throw new \Exception('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$db;
    }

    /**
     * isExtDB
     * @return bool
     */
    public function isExtDB()
    {
        if (empty(self::$exdb)) {
            return  false;
        }
        return self::$db instanceof self::$exdb ? true : false;
    }

    /**
     * setReset
     * @param $reset
     * @return $this
     */
    public function setReset($reset = true)
    {
        $this->reset = $reset;
        return $this;
    }

    /**
     * usePreSqlAttr
     * @return $this
     */
    public function usePreSqlAttr()
    {
        foreach ($this->preAttribute as $k => $v) {
            $this->$k = $v;
        }
        return $this;
    }

    /**
     * isColumnVal
     * @return $this
     */
    public function isColumnVal()
    {
        $this->isColumnVal = TRUE;
        return $this;
    }

    /**
     * getTable
     * @return mixed
     * @throws \Exception
     */
    public function getTable()
    {
        $table = $this->tmpTable ? $this->tmpTable : $this->table;
        if (empty($table)) {
            throw new \Exception('no have table');
        }
        return $table;
    }

    /**
     * getTableName
     * @return mixed
     * @throws \Exception
     */
    public function getTableName()
    {
        $table = $this->getTable();
        return is_array($table) ? current($table) : $table;
    }

    /**
     * replaceParam
     * @param $k
     * @return string
     */
    private function replaceParam($k)
    {
        return isset($this->{$k}) && !empty($this->{$k}) ? sprintf($this->sqlFormar[$k], $this->{$k}) : '';
    }

    /**
     * preSqlAttribute
     * @param $attr
     * @param string $value
     * @return $this
     */
    public function preSqlAttribute($attr, $value = '')
    {
        $this->preAttribute[$attr] = $this->$attr;
        $this->$attr = $value;
        return $this;
    }

    /**
     * initCondition
     */
    public function initCondition()
    {
        if (!$this->reset) {
            return true;
        }
        $this->preSqlAttribute('columns', array('*'));
        $this->preSqlAttribute('where');
        $this->preSqlAttribute('group');
        $this->preSqlAttribute('order');
        $this->preSqlAttribute('tmpTable');
        $this->preSqlAttribute('joins', array());
        $this->preSqlAttribute('isColumnVal', FALSE);
        $this->preSqlAttribute('ignore');
        $this->preSqlAttribute('onUpdate');
        $this->preSqlAttribute('offset');
        $this->preSqlAttribute('limit');
    }

    /*****************************
     * ORM 条件处理区 *
     *****************************/

    /**
     * processColumns
     * @param $table
     * @param $columns
     * @return string
     */
    public function processColumns($table, $columns)
    {
        $columnsList = array();
        $table = '`' . (is_array($table) ? key($table) : $table) . '`.';
        foreach ($columns as $k => $v) {
            if (empty($v)) {
                continue;
            }
            $v = trim($v);
            $columnsList[] = !is_numeric($k) ? $k . ' AS ' . $v : $table . $v;
        }
        return implode(',', $columnsList);
    }

    /**
     * processTable
     * @param $table
     * @return string
     */
    public function processTable($table)
    {
        if (is_array($table)) {
            $alias = key($table);
            $realTable = current($table);
            $table = $realTable . ' AS ' . $alias;
        }
        return $table;
    }

    /**
     * processSelect
     * @return string
     * @throws \Exception
     */
    public function processSelect()
    {
        $columnList = array();
        if (!empty($this->joins) && !$this->isColumnVal) {
            foreach ($this->joins as $v) {
                if (!empty($v['columns'])) {
                    $columnList[] = $this->processColumns($v['table'], $v['columns']);
                }
            }
        }
        if (!empty($this->columns)) {
            $columnList[] = $this->processColumns($this->getTable(), $this->columns);
        }

        if (empty($columnList)) {
            throw new \Exception("sql haven't columns");
        }

        $column = implode(',', $columnList);
        $sql = sprintf(self::SELECT, $column, $this->processTable($this->getTable()));
        return $sql;
    }

    /**
     * processWhere
     * @return string
     */
    public function processWhere()
    {
        if (empty($this->where)) {
            return '';
        }

        if (is_array($this->where)) {
            $tmp = array();
            foreach ($this->where as $k => $v) {
                if (is_numeric($k)) {
                    $tmp[] = $v;
                } elseif (is_array($v)) {
                    if (empty($v)) {
                        continue;
                    }
                    $opt = isset($v[0]) ? $v[0] : '=';
                    $val = isset($v[1]) ? $v[1] : '0';
                    if (in_array($opt, array('in', 'between'))) {
                        $val = is_array($v[1]) ? implode(',', $v[1]) : $v[1];
                        $val = "({$val})";
                    }
                    if (is_string($val)) {
                        $val = '"' . $val . '"';
                    }
                    $tmp[] = "$k  $opt  $val";
                } else {
                    if (is_string($v)) {
                        $v = '"' . $v . '"';
                    }
                    $tmp[] = "$k  = $v";
                }
            }
            $tmpstr = implode(' AND ', $tmp);
        } else {
            $tmpstr = $this->where;
        }

        $sql = sprintf(self::WHERE, $tmpstr);
        return $sql;
    }

    /**
     * processJoin
     * @return string
     */
    public function processJoin()
    {
        $sql = array();
        if (!empty($this->joins)) {
            foreach ($this->joins as $v) {
                $sql[] = sprintf(self::JOIN, $v['type'], $this->processTable($v['table']));
                if (!empty($v['on'])) {
                    $sql[] = sprintf(self::JOIN_ON, $v['on']);
                }
            }
        }
        return implode(' ', $sql);
    }

    /**
     * processOnUpdate
     * @return string
     */
    public function processOnUpdate()
    {
        if (empty($this->onUpdate)) {
            return '';
        }
        foreach ($this->onUpdate as $k => $v) {
            $sqlArr[] = is_numeric($k) ? "{$v}=VALUES({$v})" : "{$k}={$v}";
        }
        $sql = implode(',', $sqlArr);
        return sprintf(self::INSERT_UPDATE, $sql);
    }

    /**
     * onUpdate
     * @param array $update
     * @return $this
     */
    public function onUpdate($update)
    {
        $this->onUpdate = $update;
        return $this;
    }

    /**
     * orderField
     * @param $field
     * @return $this
     */
    public function orderField($field)
    {
        $this->orderField = $field;
        return $this;
    }

    /**
     * ignore
     * @param string $ignore
     * @return $this
     */
    public function ignore($ignore = self::INSERT_IGNORE)
    {
        $this->ignore = $ignore;
        return $this;
    }

    /**
     * produceSql
     * @return string
     */
    public function produceSql()
    {
        $sqlArr = array();
        foreach ($this->search as $v) {
            $process = 'process' . ucfirst($v);
            $sqlArr[] = method_exists($this, $process) ? call_user_func(array($this, $process)) : $this->replaceParam($v);
        }
        $sql = implode(' ', $sqlArr);
        $this->outputSql($sql);
        $this->initCondition();
        return $sql;
    }

    /*****************************
     * ORM 链式操作区 *
     *****************************/

    /**
     * 配置表名
     * @param mixed $table
     * @return $this
     */
    public function from($table)
    {
        if (!empty($table)) {
            $this->tmpTable = $table;
        }
        return $this;
    }

    /**
     * set table
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        return $this->from($table);
    }

    /**
     * 配置where语句
     * @param $where
     * @param null $opt
     * @param null $val
     * @return $this
     */
    public function where($where, $opt = null, $val = null)
    {
        $args = func_get_args();
        if (count($args) === 2) {
            $where = array($args[0] => $args[1]);
        } elseif (count($args) === 3) {
            $where = array($args[0] => array($args[1], $args[2]));
        }
        if (!empty($where)) {
            $this->where = array_merge($this->where ?: array(), $where);
        }
        return $this;
    }

    /**
     * 配置组
     * @param mixed $group
     * @return $this
     */
    public function group($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * inner join
     * @param string $table 表名
     * @param string $on 链表条件
     * @param array $columns 获取字段
     * @param string $type 链表方式
     * @return $this
     * @throws \Exception
     */
    public function join($table, $on, $columns = array(), $type = self::JOIN_TYPE_INNER)
    {
        if (!in_array($type, array(
            self::JOIN_TYPE_INNER,
            self::JOIN_TYPE_LEFT,
            self::JOIN_TYPE_RIGHT
        ))) {
            throw new \Exception('invalid join type');
        }
        $this->joins[] = array(
            'table' => $table,
            'on' => $on,
            'columns' => $columns,
            'type' => $type,
        );
        return $this;
    }

    /**
     * left join
     * @param $table
     * @param $on
     * @param array $columns
     * @return $this
     * @throws \Exception
     */
    public function leftJoin($table, $on, $columns = array())
    {
        return $this->join($table, $on, $columns, self::JOIN_TYPE_LEFT);
    }

    /**
     * 配置获取当前表的列
     * @param array|string $columns 列名数组
     * @return $this
     */
    public function columns($columns)
    {
        if (is_string($columns)) {
            $columns = explode(',', $columns);
        }
        $this->columns = $columns;
        return $this;
    }

    /**
     * select
     * @param array|string $columns
     * @return $this
     */
    public function select($columns)
    {
        return $this->columns($columns);
    }

    /**
     * 配置数据起点
     * @param int $num 多少条数据开始
     * @return $this
     */
    public function offset($num)
    {
        $this->offset = intval($num);
        return $this;
    }

    /**
     * 配置数据获取条数
     * @param mixed $num
     * @param int $size
     * @return $this
     */
    public function limit($num, $size = 0)
    {
        if (is_string($num) && strpos($num, ',')) {
            $limit = explode(',', $num, 2);
        } elseif ($size) {
            $limit = array(intval($num), $size);
        } else {
            $limit = array(intval($num));
        }
        $this->limit = implode(',', $limit);
        return $this;
    }

    /**
     * take
     * @param $num
     * @param int $size
     * @return $this
     */
    public function take($num, $size = 0)
    {
        $this->limit($num, $size);
        return $this;
    }

    /**
     * 配置排序规则
     * @param string $order 排序规则
     * @return $this
     */
    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    /*****************************
     * ORM DEBUG 区 *
     *****************************/

    /**
     * debug
     * @param bool $stop
     * @return $this
     */
    public function debug($stop = true)
    {
        $this->debug = true;
        $this->stop = $stop;
        return $this;
    }

    /**
     * outputSql
     * @param $sql
     */
    public function outputSql($sql)
    {
        $this->sqlLog[] = $sql;
        if ($this->stop) {
            echo json_encode($this->sqlLog);
            exit;
        }
    }

    /**
     * buildSql
     * @return string
     */
    public function buildSql()
    {
        return $this->produceSql();
    }

    /**
     * getLastSql
     * @return mixed
     */
    public function getLastSql()
    {
        return $this->sqlLog;
    }

    /*****************************
     * ORM 基本方法区 *
     *****************************/

    /**
     * doExec
     * @param $sql
     * @return false|int
     * @throws \Exception
     */
    public function doExec($sql)
    {
        if ($this->isExtDB()) {
            return $this->db()->command($sql);
        }
        return $this->db()->exec($sql);
    }

    /**
     * doQuery
     * @param $sql
     * @param bool $fetchAll
     * @return array|mixed
     * @throws \Exception
     */
    public function doQuery($sql, $fetchAll = true)
    {
        if ($this->isExtDB()) {
            if ($fetchAll) {
                return $this->db()->getFetchAll($sql);
            } else {
                return $this->db()->getFetch($sql);
            }
        }
        if ($fetchAll) {
            $data = $this->db()->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $data = $this->db()->query($sql)->fetch(\PDO::FETCH_ASSOC);
        }
        return empty($data) ? array() : $data;
    }

    /**
     * get all
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        $sql = $this->produceSql();
        $data = $this->doQuery($sql);
        return empty($data) ? array() : $data;
    }

    /**
     * get one
     * @return array|mixed
     * @throws \Exception
     */
    public function first()
    {
        $this->limit(1);
        $sql = $this->produceSql();
        $data = $this->doQuery($sql, false);
        return empty($data) ? array() : $data;
    }

    /**
     * get count
     * @return int
     * @throws \Exception
     */
    public function count()
    {
        $this->offset(0)->limit(0);
        if (!empty($this->group)) {
            $this->from(array('a' => '(' . $this->produceSql() . ')'));
        }
        $count = $this->value(array('count(*)' => 'count'));
        return intval($count);
    }

    /**
     * get column value
     * @param $column
     * @return mixed
     * @throws \Exception
     */
    public function value($column)
    {
        $row = $this->isColumnVal()->columns($column)->first();
        $key = is_array($column) ? current($column) : $column;
        return isset($row[$key]) ? $row[$key] : null;
    }

    /**
     * @param $data
     * @param string $table
     * @return false|int
     * @throws \Exception
     */
    public function insert($data, $table = '')
    {
        $key = key($data);
        if (is_numeric($key)) {
            $oneInfo = current($data);
            $columns = '`' . implode('`,`', array_keys($oneInfo)) . '`';
            $values = '';
            foreach ($data as $v) {
                $values .= "('" . implode("','", array_map('addslashes', $v)) . "'),";
            }
            $values = rtrim($values, ',');
        } else {
            $columns = '`' . implode('`,`', array_keys($data)) . '`';
            $values = "('" . implode("','", array_map('addslashes', $data)) . "')";
        }
        $sql = sprintf(self::INSERT, $this->ignore, $this->from($table)->getTableName(), $columns, $values) . ' ' . $this->processOnUpdate();
        $this->outputSql($sql);
        $this->initCondition();
        return $this->doExec($sql);
    }

    /**
     * getLastInsertId
     * @return string
     * @throws \Exception
     */
    public function getLastInsertId()
    {
        return $this->db()->lastInsertId();
    }

    /**
     * insertGetId
     * @param $data
     * @return string
     * @throws \Exception
     */
    public function insertGetId($data)
    {
        $this->insert($data);
        return $this->getLastInsertId();
    }

    /**
     * @param $data
     * @param array $where
     * @param string $table
     * @return false|int
     * @throws \Exception
     */
    public function update($data, $where = array(), $table = '')
    {
        foreach ($data as $k => $v) {
            $values[] = "`{$k}`='{$v}'";
        }
        $sql = sprintf(self::UPDATE, $this->from($table)->getTableName(), implode(',', $values)) . ' ' . $this->where($where)->processWhere();
        $this->outputSql($sql);
        $this->initCondition();
        return $this->doExec($sql);
    }

    /**
     * delete
     * @param array $where
     * @param string $table
     * @return false|int
     * @throws \Exception
     */
    public function delete($where = array(), $table = '')
    {
        $sql = sprintf(self::DELETE, $this->from($table)->getTableName()) . ' ' . $this->where($where)->processWhere();
        $this->outputSql($sql);
        $this->initCondition();
        return $this->doExec($sql);
    }

    /**
     * beginTransaction
     * @return bool
     * @throws \Exception
     */
    public function beginTransaction()
    {
        return $this->db()->beginTransaction();
    }

    /**
     * commit
     * @return bool
     * @throws \Exception
     */
    public function commit()
    {
        return $this->db()->commit();
    }

    /**
     * rollBack
     * @return bool
     * @throws \Exception
     */
    public function rollBack()
    {
        return $this->db()->rollBack();
    }

}

/**
 * Class SLog
 * @package simple
 */
class SLog
{
    /**
     * 日志文件后缀名
     */
    const EXT = '.log';

    /**
     * 日志级别 从上到下，由低到高
     */
    const SQL = '1';   // SQL：SQL语句 注意只在调试模式开启时有效
    const DEBUG = '2';   // 调试: 调试信息
    const INFO = '3';   // 信息: 程序输出信息
    const NOTICE = '4';   // 通知: 程序可以运行但是还不够完美的错误
    const WARN = '5';   // 警告性错误: 需要发出警告的错误
    const ERR = '6';   // 一般错误: 一般性错误
    const CRIT = '7';   // 临界值错误: 超过临界值的错误，例如一天24小时，而输入的是25小时这样
    const ALERT = '8';   // 警戒性错误: 必须被立即修改的错误
    const EMERG = '9';   // 严重错误: 导致系统崩溃无法使用

    /**
     * 日志级别索引，与常量保持一致
     * @var array
     */
    private static $_logLevel = array(
        self::SQL => 'SQL',
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::NOTICE => 'NOTICE',
        self::WARN => 'WARN',
        self::ERR => 'ERR',
        self::CRIT => 'CRIT',
        self::ALERT => 'ALERT',
        self::EMERG => 'EMERG',
    );

    /**
     * 日志默认配置
     * 量大时考虑 'log_date_format' => 'Ymd/H',
     * @var array
     */
    private static $_logConfig = array(
        'log_level' => 'info',
        'log_date_format' => 'Y_m_d',
        'log_file_size' => 1024000000,
        'log_path' => array(
            'default' => '/data/logs/default/',
            'sql' => '/data/logs/sql/',
        ),
    );

    /**
     * SLog constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $config = $config ? : $this->getConfig();
        $this->setConfig($config);
    }

    /**
     * setConfig
     * @param array $config
     */
    public function setConfig($config = array())
    {
        self::$_logConfig = $config ? : self::$_logConfig;
    }

    /**
     * set upload option
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setOption($key, $value)
    {
        if (isset(self::$_logConfig[$key])) {
            self::$_logConfig[$key] = $value;
        }
        return self::$_logConfig;
    }

    /**
     * getConfig
     * @return array
     */
    public function getConfig()
    {
        return self::$_logConfig;
    }

    /**
     * 日志配置
     * @param mixed $config
     * @return mixed
     */
    public static function config($config)
    {
        if (is_array($config)) {
            self::$_logConfig = $config;
            return self::$_logConfig;
        }
        if (isset(self::$_logConfig[$config])) {
            return self::$_logConfig[$config];
        }
        return null;
    }

    /**
     * 日志写入
     * @param mixed $message 日志信息
     * @param string $module 日志模块
     * @param string $level 日志级别
     * @param string $file 日志文件
     * @return mixed 写入结果
     */
    private static function _write($message, $module, $level, $file)
    {
        $module = $module ?: 'default';
        if (is_array($message) || is_object($message)) {
            $message = var_export($message, true);
        }
        $logPath = self::_getLogPath($module);
        if (false === $logPath) {
            return false;
        }
        $file = $file ?: date(self::config('log_date_format')) . self::EXT;
        $destination = $logPath . '/' . $file;
        $path = dirname($destination);
        // 避免文件读写出现问题而造成整个挂掉
        try {
            // 检测目录是否存在
            if (!is_dir($path)) {
                if (!mkdir($path, 0722, true)) {
                    return false;
                }
            }
            //检测日志文件大小，超过配置大小则备份日志文件重新生成
            if (is_file($destination) && floor(self::config('log_file_size')) <= filesize($destination)) {
                $destination = dirname($destination) . '/' . basename($destination) . '-over' . self::EXT;
            }
            $level = self::$_logLevel[$level];
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown ip';
            $msg = '['. $module .']'.'[' . date("Y-m-d H:i:s") . '][' . $ip . '][' . $level . '] ' . $message . "\n";
            $result = error_log($msg, 3, $destination);
        } catch (\Exception $e) {
            return false;
        }
        return $result;
    }

    /**
     * 获取日志存放路径
     * @param $module
     * @return mixed
     */
    private static function _getLogPath($module)
    {
        $path = self::config('log_path');
        if (empty($path) || !isset($path[$module])) {
            return false;
        }
        return $path[$module];
    }

    /**
     * 记录日志 并且会过滤未经设置的级别
     * @param mixed $message 日志信息
     * @param string $module 日志模块
     * @param string $level 日志级别
     * @param string $file 日志文件
     * @return mixed  写入结果
     */
    public static function record($message, $module = '', $level = self::INFO, $file = '')
    {
        $defaultLevel = array_search(strtoupper(self::config('log_level')), self::$_logLevel) ?: '0';
        if ($level < $defaultLevel) {
            return false;
        }
        return self::_write($message, $module, $level, $file);
    }

    /**
     * debug module
     * @param $message
     * @param string $module
     * @return mixed
     */
    public function debug($message, $module = '')
    {
        return self::record($message, $module, self::DEBUG);
    }

    /**
     * info module
     * @param $message
     * @param string $module
     * @return mixed
     */
    public function info($message, $module = '')
    {
        return self::record($message, $module, self::INFO);
    }

    /**
     * warning module
     * @param $message
     * @param string $module
     * @return mixed
     */
    public function warning($message, $module = '')
    {
        return self::record($message, $module, self::WARN);
    }

    /**
     * error module
     * @param $message
     * @param string $module
     * @return mixed
     */
    public function error($message, $module = '')
    {
        return self::record($message, $module, self::ERR);
    }

}

/**
 * define function sapp
 */
if (!function_exists('sapp')) {
    /**
     * sapp
     * @return Sapp
     */
    function sapp() {
        return new \simple\Sapp();
    }
}

/**
 * Class Sapp
 * @package simple
 */
class Sapp
{

    /**
     * app instance pool
     * @var array
     */
    private static $_instance = array();

    /**
     * Sapp initialize
     */
    public function init()
    {
        header("Content-type: text/html; charset=utf-8");
        header("Access-Control-Allow-Origin: *");
        date_default_timezone_set("PRC");
        return $this;
    }

    /**
     * getInstance
     * @param $appName
     * @param $namespace
     * @return mixed
     */
    public function getInstance($appName = '', $namespace = '')
    {
        $appName = $namespace ? : '\\simple\\' . $appName;
        if (empty($appName)) {
            return self::$_instance;
        }
        if (isset(self::$_instance[$appName]) && !is_null(self::$_instance[$appName])) {
            return self::$_instance[$appName];
        }
        $app = new $appName();
        self::$_instance[$appName] = $app;
        return $app;
    }

    /**
     * hasApp
     * @param $appName
     * @return mixed|null
     */
    public function hasApp($appName)
    {
        if (isset(self::$_instance[$appName]) && !is_null(self::$_instance[$appName])) {
            return self::$_instance[$appName];
        }
        return null;
    }

    /**
     * setApp
     * @param $appName
     * @param $instance
     * @return mixed
     */
    public function setApp($appName, $instance)
    {
        return self::$_instance[$appName] = $instance;
    }

    /**
     * request instance
     * @return SRequest
     */
    public function request()
    {
        return $this->getInstance('SRequest');
    }

    /**
     * response instance
     * @return SResponse
     */
    public function response()
    {
        return $this->getInstance('SResponse');
    }

    /**
     * download instance
     * @return SDownloads
     */
    public function download()
    {
        return $this->getInstance('SDownloads');
    }

    /**
     * upload file
     * @return SUploads
     * @throws \Exception
     */
    public function upload()
    {
        $appName = 'SUploads';
        if ($app = $this->hasApp($appName)) return $app;
        $config = array(
            'type' => 'local',
            'upload_path' => '/var/www/html/images/local/',
            'realize_check' => true,
            'max_size' => 2 * 1024 * 1024,
            'allow_ext' => array('jpeg', 'jpg', 'png', 'gif'),
            'allow_mime' => array('image/jpeg', 'image/png', 'image/gif'),
            'delimiter' => 'images',
        );
        $app = new SUploads();
        $app->setConfig($config);
        $this->setApp($appName, $app);
        return $app;
    }

    /**
     * db pool
     * @return SMysqlORM
     * @throws \Exception
     */
    public function db()
    {
        $appName = 'SMysqlORM';
        if ($app = $this->hasApp($appName)) return $app;
        global $DB;
        $config = array(
            'type' => 'mysql',
            'host' => '127.0.0.1',
            'port' => '3306',
            'dbname' => 'ASM',
            'user' => 'root',
            'passwd' => 'InfogoAsmPass168',
            'charset' => 'gbk',
            'prefix' => '',
            'debug' => false,
            'option' => array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_PERSISTENT => true,
                \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
            )
        );
        $app = new SMysqlORM();
        $app->setDbConfig($config)->setDB($DB);
        $this->setApp($appName, $app);
        return $app;
    }

    /**
     * log handler
     * @return SLog
     */
    public function log()
    {
        $appName = 'SLog';
        if ($app = $this->hasApp($appName)) return $app;
        $config = array(
            'log_level' => 'info',
            'log_date_format' => 'Y_m_d',
            'log_file_size' => 1024 * 1000 * 1000,
            'log_path' => array(
                'default' => '/var/www/html/logs/default/',
            ),
        );
        $app = new SLog();
        $app->setConfig($config);
        $this->setApp($appName, $app);
        return $app;
    }

}


