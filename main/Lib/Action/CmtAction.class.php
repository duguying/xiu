<?php
/**
 * 发表评论-响应
 * @author 李俊
 *
 */
class CmtAction extends Action{
	/**
	 * 评论表模型
	 * @var Model
	 */
	public $commentModel;
	/**
	 * 回复评论表模型
	 * @var Model
	 */
	public $rplcmtModel;
	/**
	 * 用户名
	 * @var string
	 */
	public $username;
	
	
	function _initialize() {
		chkBrowser();
		$this->commentModel=M('comment');
		$this->rplcmtModel=M('reply_cmt');
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		if(!$this->username){//未登录
			header("Location:".C('WWW_PATH'));//重定向到主页
			exit();
		}
	}
	/**
	 * 提交评论
	 */
	function submit() {
		//http://localhost/aixuanxiu/cmt/submit.do
		$post=$_POST;
		$d=$this->submitDataPre($post);
		$this->commentModel->add($d);
		header("Location:".$_SERVER['HTTP_REFERER']);//重定向到来的页面
	}
	private function submitDataPre($post){
		$cmt_ctt=$post['comment_input'];
		$cls_id=$post['class_id'];
		if ($this->username) {
			$data['cmt_class_id'] = $cls_id;
			$data['cmt_content'] = $cmt_ctt;
			$userTable=getData('user', array('usr_name'=>$this->username));
			$data['cmt_user_id'] = $userTable['usr_id'];
			$data['cmt_time'] = time();
			return $data;
		}
		
		
	}
}

