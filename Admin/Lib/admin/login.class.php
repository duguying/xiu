<?php
/**
 * 登录验证类
 * @author 李俊
 *
 */
class login{
	public $db;
	static public function GO(){
		return new login();
	}
	public function __construct(){
		import('@.admin.Sqlite');
		$this->db=Sqlite::GO(C('DB'));
		$num=$this->db->query("SELECT count(*) as num FROM sqlite_master WHERE type='table' AND name='user'");//check whether the table exist
		$num=$num[0]['num'];
		if(!$num){//if not exist, create it
			$this->db->query('CREATE TABLE user (name varchar(10), password varchar(50))');
		}
	}
	/**
	 * 登录验证
	 * @param string $user 用户名
	 * @param string $psw 密码
	 * @return boolean 用户存在则返回true，否则返回false
	 */
	public function login($user,$psw) {
		$user=addcslashes($user, '"\\/');
		$psw=addcslashes($psw, '"\\/');
		$psw=md5($psw.'李俊');
		$r=$this->db->query('select name from user where name="'.$user.'"and password="'.$psw.'"');
		import('@.admin.iplimit');
		if(supA()) {
			$_SESSION['admin']='super';
			return true;
		}elseif (iplimit::G(get_client_ip())){
			header('location:'.C('WWW_PATH').'admin.php');
		}elseif ($r[0]) {
			$_SESSION['admin']=$r[0]['name'];
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 获取当前用户
	 * @return string|null 用户登录则为用户名，否则返回null
	 */
	function chk(){
		return $_SESSION['admin'];
	}
	/**
	 * 添加用户
	 * @param string $user 用户名
	 * @param string $psw 密码
	 * @throws Exception 用户已经存在或为super时抛出异常
	 * @return multitype:执行结果
	 */
	function add($user,$psw) {
		$user=addcslashes($user, '"\\/');
		$psw=addcslashes($psw, '"\\/');
		if ($user=='super') {
			throw new Exception('此用户名被系统保留！');
		}
		$r=$this->db->query('select * from user where name="'.$user.'"');
		if($r[0]){
			throw new Exception('用户已经存在！');
		}else{
			$psw=md5($psw.'李俊');
			$rst=$this->db->query('INSERT INTO user(name, password) VALUES("'.$user.'","'.$psw.'")');
			return $rst;
		}
	}
}