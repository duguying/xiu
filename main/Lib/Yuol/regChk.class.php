<?php
/**
 * 注册表单数据预处理 
 * 验证用户名username,邮箱mail,验证码yanz是否合格
 * @author 李俊
 *
 */
class regChk{
	
	/**
	 * 序列化检测的总控函数
	 * @param array $post 此处应当传入来自表单的$_POST
	 * @return boolean 检测(匹配)结果
	 */
	function chk($post) {//$post是传入的$_POST数据
		$mail=$post['mail'];//唯一
		$username=$post['username'];//唯一
		$yanz=$post['yanz'];

		if($this->chkyanz($yanz)&&$this->chkmail($mail)&&$this->usernamechk($username)){//检查3项都合格才通过
			return true;
		}else{
			return false;
		};
		
	}
	/**
	 * 检查验证码
	 * @param string $yanz 初始未经md5加密的验证码
	 * @return boolean 若不匹配就返回false
	 */
	private function chkyanz($yanz) {//检查验证码
		session_start();//打开session
		if($_SESSION['verify'] != md5($yanz)) {
			FFDEBUG('验证码错误！');
			return false;
		}elseif (time()-(int)$_SESSION['verifyTime'] > 3000*5){//5分钟超时
			FFDEBUG('验证码超时！');
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 检查邮箱是否已经注册
	 * @param string $mail 邮箱地址
	 * @return boolean boolean 检查合格就返回true
	 */
	private function chkmail($mail) {
		$fresult=getData('user',array('usr_mail'=>$mail));
		if ($fresult!=null) {
			FFDEBUG('此邮箱已经注册');
			return false;
		}else {
			return true;
		}
	}
	/**
	 * 检查QQ号
	 * @param int $qq QQ号
	 * @return boolean 检查合格就返回true
	 */
	private function chkqq($qq) {//检查QQ号
		$qq=(int)$qq;//QQ号为数字
		$fresult=getData('user',array('usr_qq'=>$qq));
		if ($fresult!=null) {
			FFDEBUG('此QQ号已经注册');
			return false;
		}else {
			return true;
		}
	}
	/**
	 * 检查用户名
	 * @param string $username 用户名
	 * @return regChk|boolean 检查合格就返回true，否则将错误信息写入$this->error并且返回regChk
	 */
	private function usernamechk($username) {//用户名检查
		$fresult=getData('user',array('usr_name'=>$username));
		if ($fresult!=null) {
			FFDEBUG('此用户名已经注册');
			return false;
		}else {
			return true;
		}
	}
	/**
	 * 实例化并启动regChk类，注册表单数据预处理
	 * 具体内容是：验证码正确、mail唯一、用户名唯一
	 * @param array $post 此处应当传入来自表单的$_POST
	 * @return boolean 匹配成功则返回true，否则返回false
	 */
	static function GO($post) {
		$r=new regChk();
		return $r->chk($post);
	}
}
