<?php

// 日志路径
define('LOG_PATH','./log6.coobar.cn.access.log');
// 事件列表
define('EVENT_RCM', 'client/msgcenterrcm');
define('EVENT_BTN', 'client/msgcenterbtn');
// 版本
define('VERSION', '6.0.0');
// 记录开始运行时间
$startRunTime = microtime(true);

// 开始日期
$startDate  = isset($_GET['start_time']) ? $_GET['start_time'] : date('Y-m-d', time() - 6 * 86400);
// 检索天数
$dateNum = isset($_GET['date_num']) ? $_GET['date_num'] : 7;
// 开始行数（手动选择行数，减少检索行数，提高效率）
$startLine = isset($_GET['start_line']) ? $_GET['start_line'] : 1;

// 读取日志内容
$content = _getContentByDate(LOG_PATH, $startDate, $dateNum, $startLine);
read_log6_dump('start line: '.substr($content[0], 0 , 48));
read_log6_dump('end line: '.substr(end($content), 0 , 48));
// 获取统计数据
$stat = _getStatData($content);

// 信息输出
read_log6_dump('统计日期：'.date('d/M/Y', strtotime($startDate)).'---'.date('d/M/Y', strtotime($startDate) + $dateNum * 86400 -1));
read_log6_dump('点击按钮总数：'.$stat[EVENT_BTN]['total_count']);
read_log6_dump('点击推荐消息总数：'.$stat[EVENT_RCM]['total_count']);
read_log6_dump('点击推荐消息详情：');
foreach ($stat[EVENT_RCM]['group_data'] as $name => $value) {
    read_log6_dump("|---推荐消息ID：{$name}，点击数：{$value}");
}

// 查看运行时间
$endRunTime = microtime(true);
read_log6_dump("run time: ".round($endRunTime - $startRunTime, 8) ."s");

/*================================== 函数区 =====================================*/

/**
 * 获取统计数据
 * @param $data
 * @return array
 */
function _getStatData($data)
{
    $stat = [];
    $pattern = [
        EVENT_RCM => '/'.EVENT_RCM.'?v='.VERSION,
        EVENT_BTN => '/'.EVENT_BTN.'?v='.VERSION,
    ];
    foreach ($data as $request) {
        foreach ($pattern as $type => $p) {
            if ($match = strstr($request, $p)) {
                if (isset($stat[$type]['total_count'])) {
                    $stat[$type]['total_count'] ++;
                } else {
                    $stat[$type]['total_count'] = 1;
                }
                $params = _getParams($match);
                if (EVENT_RCM == $type) {
                    if (isset($params['tpl_id'])) {
                        if (isset($stat[$type]['group_data'][$params['tpl_id']])) {
                            $stat[$type]['group_data'][$params['tpl_id']] ++;
                        } else {
                            $stat[$type]['group_data'][$params['tpl_id']] = 1;
                        }
                    }
                }
            }
        }
    }
    return $stat;
}

/**
 * 解析参数
 * @param $match
 * @return mixed
 */
function _getParams($match)
{
    $params = strstr($match, 'HTTP/1.1', true);
    $params = strstr($params, '&params=');
    $params = substr($params, 8 , -1);
    $params = str_replace('\\x22', '"', $params);
    $params = urldecode($params);
    return json_decode($params, true);
}

/**
 * 根据行号获取日志内容
 * @param $path
 * @param $line
 * @return array|bool
 */
function _getContentByLine($path, $line)
{
    $content = file($path);
    array_splice($content, 0, $line -1);
    return $content;
}

/**
 * 根据日期去获取内容
 * @param $path
 * @param $date
 * @param $num
 * @param $line
 * @return array|bool
 */
function _getContentByDate($path, $date, $num, $line = 1)
{
    // the record log should be exist every day
    $start = date('d/M/Y', strtotime($date));
    $end = date('d/M/Y', strtotime($date) + $num * 86400 + 1);
    $content = _getContentByLine($path, $line);
    $statLine = _getLineByDate($content, $start);
    $endLine = _getLineByDate($content, $end);
    return array_slice($content, $statLine, ($endLine - $statLine   ));
}

/**
 * 获取开始行号
 * @param $content
 * @param $date
 * @return int|string
 */
function _getLineByDate($content, $date)
{
    $line = 1;
    foreach ($content as $line => $txt) {
        if (strpos($txt, '- - ['.$date)) {
            break;
        }
    }
    return $line;
}

/**
 * 打印调试信息
 * @param $var
 */
function read_log6_dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}