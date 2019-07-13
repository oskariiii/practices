<?php

$server = new swoole_websocket_server('0.0.0.0',9501);

/*$server->on('open',function($server,$request){
	echo "server: handshake success with fd:{$request->fd}\n";
});*/

# 配置开启静态页面访问
$server->set([
	'enable_static_handler' => true,
	# 静态资源默认存放路径
	'document_root'			=> "/home/www/default/static",
]);


# 监听websocket打开事件
$server->on('open','onOpen');

function onOpen($server,$request){
	print_r("client ".$request->fd." has connected!\n");
}

# 必需的回调函数, 监听websocket消息事件
$server->on('message',function($server, $frame){
	echo "receive from {$frame->fd} : {$frame->data}, opcode:{$frame->opcode},fin: {$frame->finish}\n";
	$server->push($frame->fd," ws_server push success!");
});

$server->on('close',function($server,$fd){
	echo "client {$fd} closed! \n";
});

$server->start();