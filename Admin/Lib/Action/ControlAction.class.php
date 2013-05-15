<?php
/**
 * 控制面板
 * @author Administrator
 *
 */
class ControlAction extends Action{
	
	function __construct() {
		import('@.admin.conf');
		$config=conf::CONTROL();
		$this->assign('config', $config);
	}
	function index(){
		$this->assign('ip', get_client_ip());
		$this->display('./Admin/Tpl/index.frame.html');
	}
	function logout(){
		session_destroy();
		header('location:'.C('WWW_PATH').'admin.php');
	}
	function time() {
		$this->ajaxReturn(date('Y-m-d H:i:s', time()));
	}
	
}