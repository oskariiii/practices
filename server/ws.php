<?php
# ws 优化 基础类库

class Ws{
	CONST HOST = '0.0.0.0';
	CONST PORT = '9501';
	public $ws = null;
	public function __construct(){
		$this->ws = new swoole_websocket_server(self::HOST,self::PORT);
		# 配置开启静态页面访问
		$this->ws->set([
			'enable_static_handler' => true,
			# 静态资源默认存放路径
			'document_root'			=> "/home/www/default/static",
			'worker_num'			=> 2,
			'task_worker_num'		=> 2,
		]);
		$this->ws->on('open',[$this,'onOpen']);
		$this->ws->on('message',[$this,'onMessage']);
		$this->ws->on('task',[$this,'onTask']);
		$this->ws->on('finish',[$this,'onFinish']);
		$this->ws->on('close',[$this,'onClose']);
		$this->ws->start();
	}

	/*
	 * 监听ws 连接事件
	 * @param $ws 
	 * @param $request
	 */
	public function onOpen($ws, $request){
		print_r("client ".$request->fd." has connected!  message from server!\n");
	}

	/*
	 * 监听ws message事件
	 * @param $ws 
	 * @param $frame
	 */
	public function onMessage($ws, $frame){
		# 接收客户端信息
		echo "receive from client fd: {$frame->fd} on message: {$frame->data}\n";
		# 执行一些代码逻辑
		$data = ['task'=>1,'fd'=>$frame->fd];
		# 投放异步任务
		$ws->task($data);
		# 推送信息给客户端
		$ws->push($frame->fd," ws_server push:".$frame->data." ".date("Y-m-d H:i:s")." message from serve!");
	}

	/*
	 * @param $serv 	swoole服务对象
	 * @param $taskId 	任务ID
	 * @param $workerId	来自于哪个worker进程
	 * @param $data 	任务的内容
	 */
	public function onTask($serv,$task_id,$worker_id,$data){
		$data['time']=date("Y-m-d H:i:s");
		echo json_encode($data)."\n";
		sleep(10);
		# 模拟耗时场景
		return "On task has been finished!";
	}

	/*
	 * @param $serv 	swoole服务对象
	 * @param $taskId 	任务ID
	 * @param $data 	onTask return的内容,并不是onTask里面的$data
	 */
	public function onFinish($serv,$task_id,$data){
		echo "taskId:{$task_id}\n";
		echo "finish-data-success:{$data}\n";
	}

	/*
	 * 监听ws close事件
	 * @param $ws 
	 * @param $fd
	 */
	public function onClose($ws,$fd){
		echo "client {$fd} has been closed! \n";
	}
}

$obj = new Ws();