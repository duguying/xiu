<?php
class LogoutAction extends Action {
	
	function __construct() {
		chkUpdate();
	}
	/**
	 * 登出功能
	 */
	public function index() {
		if (hostOnly()) {//来自本站则执行，够则重定向到主页
			session_id(cookie('xiu_sid'));
			session_start();
			session_destroy();
			session('[pause]');
			session_id(cookie('PHPSESSID'));
			session_start();
			session_destroy();
			session_destroy();
			cookie('xiu_sid', null);
			cookie('PHPSESSID', null);
			session("[pause]");
			header("Location:".$_SERVER['HTTP_REFERER']);//重定向到来的页面
		}else{
			header("Location:".C('WWW_PATH'));//重定向到主页
		}
	}
}