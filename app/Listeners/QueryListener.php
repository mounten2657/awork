<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;

/**
 * Class QueryListener
 * @package App\Listeners
 */
class QueryListener {

    /** @var array 禁止记录 SQL 日志的模块 */
    protected static $aDenyModule = [];

    /**
     * SQL 日志监听
     *
     * @param QueryExecuted $event
     * @return bool
     * @author wuj@igancao.com
     * @date 2021/12/13 16:01
     * <li></li>
     */
    public function handle (QueryExecuted $event) {
        // 只有非调试环境且特定模块才记录日志
        $module = $this->getModule();
        if (!empty($module)) {
            // $sql = vsprintf(str_replace("?", "'%s'", $event->sql), $event->bindings);
            $replace = [];
            $sql = $event->sql;
            for ($i=0; $i<count($event->bindings); $i++) {
                $replace[] = '?';
            }
            if ($replace) {
                $sql = str_replace($replace, $event->bindings, $event->sql);
            }
            // 继续替换预匹配的参数
            if (false !== strpos($sql, ':')) {
                foreach ($event->bindings as $key => $bind) {
                    if (!is_numeric($key) && false !== strpos($sql, ":{$key}")) {
                        $bind = is_numeric($bind) ? $bind : "'{$bind}'";
                        $sql = str_replace(":{$key}", $bind, $sql);
                    }
                }
            }
            glog('sql/sql')->info('[SQL_LOG]', [$sql]);
        }
        return true;
    }

    /**
     * 获取模块名 - 匹配到返回为空
     *
     * @return string
     * @author wuj@igancao.com
     * @date 2021/12/13 17:15
     * <li></li>
     */
    protected function getModule() {
        $params = app('request')->request->all();
        $package = $params['package'] ?? 'null';
        if (empty($package)) {
            // 兼容一下 cli 模式
            $package = preg_match("/cli/i", php_sapi_name()) ? 'console' : '';
        }
        foreach (self::$aDenyModule as $module) {
            if (false !== strpos($package, $module)) {
                return '';
            }
        }
        return $package;
    }

}
