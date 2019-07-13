<?php
# 连接TCP服务, 实例化TCP服务

$client = new swoole_client(SWOOLE_SOCK_TCP);

if(!$client->connect("127.0.0.1",9501)){
	echo "connect false!\n";
};

# php 内置 cli 常量下运作
# 输出字符串
fwrite(STDOUT, "type your message : ");
# 获取输入信息
$msg = trim(fgets(STDIN));
# 发送数据给TCPserver
$client->send($msg);
# 接收来自server的数据 客户端接收后send给client的数据
$result = $client->recv();
echo $result;
