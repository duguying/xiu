<?php
/**
 * 用户管理
 */
class UserAction extends Action{
	public $userModel;
	function _initialize() {
		$this->userModel=M("user");
		$this->assign("root",C("WWW_PATH"));
		$this->assign("tpl",C("TPL_PATH"));
	}
	function index() {
		$rec=$this->userModel->limit(0,10)->select();
		$this->assign("user",$rec);
		$this->display();
	}
}