<?php
class clsTpc{
	public $topicModel;
	public $resultArray;
	
	function __construct() {
		$this->topicModel=M('topic');
		$this->resultArray=array();
	}
	/**
	 * 获取源数据
	 */
	function data($clsid){
		return $this->resultArray= $this->topicModel->where('tpc_class_id="'.$clsid.'"')->order('tpc_time desc')->limit(0,7)->select();
	}
	/**
	 * 数组重构
	 * @param array $rawArray 源数组
	 * @return array
	 */
	function dataRebuild($rawArray) {
		$outputArray=array();
		foreach ($rawArray as $value) {
			$user=getData('user', array('usr_id'=>$value['tpc_user_id']));
			$class=getData('class', array('cls_id'=>$value['tpc_class_id']));
			$value['tpc_usernickname']=$user['usr_nickname'];
			$value['tpc_classname']=$class['cls_name'];
			$value['tpc_time']=timeInfo($value['tpc_time']);
			$value['tpc_user_url']=U('/home/user/'.$value['tpc_user_id']);//http://localhost/aixuanxiu/home/user/4.do
			array_push($outputArray, $value);
		}
		return $outputArray;
	}
	/**
	 * 主页上的最新主题
	 * @return array
	 */
	static function GO($clsid) {
		$t=new clsTpc();
		return $t->dataRebuild($t->data($clsid));
	}
}