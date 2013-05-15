<?php
class IndexAction extends Action {
	public $tagClass=array();
	public $tagsUrl=array();
	public $username;
	public $user_id;
	
	public function __construct(){
		import('@.admin.C');
		if(true==C::G('iplimit')){//开启了IP限制
			import('@.admin.iplimit');
			$ip = get_client_ip();
			if(!iplimit::G($ip)){//判断是否被限制
				$this->assign('msg', M_show(1, "注意，您当前IP：{$ip}是<font color=\'red\'>被限制登录</font>的！"));
			};
		}
	}
	
	function index() {
		import('@.admin.conf');
		$this->assign('config', conf::INDEX());
		$this->display('./Admin/Tpl/index.html');
	}
	function login() {
		import('@.admin.login');
		$result=login::GO()->login($_POST['user'],$_POST['pass']);
		if($result){
			header('location:'.U('control/index'));
		}else{
			$this->show('登录失败！');
		}
	}
	public function test1() {
		var_dump(ls('/'));
	}
}