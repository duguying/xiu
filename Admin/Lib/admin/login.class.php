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
		$this->db=M("admin");
	}
	/**
	 * 登录验证
	 * @param string $user 用户名
	 * @param string $psw 密码
	 * @return boolean 用户存在则返回true，否则返回false
	 */
	public function login($user,$psw) {
// 		$psw=md5($psw.'李俊');
		$r=$this->db->where(array("username"=>$user,"password"=>$psw))->find();//查找管理员用户
		
		if(supA($user,$psw)) {//超级管理员验证
			$_SESSION['admin']='super';
			return true;
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
}