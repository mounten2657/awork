<?php
/**
 * Copyright (C) HangZhou TaShan Network Technology Co., Ltd.
 * All rights reserved.
 *
 * 版权所有 （C）杭州他山网络技术有限公司
 *
 * @copyright  Copyright (c) 2017 - 2017 (http://www.coobar.com)
 * @version    6.0
 * @author wujun 2019/01/17
 * @internal wujun
 */

// 读取配置
include '_function.php';
$config = include '_config.php';

// 连接数据库
$db = getDb($config['stat']);
setTitle($config, '在线情况曲线图');

// 账号使用情况
$row  = $db->query("SELECT * FROM `qc_stat_account_login`");
$list = getList($row);

// 整理数据
$statDate = array_column($list,'stat_time');
$statDate = array_map(function ($v) {return date('Y-m-d', $v);}, $statDate);
$netbarOnlineCnt = array_column($list,'netbar_online_cnt');
$vipNetbarOnlineCnt = array_column($list,'vip_netbar_online_cnt');
$clientAccountLoginCnt = array_column($list,'client_account_login_cnt');
$weixinAccountLoginCnt = array_column($list,'weixin_account_login_cnt');
$telAccountLoginCnt = array_column($list,'tel_account_login_cnt');

?>


<?php echo $config['head'];?>

<div class="container">

    <?php echo $config['menu'];?>

    <div class="row">

        <div data-statDate="<?php echo implode(',', $statDate);?>"></div>
        <div id="main" style="width: 1200px;height:800px;"></div>

        <script type="text/javascript">
            let chartStat = echarts.init(document.getElementById('main'));

            let option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross'
                    }
                },
                grid: {
                    top: 70,
                    bottom: 50
                },
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                legend: {
                    data:['网吧日均在线', 'VIP网吧日均在线', '客户端账号日均登陆', '日均微信登录', '日均手机登录']
                },
                xAxis: [
                    {
                        type: 'category',
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLine: {
                            onZero: false,
                            lineStyle: {
                                color: '#D14A61'
                            }
                        },
                        axisPointer: {
                            label: {
                                formatter: function (params) {
                                    return params.value;
                                }
                            }
                        },
                        data: <?php echo json_encode($statDate);?>
                    },
                    {
                        type: 'category',
                        axisTick: {
                            alignWithLabel: true
                        },
                        axisLine: {
                            onZero: false,
                            lineStyle: {
                                color: '#5793F3'
                            }
                        },
                        axisPointer: {
                            label: {
                                formatter: function (params) {
                                    return params.value;
                                }
                            }
                        },
                        data: <?php echo json_encode($statDate);?>
                    }
                ],
                series: [
                    {
                        name:'网吧日均在线',
                        type:'line',
                        smooth: true,
                        color: '#2894FF',
                        data: <?php echo json_encode($netbarOnlineCnt);?>
                    },
                    {
                        name:'VIP网吧日均在线',
                        type:'line',
                        xAxisIndex: 0,
                        smooth: true,
                        color: '#FF8C00',
                        data: <?php echo json_encode($vipNetbarOnlineCnt);?>
                    },
                    {
                        name:'客户端账号日均登陆',
                        type:'line',
                        smooth: true,
                        color: '#FFE153',
                        data: <?php echo json_encode($clientAccountLoginCnt);?>
                    },
                    {
                        name:'日均微信登录',
                        type:'line',
                        smooth: true,
                        color: '#20B2AA',
                        data: <?php echo json_encode($weixinAccountLoginCnt);?>
                    },
                    {
                        name:'日均手机登录',
                        type:'line',
                        smooth: true,
                        color: '#FF7575',
                        data: <?php echo json_encode($telAccountLoginCnt);?>
                    }
                ]
            };

            chartStat.setOption(option);
        </script>

    </div>

</div>

<?php echo $config['foot'];?>


