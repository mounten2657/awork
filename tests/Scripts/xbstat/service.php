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
setTitle($config, '服务功能数据');

// 呼叫网管
$row  = $db->query("SELECT * FROM `qc_stat_call`");
$list = getList($row);
$week  = getWeekData($list);
$month = getMonthData($list);

// 网费充值
$row  = $db->query("SELECT * FROM `qc_stat_netfee`");
$list = getList($row);
$weekNetfee  = getWeekData($list);
$monthNetfee = getMonthData($list);

// 商品点购
$row  = $db->query("SELECT * FROM `qc_stat_shop`");
$list = getList($row);
$weekShop  = getWeekData($list);
$monthShop = getMonthData($list);

// 音乐点播
$row  = $db->query("SELECT * FROM `qc_stat_music`");
$list = getList($row);
$weekMusic  = getWeekData($list);
$monthMusic = getMonthData($list);

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">
        <h4><strong>呼叫网管</strong></h4>
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
                        <td>页面展示PV量</td>
                        <td>呼叫次数</td>
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
                        <td>页面展示PV量</td>
                        <td>呼叫次数</td>
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
        <h4><strong>网费充值</strong></h4>
        <ul id="tabNetfee" class="nav nav-tabs">
            <li class="active">
                <a href="#monthNetfee" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekNetfee" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentNetfee" class="tab-content">
            <div class="tab-pane fade in active" id="monthNetfee">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>在线支付笔数</td>
                        <td>在线支付金额 </td>
                        <td>现金支付笔数</td>
                        <td>现金支付金额</td>
                    </tr>
                    <?php
                    foreach ($monthNetfee as $m) {
                        echo "<tr>";
                        foreach ($m as $k => $v) {
                            if (in_array($k, ['online_pay_amount', 'cash_pay_amount'])) {
                                $v = formatYun($v);
                            }
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekNetfee">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>在线支付笔数</td>
                        <td>在线支付金额 </td>
                        <td>现金支付笔数</td>
                        <td>现金支付金额</td>
                    </tr>
                    <?php
                    foreach ($weekNetfee as $w) {
                        echo "<tr>";
                        foreach ($w as $k => $v) {
                            if (in_array($k, ['online_pay_amount', 'cash_pay_amount'])) {
                                $v = formatYun($v);
                            }
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
        <h4><strong>商品点购</strong></h4>
        <ul id="tabShop" class="nav nav-tabs">
            <li class="active">
                <a href="#monthShop" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekShop" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentShop" class="tab-content">
            <div class="tab-pane fade in active" id="monthShop">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>在线支付笔数</td>
                        <td>在线支付金额 </td>
                        <td>现金支付笔数</td>
                        <td>现金支付金额</td>
                    </tr>
                    <?php
                    foreach ($monthShop as $m) {
                        echo "<tr>";
                        foreach ($m as $k => $v) {
                            if (in_array($k, ['online_pay_amount', 'cash_pay_amount'])) {
                                $v = formatYun($v);
                            }
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekShop">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>在线支付笔数</td>
                        <td>在线支付金额 </td>
                        <td>现金支付笔数</td>
                        <td>现金支付金额</td>
                    </tr>
                    <?php
                    foreach ($weekShop as $w) {
                        echo "<tr>";
                        foreach ($w as $k => $v) {
                            if (in_array($k, ['online_pay_amount', 'cash_pay_amount'])) {
                                $v = formatYun($v);
                            }
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
        <h4><strong>音乐点播</strong></h4>
        <ul id="tabMusic" class="nav nav-tabs">
            <li class="active">
                <a href="#monthMusic" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekMusic" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentUse" class="tab-content">
            <div class="tab-pane fade in active" id="monthMusic">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>点歌次数</td>
                        <td>置顶次数 </td>
                    </tr>
                    <?php
                    foreach ($monthMusic as $m) {
                        echo "<tr>";
                        foreach ($m as $v) {
                            echo "<td>{$v}</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="weekMusic">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>页面展示PV量</td>
                        <td>日均开启网吧数</td>
                        <td>点歌次数</td>
                        <td>置顶次数 </td>
                    </tr>
                    <?php
                    foreach ($weekMusic as $w) {
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
