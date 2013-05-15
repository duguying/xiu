<?php
/**
 * 用户session类
 * @author 李俊
 *@param string $sid session_id
 */
class Session {
	private  $sid;
	private  $username;
	private  $msg;
	
	function __construct() {
		$expire=C('USER_SESSION_TIME');
		if (!$expire) {
			$expire=0;
		}
		session(array('name'=>C('SID_COOKIE_NAME'),'expire'=>$expire));
		session('[start]');//启动session
		$this->sid=session_id();//保存session_id
		$this->username=session('username');
		if($this->username==null){
			cookie(C('SID_COOKIE_NAME'), null);
			$this->msg='用户会话已过期，请重新登录';
			session('[destroy]');//销毁自动创建的session
			session('[pause]');
		}
	}
	/**
	 * 初始化, 创建Session对象
	 */
	static public function init() {
		return new Session();
	}
	/**
	 * 种session和cookies会话
	 * @param string $username 用户名
	 */
	public function setSesion($username) {
		session('[start]');//启动session
		cookie(C('SID_COOKIE_NAME'), session_id(), C('USER_SESSION_TIME'));
		session('username', $username);
		$this->username=$username;
	}
	/**
	 * 获取客户端的sid加载sesion, 自动登录
	 * @return 数组:<string sid, string username, string msg>
	 */
	public function getSesion(){
		return array('sid'=>$this->sid, 'username'=>$this->username,'msg'=>$this->msg);
	}
	/**
	 * 销毁当前session会话
	 */
	public function destroySession(){
		session('[destroy]');
	}

}