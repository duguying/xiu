<?php
/**
 * 用户登录
 */
class UserAction extends Action {
	public $tagClass=array();
	public $tagsUrl=array();
	private $user_id;
	private $user_name;
	private $user_qq;
	private $user_active_score;
	private $user_reg_time;
	private $user_last_ip;
	public  $sid;//用户session_id
	public $userState;//登录状态True表示在线，False表示离线
	
	public function _initialize(){
		chkBrowser();
		import('@.Yuol.conf');
		$this->assign('config', conf::GO());
		
// 		$this->assign('js_jqui', mU('js/jquery-ui-1.10.0.custom.min.js'));
// 		$this->assign('js_login', mU('js/login.js'));
// 		$this->assign('css_style', mU('css/style.css'));
		
		import('@.Yuol.autoLogin');
		$this->user_name=autoLogin::PC();
		
		if(!hostOnly()){//不是来自本站的访问，则跳转至主页
			header("Location:".C('WWW_PATH'));//如果用户已登录，则重定向跳转至主页
		}
		if ($this->user_name) {//已登录用户不许注册、登录，若用户未登录，则显示可以
			header("Location:".C('WWW_PATH'));//如果用户已登录，则重定向跳转至主页
			exit();
		}
			
		$this->tagsUrl['index']=getRoot();
		$this->tagsUrl['class']=U('Index/allclass');
		$this->tagsUrl['ziliao']=U('Index/ziliao');
		/**公共模版变量**/
		$this->assign('tagsUrl',$this->tagsUrl);
	}
	/**
	 * 注册表单页面
	 */
	public function registor() {
    	$this->tagClass['index']='class="now"';
    	$this->assign('tagClass',$this->tagClass);
    	$this->assign('registor_page', U('user/registor'));
    	$this->assign('submit',U('user/registor_sub'));
    	$this->assign('verify', U('tools/cnverify'));
    	$chk['username']=U('regformajaxchk/username');
    	$this->assign('chk', $chk);
    	$this->assign('js_login_registor', mU('js/login.registor.js'));
		
    	$this->display();
    	
	}
	/**
	 * 注册响应页面
	 */
	public function registor_sub() {
		$this->tagClass['index']='class="now"';
		$this->assign('tagClass',$this->tagClass);
		
		import('@.Yuol.regChk');
		if (regChk::GO($_POST)) {
			import('@.Yuol.regStore');
			regStore::GO($_POST);
			$this->assign('msg', '注册成功，正在转向主页……<script>window.setTimeout(function(){window.location.href="'.C("WWW_PATH").'";},3000);</script>');
		}else {
			$this->assign('msg', '注册失败，请认真检查注册项，正在转向主页……<script>window.setTimeout(function(){window.location.href="'.C("WWW_PATH").'";},3000);</script>');
		}
		$this->display();
	}
	/**
	 * 登录响应页面
	 */
	public function login() {
		$username=$_POST["username"];
		$password=$_POST["password"];
		if (session_id()=="") {//如果当前session没有开启，则消除PHPSESSID的session以及其cookies中的sid
			session_id(cookie('PHPSESSID'));
			session("[start]");
			session_destroy();
			cookie('PHPSESSID', null);
		}
		import('@.Yuol.loginChk');
		$result=loginChk::GO($username, $password);
		dump($result);
		header("Location:".$_SERVER['HTTP_REFERER']);//登录成功，重定向跳转到主页
	}
	
}
