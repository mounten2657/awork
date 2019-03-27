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
setTitle($config, '账号注册和购买数据');

// 账号数量总览
$row  = $db->query("SELECT * FROM `qc_stat_account`");
$list = getList($row);
$week  = getAccountWeekData($list);
$month = getAccountMonthData($list);

// 账号使用情况
$row  = $db->query("SELECT * FROM `qc_stat_account_login`");
$list = getList($row);
$weekUse  = getUseAvgWeekData($list);
$monthUse = getUseAvgMonthData($list);

// 小白管家VIP网吧成交情况
$row  = $db->query("SELECT * FROM `qc_stat_vip_purchase`");
$list = getList($row);
$weekVip  = getWeekData($list);
$monthVip = getMonthData($list);

// 充值夺宝活动成交情况
$row  = $db->query("SELECT * FROM `qc_stat_snatch_purchase`");
$list = getList($row);
$weekSnatch  = getWeekData($list);
$monthSnatch = getMonthData($list);

// 网咖宝使用情况
$row  = $db->query("SELECT * FROM `qc_stat_netbar_jlpay`");
$list = getList($row);
$weekJlpay  = getWeekData($list);
$monthJlpay = getMonthData($list);

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">
        <h4><strong>账号数量总览</strong></h4>
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
                        <td>连锁账号总数</td>
                        <td>网吧账号总数</td>
                        <td>VIP网吧账号数</td>
                        <td>网咖宝客户数 </td>
                        <td>客户端账号总数</td>
                        <td>微信账号数</td>
                        <td>手机账号数</td>
                    </tr>

                    <?php foreach ($month as $val) :?>
                        <tr>
                            <?php foreach ($val as $v):?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
            <div class="tab-pane fade" id="week">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>连锁账号总数</td>
                        <td>网吧账号总数</td>
                        <td>VIP网吧账号数</td>
                        <td>网咖宝客户数 </td>
                        <td>客户端账号总数</td>
                        <td>微信账号数</td>
                        <td>手机账号数</td>
                    </tr>

                    <?php foreach ($week as $val) :?>
                        <tr>
                            <?php foreach ($val as $v):?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>账号使用情况</strong></h4>
        <ul id="tabUse" class="nav nav-tabs">
            <li class="active">
                <a href="#monthUse" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekUse" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentUse" class="tab-content">
            <div class="tab-pane fade in active" id="monthUse">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>网吧日均在线</td>
                        <td>VIP网吧日均在线</td>
                        <td>客户端账号日均登陆</td>
                        <td>日均微信登录 </td>
                        <td>日均手机登录</td>
                    </tr>

                    <?php foreach ($monthUse as $val) :?>
                        <tr>
                            <?php foreach ($val as $v):?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
            <div class="tab-pane fade" id="weekUse">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>网吧日均在线</td>
                        <td>VIP网吧日均在线</td>
                        <td>客户端账号日均登陆</td>
                        <td>日均微信登录 </td>
                        <td>日均手机登录</td>
                    </tr>

                    <?php foreach ($weekUse as $val) :?>
                        <tr>
                            <?php foreach ($val as $v):?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>小白管家VIP网吧成交情况</strong></h4>
        <ul id="tabVip" class="nav nav-tabs">
            <li class="active">
                <a href="#monthVip" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekVip" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentVip" class="tab-content">
            <div class="tab-pane fade in active" id="monthVip">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>购买成交网吧数</td>
                        <td>购买成交笔数</td>
                        <td>购买数量</td>
                        <td>成交金额 </td>
                    </tr>

                    <?php foreach ($monthVip as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['total_amount'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
            <div class="tab-pane fade" id="weekVip">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>购买成交网吧数</td>
                        <td>购买成交笔数</td>
                        <td>购买数量</td>
                        <td>成交金额 </td>
                    </tr>

                    <?php foreach ($weekVip as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['total_amount'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>充值夺宝活动成交情况</strong></h4>
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
                        <td>购买成交网吧数</td>
                        <td>购买成交笔数</td>
                        <td>购买数量</td>
                        <td>成交金额 </td>
                    </tr>

                    <?php foreach ($monthSnatch as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['total_amount'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
            <div class="tab-pane fade" id="weekSnatch">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>购买成交网吧数</td>
                        <td>购买成交笔数</td>
                        <td>购买数量</td>
                        <td>成交金额 </td>
                    </tr>

                    <?php foreach ($weekSnatch as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['total_amount'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <h4><strong>网咖宝使用情况</strong></h4>
        <ul id="tabJlpay" class="nav nav-tabs">
            <li class="active">
                <a href="#monthJlpay" data-toggle="tab">按月</a>
            </li>
            <li>
                <a href="#weekJlpay" data-toggle="tab">按周</a>
            </li>
        </ul>
        <div id="tabContentJlpay" class="tab-content">
            <div class="tab-pane fade in active" id="monthJlpay">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>交易笔数</td>
                        <td>交易金额 </td>
                    </tr>

                    <?php foreach ($monthJlpay as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['trade_money'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
            <div class="tab-pane fade" id="weekJlpay">
                <table class="table table-striped text-center">
                    <tr>
                        <td width="240px">日期</td>
                        <td>交易笔数</td>
                        <td>交易金额 </td>
                    </tr>

                    <?php foreach ($weekJlpay as $val) :?>
                        <tr>
                            <?php foreach ($val as $k => $v):?>
                                <?php if (in_array($k, ['trade_money'])) $v = formatYun($v);?>
                                <td><?php echo $v;?></td>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    </div>

</div>

<?php echo $config['foot'];?>

