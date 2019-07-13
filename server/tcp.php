<?php

# 创建server对象, 监听 9501 端口
# 扩展: netstat -anp | grep 9501
$serv = new swoole_server('127.0.0.1',9501);

# 绑定参数
$serv->set([
	'worker_num'	=> 4, # worker 进程数,建议设置CPU核数的1-4倍
	'max_request'	=> 10000, # 每个worker进程允许处理的最大任务数
]);

# 监听连接进入事件
/*
 * $fd 		客户端连接服务端的唯一标识, 类似于ID.
 * $reactor_id	线程ID
 */
$serv->on('connect',function($serv,$fd, $from_id){
	echo "Client: {$from_id} - {$fd} Connect! \n";
});

# 监听数据连接事件,服务端接受到的数据发送给指定$fd客户端
$serv->on('receive',function($serv,$fd,$from_id,$data){
	$serv->send($fd, "Server : {$from_id} - {$fd} ".$data."\n");
});

# 监听连接关闭事件
$serv->on('close',function($serv,$fd){
	echo "Client: closed! \n";
});

# 启动服务
$serv->start();