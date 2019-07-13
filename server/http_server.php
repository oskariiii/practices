<?php
$http = new swoole_http_server('0.0.0.0',8811);

# 配置开启静态页面访问
$http->set([
	'enable_static_handler' => true,
	# 静态资源默认存放路径
	'document_root'			=> "/home/www/default/static",
]);

$http->on('request',function($request,$response){
	$response->cookie('singwa','xssssss',time()+1800);
	$response->end(json_encode($request->get)."\n");
});

$http->start();