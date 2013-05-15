<?php
class talk{
	public $talkModel;
	public $userid;
	public $username;
	public $time;
	
	function __construct($time) {
		$this->time=$time;
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		$tmp=getData('user', array('usr_name'=>$this->username));
		$this->userid=$tmp['usr_id'];
		$this->talkModel=M('talk');
	}
	/**
	 * 为1时返回一条，非1时返回5条
	 * @param int $n
	 * @return Ambigous <mixed, boolean, NULL, multitype:>|Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	function data($n){
		if ($n==1) {
			return $this->talkModel->where('tk_time>'.$this->time)->order('tk_time desc')->find();
		}else {
			return $this->talkModel->where('tk_time>'.$this->time)->order('tk_time desc')->limit(0,5)->select();
		}
		
	}
	/**
	 * $_POST['content']为内容
	 */
	function fadd($content){
		$data['tk_content'] = $content;
		$data['tk_time']=time();
		if (!$this->userid) {
			throw new Exception('请先登录！');
		}
		$data['tk_user_id']=$this->userid;
		return $this->talkModel->add($data);
	}
	/**
	 * 获取5条数据
	 * @return array
	 */
	static function GET5($time) {
		$t=new talk($time);
		$rawArray=$t->data(5);
		//数组重构
		$resultArray=array();
		foreach ($rawArray as $value) {
			$u=getData('user', array('usr_id'=>$value['tk_user_id']));
			$value['tk_time']=timeInfo($value['tk_time']);
			$value['tk_nickname']=$u['usr_nickname'];
			import('@.Yuol.getFigure');
			$value['tk_figure']=getFigure::GO((int)$value['tk_user_id']);//头像
			array_push($resultArray, $value);
		}
		return $resultArray;
	}
	/**
	 * 获取1条数据
	 * @return array
	 */
	static function GET1($time) {
		$t=new talk($time);
		$rawArray=$t->data(1);
		$u=getData('user', array('usr_id'=>$rawArray['tk_id']));
		$rawArray['tk_time']=timeInfo($rawArray['tk_time']);
		$rawArray['tk_nickname']=$u['usr_nickname'];
		return $rawArray;
	}
	/**
	 * 添加记录
	 * @param string $content 内容
	 * @return Ambigous <mixed, boolean, string, unknown>
	 */
	static function ADD($content) {
		$t=new talk(time());
		return $t->fadd($content);
	}
	static function INDEX5() {
		$t=new talk(0);
		$rawArray=$t->data(5);
		$resultArray=array();
		foreach ($rawArray as $value) {
			$value['tk_time']=timeInfo($value['tk_time']);
			$u=getData('user', array('usr_id'=>$value['tk_id']));
			$value['tk_nickname']=$u['usr_nickname'];
			import('@.Yuol.getFigure');
			$value['tk_figure']=getFigure::GO((int)$value['tk_user_id']);//头像
			array_push($resultArray, $value);
		}
		return $resultArray;
	}
}