<?php
/**
 * 发表主题-响应页
 * @author Administrator
 *
 */
class TpcAction extends Action{
	/**
	 * 主题表模型
	 * @var Model
	 */
	public $topicModel;
	/**
	 * 回复主题表模型
	 * @var Model
	 */
	public $rpltpcModel;
	/**
	 * 用户名
	 * @var string
	 */
	public $username;
	
	
	function _initialize() {
		$this->topicModel=M('topic');
		$this->rplcmtModel=M('reply_tpc');
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
		//http://localhost/aixuanxiu/tpc/submit.do
		$post=$_POST;
		$d=$this->submitDataPre($post);
		$this->topicModel->add($d);
		header("Location:".$_SERVER['HTTP_REFERER']);//重定向到来的页面
	}
	private function submitDataPre($post){
		$tpc_ctt=$post['tpc_content'];
		$tpc_tit=$post['tpc_title'];
		$cls_id=$post['class_id'];
		if ($this->username) {
			$data['tpc_class_id'] = $cls_id;
			$data['tpc_title'] = $tpc_tit;
			$data['tpc_content'] = $tpc_ctt;
			$userTable=getData('user', array('usr_name'=>$this->username));
			$data['tpc_user_id'] = $userTable['usr_id'];
			$data['tpc_time'] = time();
			return $data;
		}
		
		
	}
}

