<?php
/**
 * 生成登录状态条
 * 例如：在用户登陆前，处于未登录状态，则网页头登录区显示为“登录按钮”
 * 			在用户登录后，处于登录状态，则网页头登录区显示为“用户昵称”并连接至用户个人页面
 * @author 李俊
 *
 */
class loginState{
	public $username;
	public $nickname;//昵称
	public $userid;
	
	public function __construct($username){
		if ($username) {
			$this->username=$username;
			$tmp1=getData('user', array('usr_name'=>$username));
			$this->userid=$tmp1['usr_id'];//获取usr_id
			$tmp2=getData('user', array('usr_name'=>$username));
			$this->nickname=$tmp2['usr_nickname'];//获取usr_id
		}
	}
	
	public function crtLoginStateMsg() {
		if (!$this->username) {
			$str='<a class="login_btn" target="_self" title="登录">登录</a>';
		}else{
			$str='<a user="'.$this->userid.'" class="user_online" title="'.$this->nickname.'">'.$this->nickname.'(0)</a>|<a href="'.U("logout/index").'" class="logout">退出</a>';
		};
		return $str;
	}
	/**
	 * 工厂函数，生成loginState对象
	 * 作用：
	 * 生成登录状态条
	 * 例如：在用户登陆前，处于未登录状态，则网页头登录区显示为“登录按钮”
 	 * 			在用户登录后，处于登录状态，则网页头登录区显示为“用户昵称”并连接至用户个人页面
	 * @param string|null $username 用户名或空值
	 * @return string 登录状态信息html片段
	 */
	static public function GO($username){
		$ls=new loginState($username);
		return $ls->crtLoginStateMsg();
	}
}