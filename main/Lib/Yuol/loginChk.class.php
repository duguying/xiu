<?php
/**
 * 登录验证类
 * @author 李俊
 *
 */
class loginChk{
	/**
	 * 用户登录验证函数
	 * @param string $user 用户名
	 * @param string $psw 密码
	 */
	private function user($user,$psw) {
		$User = M("User");
		$psw=md5($psw);//密码进行md5加密
		$result=$User->where('usr_name="'.$user.'" and usr_psw="'.$psw.'"')->find();
		if ($result) {//用户登录成功
			$this->user_id=$result['usr_id'];
			$this->user_name=$result['usr_name'];
			$this->user_qq=$result['usr_qq'];
			$this->user_active_score=$result['usr_active_score'];
			$this->user_reg_time=$result['usr_reg_time'];
			$this->user_last_ip=$result['user_last_ip'];
			
			import('@.Yuol.writeLastLoginIp');
			writeLastLoginIp::GO($this->user_name);//存储用户登录ip信息
			import('@.Yuol.Session');
			Session::init()->setSesion($this->user_name);
			$this->userState=true;
			return $this->user_name.'登录成功';
		}else{
			return '登录失败';
		}
	}
	/**
	 * 实例化loginChk类，作用是用户登陆验证
	 * @param string $user 用户名
	 * @param string $psw 密码
	 * @return string 返回登录结果提示信息
	 */
	static function GO($user,$psw){
		$l=new loginChk();
		return $l->user($user, $psw);
	}
}