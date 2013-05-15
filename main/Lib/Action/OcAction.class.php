<?php
class OcAction extends Action{
	public $sdk;
	public function qqlogin() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('qq');//获取SDK实例
		redirect($sdk->getRequestCodeURL());//跳转到授权页面
	}
	public function qqcallback() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('qq');//获取SDK实例
		$user_auth=$sdk->getAccessToken($_GET['code']);//将上一步中由腾讯返回的code参数传入
		dump($user_auth);
	}
	
	public function renrenlogin() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('renren');//获取SDK实例
		redirect($sdk->getRequestCodeURL());//跳转到授权页面
	}
	public function renrencallback() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('renren');//获取SDK实例
		$user_auth=$sdk->getAccessToken($_GET['code']);//将上一步中由腾讯返回的code参数传入
		dump($user_auth);
	}
	
	public function doubanlogin() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('douban');//获取SDK实例
		redirect($sdk->getRequestCodeURL());//跳转到授权页面
	}
	public function doubancallback() {
		import("ORG.ThinkSDK.ThinkOauth");//导入SDK基类
		$sdk=ThinkOauth::getInstance('douban');//获取SDK实例
		$user_auth=$sdk->getAccessToken($_GET['code']);//将上一步中由腾讯返回的code参数传入
		dump($user_auth);
		//https://www.douban.com/service/auth2/www.duguying.tk/oc/doubancallback?code=a6857bd531416daa
	}
} 