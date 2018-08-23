<?php

/**
 * 定义常量
 */
define('WWW_DIR', '/data/www/test/');
define('CRON_API_DIR', WWW_DIR.'api6.coobar.cn/');
define('COMMAND_PHP_THINK', '/usr/local/php/bin/php think ');
define('CRON_DIR', WWW_DIR.'script6/');
define('LOG_DIR', '/data/logs/cron/');
define('COMMAND_RESULT_LOAD', 'cron_worldcup_result_load');
define('COMMAND_RRIZE_STAT', 'cron_worldcup_prize_stat');
define('COMMAND_RRIZE_SEND', 'cron_worldcup_prize_send');


// 接收命令类型
$type = _get('type');
if (!$type) {
    _error(101, 'type is not given');
}

// 获取命令信息
$command = _getCommand($type);
if (isset($command['code'])) {
    _error($command['code'], $command['info']);
}dd($command);

// 执行命令
$result = _execute($command);
dd($result);


/*================================== 函数区 =====================================*/

/**
 * 执行命令
 * @param $command
 * @return string
 */
function _execute($command)
{
    $result  = 'execute info: '."\r\n";
    try {
        $commands = implode(' && ',$command);
        dd('real execute command: '.$commands);
        $result .= shell_exec($commands);
        $logInfo = _getCommandLog($command, $result);
        file_put_contents(LOG_DIR.'cron_worldcup_web_exec.log', $logInfo,FILE_APPEND);
    } catch (\Exception $e) {
        $result .= $e->getMessage();
    }
    return $result;
}

/**
 * 获取日志信息
 * @param $command
 * @param $result
 * @return string
 */
function _getCommandLog($command, $result)
{
    $time = '['.date('Y-m-d H:i:s').']';
    $log  = $time.'[COMMAND] '.var_export($command, true)."\r\n";
    $log .= $time.'[EXEC] '.$result."\r\n";
    return $log;
}

/**
 * 根据类型获取命令
 * @param $type
 * @return array
 */
function _getCommand($type)
{
    switch ($type) {
        case 1:
            $params = _getLoadParams();
            if (isset($params['code'])) {
                return $params;
            }
            $command = [
                'cd '.CRON_DIR,
                COMMAND_PHP_THINK.' '.COMMAND_RESULT_LOAD.' '.
                $params['match_id'].' '.$params['score'].' '.$params['odds'],
            ];
            break;
        case 2:
            $command = [
                'cd '.CRON_DIR,
                COMMAND_PHP_THINK.' '.COMMAND_RRIZE_STAT,
            ];
            break;
        case 3:
            $command = [
                'cd '.CRON_API_DIR,
                COMMAND_PHP_THINK.' '.COMMAND_RRIZE_SEND,
            ];
            break;
        default:
            return ['code' => 103, 'info' => 'type must be in {1,2,3}'];
    }
    return $command;
}

/**
 * 获取录入结果参数
 * @return array
 */
function _getLoadParams()
{
    $matchId = _get('match_id');
    $score = _get('score');
    $odds = _get('odds') ? : 1;       // [!] 废弃，不再维护
    if ($matchId && $score && $odds) {
        return ['match_id'=> $matchId, 'score' => $score, 'odds' => $odds];
    } else {
        return ['code' => 102, 'info' => 'the result load params is uncomplete'];
    }
}

/**
 * 获取GET参数
 * @param $name
 * @return string
 */
function _get($name)
{
    return isset($_GET[$name]) ? $_GET[$name] : '';
}

/**
 * 错误返回
 * @param $code
 * @param $message
 */
function _error($code, $message)
{
    $error = ['code' => $code, 'info' => $message];
    return exit(json_encode($error));
}

/**
 * 打印调试信息
 * @param $var
 */
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
