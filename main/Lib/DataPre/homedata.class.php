<?php
/**
 * 个人主页数据准备
 * @author 李俊
 *
 */
class homedata{
	public $userModel;
	public $userid;
	
	function __construct() {
		$this->user=M('user');
	}
	
	function info($p) {
		if (is_string($p)) {//username
			$username=$p;
			$usertable=$this->user->where('usr_name="'.$username.'"')->find();
		}elseif (is_int($p)){//ID
			$userid=$p;
			$usertable=$this->user->where('usr_id="'.$userid.'"')->find();
		}
		
		$userid=$usertable['usr_id'];
		import('@.Yuol.getFigure');
		$usertable['usr_figure']=getFigure::GO($userid);//获取头像

		unset($usertable['usr_psw']);
		return $usertable;
	}

	static function GO($user) {
		$h=new homedata();
		return $h->info($user);
	}
}