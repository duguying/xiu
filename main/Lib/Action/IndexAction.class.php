<?php
class IndexAction extends Action {
	public $tagClass=array();
	public $tagsUrl=array();
	public $username;
	public $user_id;
	
	public function _initialize(){
 		chkBrowser();
		cookie('tk', time());
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
		$this->assign('user_state',loginState::GO($this->username));
	}
	/**
	 * 首页
	 */
    public function index(){
    	$this->tagClass['index']='class="now"';
    	$this->assign('tagClass',$this->tagClass);
    	$this->assign('tagsUrl',$this->tagsUrl);
    	
    	import('@.Yuol.cmtDataPrepare');
    	$cmtdata=cmtDataPrepare::GO();//获取第一页数据
    	$this->assign('userid',$this->user_id);//用户id
    	$this->assign('result', $cmtdata['result']);
    	$this->assign('tail', $cmtdata['tail']);
    	$this->assign('verify', U('tools/verify'));//验证码
    	import('@.Yuol.tpcIndex');
    	$this->assign('topic', tpcIndex::GO());
    	import('@.Yuol.activestUser');
    	$this->assign('user_rank', activestUser::GO());
    	import('@.Yuol.talk');
    	$this->assign('tk',talk::GET5(0));

    	
    	$this->display();//从入口文件开始
    }
    /**
     * 公选课页面--所有课程
     */
	public function allclass(){
		$this->tagClass['class']='class="now"';
		$this->assign('tagClass',$this->tagClass);
    	$this->assign('tagsUrl',$this->tagsUrl);
    	
    	$this->display();//从入口文件开始
	}
	/**
	 * 资料分享页面
	 */
	public function ziliao(){
		$this->tagClass['ziliao']='class="now"';
		$this->assign('tagClass',$this->tagClass);
		$this->assign('tagsUrl',$this->tagsUrl);
		
		$this->display();
	}
	

	
}
