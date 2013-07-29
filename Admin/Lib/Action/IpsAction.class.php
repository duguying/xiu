<?php
class IpsAction extends Action{
	public $ipsModel;
	function _initialize() {
		$this->ipsModel=M("admin_iplimit");
		$this->assign("root",C("WWW_PATH"));
		$this->assign("tpl",C("TPL_PATH"));
	}
	function index() {
		$ips=$this->ipsModel->select();
		$this->assign('iplist',$ips);
// 		echo APP_PATH;
		$this->display();
		
	}
}