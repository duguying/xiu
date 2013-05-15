<?php
/**
 * 注册数据保存至数据库，其中传入的密码请不要ms5加密，因为md5加密将在此类内部进行
 * @author 李俊
 *
 */
class regStore{
	/**
	 * 将数据存储至数据库
	 * @param array $post $_POST传过来的数组
	 * @return 执行结果 Ambigous <mixed, boolean, string, unknown>
	 */
	function store($post) {
		$user=M('user');
		$data['usr_name'] = $post['username'];
		$data['usr_nickname'] = $post['nickname'];
		$data['usr_psw'] = md5($post['password']);//传入的密码经过md5加密
// 		$data['usr_qq'] = $post['qq'];
		$data['usr_mail'] = $post['mail'];
		$data['usr_reg_ip'] = get_client_ip();//注册的ip地址
		$data['usr_reg_time'] = time();
		return $user->data($data)->add();
	}
	
	/**
	 * regStore对象启动函数，作用：
	 * 将用户的注册数据保存至数据库
	 * 实例化regStore类
	 * @param array $post $_POST传过来的数组
	 * @return Ambigous <执行结果, mixed, boolean, string, unknown>
	 */
	static function GO($post) {
		$r=new regStore();
		return $r->store($post);
	}
}