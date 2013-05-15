<?php
class qq{
	private $auth;
	private $ocModel;
	public function __construct($auth){
		$this->auth=$auth;
		$this->ocModel=M('oc');
	}
	/**
	 * 保存openID
	 */
	public function storeOid(){
		$data['oc_qq_oid'] = $this->auth['openid'];
		$data['email'] = 'ThinkPHP@gmail.com';
		$User->add($data);
	}
	/**
	 * 检查openID是否已经注册
	 * @return boolean 已注册true
	 */
	public function chkReg() {
		$result=$this->ocModel->where(array('oc_qq_oid'=>$this->auth['openid']))->find();
		if(!$result){
			return false;
		}else{
			return true;
		}
	}
}