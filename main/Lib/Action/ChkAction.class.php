<?php
/**
 * 常用验证类
 * @author 李俊
 *
 */
class ChkAction extends Action{
	public $username=null;
	function _initialize() {
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
	}
	
	/**
	 * 登录验证
	 */
	function islogin() {
		$this->ajaxReturn($this->username);
	}
}
