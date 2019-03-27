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

// 读取配置
include '_function.php';
$config = include '_config.php';

// 连接数据库
$db = getDb($config['stat']);
setTitle($config, '客户端数据');

// 客户端启动数
$row  = $db->query("SELECT * FROM `qc_stat_client_start`");
$list = getList($row);
$week  = getWeekData($list);
$month = getMonthData($list);

// 客户端首页点击数
$row  = $db->query("SELECT * FROM `qc_stat_client_index`");
$list = getList($row);
$weekIndex  = getWeekData($list);
$monthIndex = getMonthData($list);

// 客户端获奖弹窗
$row  = $db->query("SELECT * FROM `qc_stat_client_prize`");
$list = getList($row);
$weekPrize  = getWeekData($list);
$monthPrize = getMonthData($list);

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">
        <h4><strong>客户端启动数</strong></h4>
        <ul id="tabStat" class="nav nav-tabs">
            <li class="active">
                <a href="#month" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#week" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="TabContentStat" class="tab-content">
            <div class="tab-pane fade in active" id="month">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均启动数</td>
                    </tr>
                    <?php
                    foreach ($month as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="week">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均启动数</td>
                    </tr>
                    <?php
                    foreach ($week as $w) {
                        echo "<tr>";
                        foreach ($w as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>客户端首页点击数</strong></h4>
        <ul id="tabIndex" class="nav nav-tabs">
            <li class="active">
                <a href="#monthIndex" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekIndex" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentIndex" class="tab-content">
            <div class="tab-pane fade in active" id="monthIndex">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>呼叫网管按钮点击次数</td>
                        <td>网费充值按钮点击次数</td>
                        <td>商品点购按钮点击次数</td>
                        <td>活动中心按钮点击次数 </td>
                        <td>活动轮播按钮点击次数</td>
                        <td>猜你喜欢按钮点击次数</td>
                        <td>大家都在买按钮点击次数</td>
                    </tr>
                    <?php
                    foreach ($monthIndex as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekIndex">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>呼叫网管按钮点击次数</td>
                        <td>网费充值按钮点击次数</td>
                        <td>商品点购按钮点击次数</td>
                        <td>活动中心按钮点击次数 </td>
                        <td>活动轮播按钮点击次数</td>
                        <td>猜你喜欢按钮点击次数</td>
                        <td>大家都在买按钮点击次数</td>
                    </tr>
                    <?php
                    foreach ($weekIndex as $w) {
                        echo "<tr>";
                        foreach ($w as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>客户端获奖弹窗</strong></h4>
        <ul id="tabPrize" class="nav nav-tabs">
            <li class="active">
                <a href="#monthPrize" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekPrize" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentPrize" class="tab-content">
            <div class="tab-pane fade in active" id="monthPrize">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>点击次数</td>
                    </tr>
                    <?php
                    foreach ($monthPrize as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekPrize">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>点击次数</td>
                    </tr>
                    <?php
                    foreach ($weekPrize as $w) {
                        echo "<tr>";
                        foreach ($w as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</div>

<?php echo $config['foot'];?>

