<?php
/**
 * 自动登录
 * @author 李俊
 *
 */
class autoLogin{
	public $username;
	
	/**
	 * 从PC中的cookies中读取sid
	 * 用于客户端是电脑时
	 */
	function readSessionFromPC() {
		$sid=$_COOKIE[C('SID_COOKIE_NAME')];//读取cookies中的sid
		if ($sid) {
			session_id($sid);//设置将要启动的sid
			session_start();//启动session
		}
	}
	/**
	 * 从手机的url中读取sid
	 * 用于客户端是手机时
	 */
	function readSessionFromURL() {
		$sid=$_GET[C('SID_COOKIE_NAME')];//读取url中的sid；如page.do?xiu_sid=xxxxxxxxxx
		if ($sid) {
			session_id($sid);//设置将要启动的sid
			session_start();//启动session
		}
	}
	/**
	 * 获取用户信息，存储用户登录ip
	 * @return string 用户名
	 */
	function getInfo() {
		$username=$_SESSION['username'];
		if (!$username) {
			cookie('xiu_sid', null);//TODO
			session_destroy();
		}else {
			$this->username=$_SESSION['username'];
		}
		
		if ($this->username) {
			import('@.Yuol.writeLastLoginIp');
			writeLastLoginIp::GO($this->username);//存储用户登录ip信息
		}
		return $_SESSION['username'];//读取用户名
	}
	/**
	 * 从PC中的cookies中读取sid
	 * 用于客户端是电脑时
	 * @return string|null 返回用户名，若没有自动登录信息则返回null
	 */
	static function PC() {
		$s=new autoLogin();
		$s->readSessionFromPC();
		return $s->getInfo();
	}
	/**
	 * 从手机的url中读取sid
	 * 用于客户端是手机时
	 * @return string 返回用户名
	 */
	static function WAP(){
		$s=new autoLogin();
		$s->readSessionFromURL();
		return $s->getInfo();
	}
}