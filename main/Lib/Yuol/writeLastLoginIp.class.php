<?php
/**
 * 将用户登录的ip写入user表
 * @author 李俊
 *
 */
class writeLastLoginIp{
	public $user;//user表模型
	public $username;
	
	/**
	 * 构造函数
	 * @param string $username 用户名
	 * @throws Exception 当用户名为空时抛出异常
	 */
	public function __construct($username){
		$this->user=M('user');//创建user表模型
		if (!$username) {
			throw new Exception('用户名不能为空！');
		}
		$this->username=$username;
	}

	/**
	 * 存储ip信息到数据库
	 * @return boolean <boolean, unknown>
	 */
	public function storeIP(){
		$data['usr_name']=$this->username;
		$data['usr_last_ip']=get_client_ip();
		return $this->user->where('usr_name="'.$this->username.'"')->save($data);//更新数据
	}
	/**
	 * 将用户登录的ip写入user表
	 * 对象执行函数，对象工厂
	 * @param unknown $username
	 * @return boolean
	 */
	static public function GO($username) {
		$i=new writeLastLoginIp($username);
		return $i->storeIP();
	}
}