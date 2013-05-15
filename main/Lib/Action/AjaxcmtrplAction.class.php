<?php
/**
 * 用户回复评论页面<br/>验证用户回复信息<br/>将信息添加到数据库<br/>返回数据
 */
class AjaxcmtrplAction extends Action {
	public $user_id;
	public $username;
	public $nickname;
	
	function __construct() {
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		$user=getData('user',array('usr_name'=>$this->username));//TODO
		$this->user_id=$user['usr_id'];
		$this->nickname=$user['usr_nickname'];
	}
	/**
	 * 评论回复Ajax响应页
	 */
	function add(){
		//http://localhost/aixuanxiu/ajaxcmtrpl/add/1.do
		//$_POST['content']是回复内容
		//$cmt_id=$_GET['_URL_']['2'];
		import('@.DataPre.addCmtReply');
		try {
			$result=addCmtReply::GO($_GET, $_POST);
			
			$result['rplcmt_user_id']=$this->user_id;
			$result['rplcmt_user_nickname']=$this->nickname;
			$result['rplcmt_time']=timeInfo($result['rplcmt_time']);
		} catch (Exception $e) {
			$result='目前还不允许没有登录的用户回复，'.$e->getMessage();
		}
		echo json_encode($result);
		header("Content-type:application/json;charset=utf-8");
	}
}