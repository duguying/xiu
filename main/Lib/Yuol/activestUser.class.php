<?php
/**
 * 活跃用户
 * @author 李俊
 *
 */
class activestUser {
	/**
	 * 用户表模型
	 * @var model
	 */
	public $userTable;
	
	function __construct() {
		$this->userTable=M('user');
	}
	/**
	 * 生成源数组
	 */
	function data(){
		return $this->userTable->order('usr_active_score desc')->limit(0,10)->select();
	}
	/**
	 * 统计发表评论数
	 * @param int $userid 用户ID
	 */
	function countCmt($userid){
		$m=M('comment');
		$ra= $m->query('select count(*) as "0" from xiu_comment where cmt_user_id='.$userid);
		return $ra[0][0];
	}
	/**
	 * 统计发表主题数
	 * @param int $userid 用户ID
	 */
	function countTpc($userid){
		$m=M('topic');
		$ra= $m->query('select count(*) as "0" from xiu_topic where tpc_user_id='.$userid);
		return $ra[0][0];
	}
	/**
	 * 重归数组
	 * @param array $rawArray 源数组
	 * @return array
	 */
	function rebuild($rawArray){
		$resultArray=array();
		foreach ($rawArray as $value) {
			unset($value['usr_reg_time']);
			unset($value['usr_reg_ip']);
			unset($value['usr_last_ip']);
			unset($value['usr_psw']);
			$value['usr_url']=U('/home/user/'.$value['usr_id']);
			$value['usr_ccmt']=$this->countCmt($value['usr_id']);
			$value['usr_ctpc']=$this->countTpc($value['usr_id']);
			array_push($resultArray, $value);
		}
		return $resultArray;
	}
	static function GO() {
		$a=new activestUser();
		return $a->rebuild($a->data());
	}
}