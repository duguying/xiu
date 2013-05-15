<?php
/**
 * 用户名检验
 * @author 李俊
 *
 */
class RegformajaxchkAction extends Action {
	public function username() {
		$username=$_GET['username'];
		if (strlen($username)>=6) {
			$chk=M('user');
			$result=$chk->where('usr_name="'.$username.'"')->find();
			if(!$result){
				$this->show('<font color="green">此用户名可以使用</font>');
			}else{
				$this->show('<font color="red">此用户名已经被注册</font>');
			}
		}else{
			$this->show('<font color="red">用户名不能少于6个字符</font>');
		}
	}
}
