<?php
class ClassdetailAction extends Action {
	public $tagClass=array();
	public $tagsUrl=array();
	public $username;
	public $user_id;
	/**
	 * 课程id
	 * @var int
	 */
	public $classid;//课程id
	
	public function _initialize() {
		chkUpdate();
		import('@.Yuol.conf');
		$this->assign('config', conf::GO());
		
		$this->tagsUrl['index']=getRoot();
		$this->tagsUrl['class']=U('Index/allclass');
		$this->tagsUrl['ziliao']=U('Index/ziliao');
		/**公共模版变量**/
		$this->assign('registor_page', U('user/registor'));
		$this->assign('login_submit', U('user/login'));
		
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		$user=getData('user',array('usr_name'=>$this->username));//TODO
		$this->user_id=$user['usr_id'];
		import('@.Yuol.loginState');
		$this->assign('user_state',loginState::GO($this->username));//important!
		$this->assign('userid', $this->user_id);
	}
	
	/**
	 * 课程详情页面<br/>
	 * 调用方式http://localhost/aixuanxiu/classdetail/detail/1.do<br/>
	 */
	function detail() {
		$this->tagClass['class']='class="now"';
		$this->assign('tagClass',$this->tagClass);
		$this->assign('tagsUrl',$this->tagsUrl);
		
		$this->classid=@(int)$_GET['_URL_'][2];//获取classid
		if (!$this->classid||$this->classid==0) {
			$this->classid=1;
		}
		import('@.DataPre.clsDetailPrepare');
		try {
			$arr=clsDetailPrepare::GO($this->classid);
		} catch (Exception $e) {
			header('location:'.C('WWW_PATH'));//跳转到主页
			exit();
		}
		
		$this->assign('classarr', $arr);
		
		import('@.DataPre.clsCmtDataPrepare');
		$tmp1=clsCmtDataPrepare::GO($this->classid);
		$this->assign('result', $tmp1['result']);
		$this->assign('tail', $tmp1['tail']);
		$this->assign('verify', U('tools/verify'));
		$this->assign('userid',$this->user_id);//用户id
		$this->assign('cls_id', $this->cls_id);
		import('@.DataPre.clsTpc');
		$this->assign('topic', clsTpc::GO($this->classid));
		import('@.Yuol.showClsPoint');
		$cls_point=array('sco'=>showClsPoint::GO(2, $this->classid), 'rat'=>showClsPoint::GO(3, $this->classid));
		$this->assign('cls_point', $cls_point);
// 		FFDEBUG($cls_point);
// 		FFDEBUG($arr);
		$this->display();
	}

}
