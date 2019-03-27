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
setTitle($config, '举办活动数据');

// 幸运大转盘
$row  = $db->query("SELECT * FROM `qc_stat_spinwin`");
$list = getList($row);
$week  = getActivityOpenAvgData(getWeekData($list));
$month = getActivityOpenAvgData(getMonthData($list));

// 每日签到
$row  = $db->query("SELECT * FROM `qc_stat_sign`");
$list = getList($row);
$weekSign  = getActivityOpenAvgData(getWeekData($list));
$monthSign = getActivityOpenAvgData(getMonthData($list));

// 积分兑换
$row  = $db->query("SELECT * FROM `qc_stat_score`");
$list = getList($row);
$weekScore  = getActivityOpenAvgData(getWeekData($list));
$monthScore = getActivityOpenAvgData(getMonthData($list));

// 充值奖励
$row  = $db->query("SELECT * FROM `qc_stat_recharge`");
$list = getList($row);
$weekRecharge  = getActivityOpenAvgData(getWeekData($list));
$monthRecharge = getActivityOpenAvgData(getMonthData($list));

// 限时折扣
$row  = $db->query("SELECT * FROM `qc_stat_discount`");
$list = getList($row);
$weekDiscount  = getActivityOpenAvgData(getWeekData($list));
$monthDiscount = getActivityOpenAvgData(getMonthData($list));

// 充值夺宝
$row  = $db->query("SELECT * FROM `qc_stat_snatch`");
$list = getList($row);
$weekSnatch  = getActivityOpenAvgData(getWeekData($list));
$monthSnatch = getActivityOpenAvgData(getMonthData($list));

// 英雄联盟活动
$row  = $db->query("SELECT * FROM `qc_stat_lol`");
$list = getList($row);
$weekLol  = getActivityOpenAvgData(getWeekData($list));
$monthLol = getActivityOpenAvgData(getMonthData($list));

// 绝地求生活动
$row  = $db->query("SELECT * FROM `qc_stat_pubg`");
$list = getList($row);
$weekPubg  = getActivityOpenAvgData(getWeekData($list));
$monthPubg = getActivityOpenAvgData(getMonthData($list));

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">
        <h4><strong>幸运大转盘</strong></h4>
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
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
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
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
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
        <h4><strong>每日签到</strong></h4>
        <ul id="tabSign" class="nav nav-tabs">
            <li class="active">
                <a href="#monthSign" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekSign" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentSign" class="tab-content">
            <div class="tab-pane fade in active" id="monthSign">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($monthSign as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekSign">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($weekSign as $w) {
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
        <h4><strong>积分兑换</strong></h4>
        <ul id="tabScore" class="nav nav-tabs">
            <li class="active">
                <a href="#monthScore" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekScore" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentScore" class="tab-content">
            <div class="tab-pane fade in active" id="monthScore">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($monthScore as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekScore">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($weekScore as $w) {
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
        <h4><strong>充值奖励</strong></h4>
        <ul id="tabRecharge" class="nav nav-tabs">
            <li class="active">
                <a href="#monthRecharge" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekRecharge" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentRecharge" class="tab-content">
            <div class="tab-pane fade in active" id="monthRecharge">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($monthRecharge as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekRecharge">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($weekRecharge as $w) {
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
        <h4><strong>限时折扣</strong></h4>
        <ul id="tabDiscount" class="nav nav-tabs">
            <li class="active">
                <a href="#monthDiscount" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekDiscount" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentDiscount" class="tab-content">
            <div class="tab-pane fade in active" id="monthDiscount">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($monthDiscount as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekDiscount">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($weekDiscount as $w) {
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
        <h4><strong>充值夺宝</strong></h4>
        <ul id="tabSnatch" class="nav nav-tabs">
            <li class="active">
                <a href="#monthSnatch" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekSnatch" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentSnatch" class="tab-content">
            <div class="tab-pane fade in active" id="monthSnatch">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($monthSnatch as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekSnatch">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                        <td>参与人数</td>
                        <td>参与次数 </td>
                    </tr>
                    <?php
                    foreach ($weekSnatch as $w) {
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
        <h4><strong>英雄联盟活动</strong></h4>
        <ul id="tabLol" class="nav nav-tabs">
            <li class="active">
                <a href="#monthLol" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekLol" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentLol" class="tab-content">
            <div class="tab-pane fade in active" id="monthLol">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                    </tr>
                    <?php
                    foreach ($monthLol as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekLol">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                    </tr>
                    <?php
                    foreach ($weekLol as $w) {
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
        <h4><strong>绝地求生活动</strong></h4>
        <ul id="tabPubg" class="nav nav-tabs">
            <li class="active">
                <a href="#monthPubg" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekPubg" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentPubg" class="tab-content">
            <div class="tab-pane fade in active" id="monthPubg">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                    </tr>
                    <?php
                    foreach ($monthPubg as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekPubg">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>日均开启网吧数</td>
                        <td>页面展示量（PV）</td>
                    </tr>
                    <?php
                    foreach ($weekPubg as $w) {
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

