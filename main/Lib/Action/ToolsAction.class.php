<?php
class ToolsAction extends Action {
	public $username=null;
	
	public function _initialize(){
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
	}
	
	/**
	 * 验证码
	 */
	Public function verify(){
		if (!$this->username) {//用户登录了，则验证码不写session，即验证码无效
			session('[start]');
		}
		session("verifyTime",time());//记下验证码生成的时间
	    import('ORG.Util.Image');
    	Image::buildImageVerify();
	}
	/**
	 * 中文验证码
	 */
	Public function cnverify(){
		if (!$this->username) {
			session('[start]');
		}
		session("verifyTime",time());//记下验证码生成的时间
	    import('ORG.Util.Image');
    	Image::GBVerify(4,'png',100,50,'./Public/font/msyh.ttf');
	}
	
	function test() {
	}
	
}





