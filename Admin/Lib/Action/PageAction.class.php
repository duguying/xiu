<?php
class PageAction extends Action {
	///aixuanxiu/admin.php/p/test
	function _initialize() {
		import('@.admin.conf');
		$config=conf::COMM();
		$this->assign('config', $config);
	}
	function welcome(){
// 		$this->assign();
		$this->display('./Admin/Tpl/welcome.html');
	}
	
	function phpinf(){
		define('ADMIN_ALLOW',true);
		import('@.tz.tz');
	}
	
	function setting() {
		import('@.admin.CConf');
		$str=CConf::C('main');
		import('@.admin.cleanSession');
		try {
			$app_config=cleanSession::ISABLE();
		} catch (Exception $e) {
		}
		if (!$app_config['SESSION_PATH']) {
			$app_config['SESSION_PATH']='disabled="disabled"';
		}
		$this->assign('content', $str);
		$this->assign('app_config', $app_config);

		$this->display('./Admin/Tpl/sys_config.html');
	}
	
	function save_config_file() {
		$content=$_POST['content'];
		if ($content==null) {
			$this->ajaxReturn(false);
		}else {
			import('@.admin.CConf');
			$result=CConf::C('main', $content);
			if($result){
				echo $result;
			}
		}
	}
	function reset_config() {
		$default_config=file_get_contents('./Admin/data/config.php.setting');
		import('@.admin.CConf');
		$result=CConf::C('main', $default_config);
		echo $default_config;
		header("Content-type:text/plain;charset=utf-8");
	}
	function clean_cache() {
		import('@.admin.cleanCache');
		try {
			$r=cleanCache::GO('main');
			$result=array('result'=>$r);
		} catch (Exception $e) {
			$result=array('result'=>false, 'msg'=>$e->getMessage());
		}
		$this->ajaxReturn($result);
	}
	function clean_session() {
		import('@.admin.cleanSession');
		$result=cleanSession::GO();
		try{
			$r=cleanSession::GO();
			$result=array('result'=>$r);
		} catch (Exception $e) {
			$result=array('result'=>false, 'msg'=>$e->getMessage());
		}
		$this->ajaxReturn($result);
	}
}