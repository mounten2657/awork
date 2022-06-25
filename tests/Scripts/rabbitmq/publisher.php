<?php
/**
 * Created by PhpStorm.
 * User: jmsite.cn
 * Date: 2019/1/15
 * Time: 13:15
 */
$config = array(
    'host' => '192.168.150.128',
    'vhost' => '/',
    'port' => 5672,
    'login' => 'amqp',
    'password' => '123456',
);
$config2 = array(
    'host' => '120.55.53.162',
    'vhost' => '/',
    'port' => 5672,
    'login' => 'message_pack',
    'password' => 'PspQESaErnsp8NJGNpxEvg',
);
$cnn = new AMQPConnection($config);
try {
    if (!$cnn->connect()) {
        echo "Cannot connect to the broker";
        exit();
    }
} catch (\Exception $e) {
    var_dump($e->getMessage());
    die;
}

$ch = new AMQPChannel($cnn);
$ex = new AMQPExchange($ch);
//消息的路由键，一定要和消费者端一致
$routingKey = 'key_1';
//交换机名称，一定要和消费者端一致，
$exchangeName = 'exchange_1';
$ex->setName($exchangeName);
$ex->setType(AMQP_EX_TYPE_DIRECT);
$ex->setFlags(AMQP_DURABLE);
$ex->declareExchange();
//创建10个消息
for ($i=1;$i<=10;$i++){
    //消息内容
    $msg = array(
        'data'  => 'message_'.($i + time()),
        'hello' => 'world',
    );
    //发送消息到交换机，并返回发送结果
    //delivery_mode:2声明消息持久，持久的队列+持久的消息在RabbitMQ重启后才不会丢失
    $res = $ex->publish(json_encode($msg), $routingKey, AMQP_NOPARAM, array('delivery_mode' => 2));
    echo "Send Message:".json_encode(['data' => $msg, 'result' => $res])."\n";
    //代码执行完毕后进程会自动退出
}