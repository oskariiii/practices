<?php

# 创建UDP server对象,监听127.0.0.1:9502 , 类型为 SWOOLE_SOCK_UDP
$serv = new swoole_server('127.0.0.1',9502,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

# 监听数据接收事件
$serv->on('Packet',function($serv,$data,$clientInfo){
	$serv->sendto($clientInfo['address'],$clientInfo['port'],"Server ".$data);
	var_dump($clientInfo);
});

$serv->start();