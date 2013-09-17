<?php
/**
 * 用户主页
 * @author rex
 *
 */
class HomeAction extends Action {
	public $tagClass=array();
	public $tagsUrl=array();
	public $username;
	public $user_id;
	
	
	public function _initialize(){
		//parent::__construct();
		import('@.Yuol.conf');
		$this->assign('config', conf::GO());
		
		$this->assign('js_login', mU('js/login.js'));
		$this->assign('css_style', mU('css/style.css'));
	
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
	 * 用户主页
	 */
	public function user() {
		$this->tagClass['index']='class="now"';
    	$this->assign('tagClass',$this->tagClass);
    	$this->assign('tagsUrl',$this->tagsUrl);
    	$this->assign('css_home', mU('css/home.css'));
    	
    	$user=(int)$_GET['_URL_'][2];
    	import('@.DataPre.homedata');
    	$userinfo=homedata::GO($user);
//     	FFDEBUG($userinfo);
    	$this->assign('userinfo', $userinfo);
    	
    	$this->display();
	}
}
