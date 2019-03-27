<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/01/16
 * @internal wujun
 */

date_default_timezone_set('PRC');
header("Content-type:text/html;charset=utf-8");

/**
 * 获取数据连接
 * @param $dbConfig
 * @return PDO
 */
function getDb($dbConfig)
{
    try {
        $db = new PDO("mysql:host={$dbConfig['hostname']};dbname={$dbConfig['database']}", $dbConfig['username'], $dbConfig['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $db->exec("set names 'utf8'");
    } catch (PDOException $e) {
        die("数据库连接失败：" . $e->getMessage());
    }
    return $db;
}

/**
 * 打印输出
 * @param $var
 */
function dump($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

/**
 * 获取数据列表
 * @param PDOStatement $row
 * @return array
 */
function getList(PDOStatement $row)
{
    $list = [];
    while ($temp = $row->fetch(PDO::FETCH_ASSOC)) {
        $list[] = $temp;
    }
    return $list;
}

/**
 * 获取字段列表
 * @param $list
 * @return array
 */
function getFieldList($list)
{
    $fieldList = array_keys($list[0]);
    $fieldList = array_diff($fieldList, ['id', 'stat_time', 'update_time', 'create_time', 'is_deleted']);
    return $fieldList;
}

/**
 * 获取周数据
 * @param $list
 * @param $isParam
 * @return array
 */
function getWeekData($list, $isParam = false)
{
    $i = 0;
    $weekList = $week = [];
    foreach ($list as $info) {
        $nWeek = date('w', $info['stat_time']);
        $weekList[$i][] = $info;
        if ($nWeek == 0) {
            $i ++;
        }
    }
    if ($isParam) {
        return $weekList;
    }
    return getStatData($weekList, $list);
}

/**
 * 获取月数据
 * @param $list
 * @param $isParam
 * @return array
 */
function getMonthData($list, $isParam = false)
{
    $i = 0;
    $monthList = $month = [];
    foreach ($list as $info) {
        $nMonth = date('Y-m', $info['stat_time']);
        $eMonth = isset($monthList[$i]) ? end($monthList[$i]) : [];
        if ($eMonth && $nMonth > date('Y-m', $eMonth['stat_time'])) {
            $i ++;
        }
        $monthList[$i][] = $info;
    }
    if ($isParam) {
        return $monthList;
    }
    return getStatData($monthList, $list);
}

/**
 * 获取统计数据
 * @param $statList
 * @param $list
 * @return array
 */
function getStatData($statList, $list)
{
    $stat = [];
    $fieldList = getFieldList($list);
    foreach ($statList as $k => $v) {
        $end = end($v);
        $stat[$k]['date'] = date('Y-m-d', $v[0]['stat_time']).' ~ '. date('Y-m-d', $end['stat_time']);
        foreach ($fieldList as $field) {
            $stat[$k][$field] = array_sum(array_column($v, $field));
        }
    }
    array_multisort(array_column($stat, 'date'), SORT_DESC, $stat);
    return $stat;
}

/**
 * 获取账号数量周数据
 * @param $list
 * @return array
 */
function getAccountWeekData($list)
{
    $stat = [];
    $fieldList = getFieldList($list);
    $weekList = getWeekData($list, true);
    foreach ($weekList as $k => $v) {
        $end = end($v);
        $stat[$k]['date'] = '截至 '. date('Y-m-d', $end['stat_time']);
        foreach ($fieldList as $field) {
            $stat[$k][$field] = $end[$field];
        }
    }
    array_multisort(array_column($stat, 'date'), SORT_DESC, $stat);
    return $stat;
}

/**
 * 获取账号数量月数据
 * @param $list
 * @return array
 */
function getAccountMonthData($list)
{
    $stat = [];
    $fieldList = getFieldList($list);
    $monthList = getMonthData($list, true);
    foreach ($monthList as $k => $v) {
        $end = end($v);
        $stat[$k]['date'] = '截至 '. date('Y-m-d', $end['stat_time']);
        foreach ($fieldList as $field) {
            $stat[$k][$field] = $end[$field];
        }
    }
    array_multisort(array_column($stat, 'date'), SORT_DESC, $stat);
    return $stat;
}

/**
 * 获取账号使用周数据
 * @param $list
 * @return array
 */
function getUseAvgWeekData($list)
{
    $stat = [];
    $fieldList = getFieldList($list);
    $weekList = getWeekData($list, true);
    foreach ($weekList as $k => $v) {
        $end = end($v);
        $stat[$k]['date'] = date('Y-m-d', $v[0]['stat_time']).' ~ '. date('Y-m-d', $end['stat_time']);
        foreach ($fieldList as $field) {
            $stat[$k][$field] = round(array_sum(array_column($v, $field))/count($v), 2);
        }
    }
    array_multisort(array_column($stat, 'date'), SORT_DESC, $stat);
    return $stat;
}

/**
 * 获取账号使用月数据
 * @param $list
 * @return array
 */
function getUseAvgMonthData($list)
{
    $stat = [];
    $fieldList = getFieldList($list);
    $monthList = getMonthData($list, true);
    foreach ($monthList as $k => $v) {
        $end = end($v);
        $stat[$k]['date'] = date('Y-m', $end['stat_time']);
        foreach ($fieldList as $field) {
            $stat[$k][$field] = round(array_sum(array_column($v, $field))/count($v), 2);
        }
    }
    array_multisort(array_column($stat, 'date'), SORT_DESC, $stat);
    return $stat;
}

/**
 * 获取活动日均开启数据
 * @param $list
 * @param $field
 * @return mixed
 */
function getActivityOpenAvgData($list, $field = 'open_cnt')
{
    foreach ($list as $key => &$value)
    {
        $dayAry = explode('~', $value['date']);
        $days = (abs(strtotime($dayAry[1]) - strtotime($dayAry[0])))/86400 + 1;
        foreach ($value as $k => &$v) {
            if ($field == $k) {
                $v = round($v/$days, 2);
            }
        }
    }
    return $list;
}

/**
 * 格式化金额元
 * @param $num
 * @return string
 */
function formatYun($num)
{
    return sprintf('%.2f', floatval($num/100));
}

/**
 * 设置网页标题
 * @param $config
 * @param $title
 * @return mixed
 */
function setTitle(&$config, $title)
{
    $config['head'] = str_replace('__TITLE__', $title, $config['head']);
    return $config['head'];
}
