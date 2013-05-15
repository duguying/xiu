<?php
/**
 * 输出配置参数
 * @author 李俊
 *
 */
class conf{
	public $conf;
	
	function __construct() {
		$this->conf=array();
		$this->conf['root']=C('WWW_PATH');
		$this->conf['time']=date('Y-m-d H:i:s', time());
	}
	function usr_chk(){
		import('@.admin.C');
		$user=$_SESSION['admin'];
		import('@.admin.iplimit');
		if($user=='super'){
			$this->conf['user']=$user;
		}elseif (!iplimit::G(get_client_ip())||(!$user||($user==''))) {
			$user=null;
			header('location:'.C('WWW_PATH').'admin.php');
		}else{
			$this->conf['user']=$user;
		}
	}
	static function INDEX(){
		$c=new conf();
		return $c->conf;
	}
	static function CONTROL() {
		$c=new conf();
		$c->usr_chk();
		return $c->conf;
	}
	static function COMM() {
		$c=new conf();
		return $c->conf;
	}
}