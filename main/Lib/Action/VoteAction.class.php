<?php
/**
 * Ajax用户打分类<br/>Ajax提交及响应
 * @author 李俊
 *
 */
class VoteAction extends Action {
	public $username;
	
	function __construct() {
		parent::__construct();
		
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		if(!$this->username){
			$this->show('请登录后再打分！');
			exit();
		}
	}
	
	/**
	 * 为用户评论打分[comment]，
	 * 调用方法/vote/cmt/(int)cmt_id/(int)cmt_score
	 */
	function cmt() {
		$pcmt=array();
		$pcmt['id']=$_GET['_URL_']['2'];
		$pcmt['point']=(int)$_GET['_URL_']['3'];
		$tmp1=getData('user', array('usr_name'=>$this->username));
		$pcmt['user_id']=$tmp1['usr_id'];
		import('@.Yuol.cmtpoint');
		try {
			$rst=cmtpoint::GO($pcmt);
		} catch (Exception $e) {
			$this->show($e->getMessage());
			exit();
		}
		if ($rst) {
			$this->show('打分成功，你打分'.$pcmt['point'].'分，感谢你的参与！');
		}
	}

}