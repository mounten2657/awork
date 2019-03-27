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
setTitle($config, '控制台数据');

// 控制台启动数
$row  = $db->query("SELECT * FROM `qc_stat_console_start`");
$list = getList($row);
$week  = getWeekData($list);
$month = getMonthData($list);

// 页面展示
$row  = $db->query("SELECT * FROM `qc_stat_console_page`");
$list = getList($row);
$weekPage  = getWeekData($list);
$monthPage = getMonthData($list);

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">
        <h4><strong>控制台启动数</strong></h4>
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
        <h4><strong>页面展示</strong></h4>
        <ul id="tabPage" class="nav nav-tabs">
            <li class="active">
                <a href="#monthPage" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekPage" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentPage" class="tab-content">
            <div class="tab-pane fade in active" id="monthPage">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>主页按钮点击次数</td>
                        <td>服务中心按钮点击次数</td>
                        <td>交班数据按钮点击次数</td>
                        <td>奖品派发按钮点击次数 </td>
                        <td>商品管理按钮点击次数</td>
                        <td>音乐点播按钮点击次数</td>
                        <td>扫码收款按钮点击次数</td>
                        <td>会员管理按钮点击次数</td>
                        <td>语音广播按钮点击次数</td>
                        <td>文字广播按钮点击次数</td>
                        <td>游戏数据按钮点击次数</td>
                        <td>云平台按钮点击次数</td>
                        <td>网吧留言点击数量</td>
                    </tr>
                    <?php
                    foreach ($monthPage as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekPage">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>主页按钮点击次数</td>
                        <td>服务中心按钮点击次数</td>
                        <td>交班数据按钮点击次数</td>
                        <td>奖品派发按钮点击次数 </td>
                        <td>商品管理按钮点击次数</td>
                        <td>音乐点播按钮点击次数</td>
                        <td>扫码收款按钮点击次数</td>
                        <td>会员管理按钮点击次数</td>
                        <td>语音广播按钮点击次数</td>
                        <td>文字广播按钮点击次数</td>
                        <td>游戏数据按钮点击次数</td>
                        <td>云平台按钮点击次数</td>
                        <td>网吧留言点击数量</td>
                    </tr>
                    <?php
                    foreach ($weekPage as $w) {
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

