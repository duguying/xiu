<?php
class ClspointAction extends Action{
	public $prModel;
	public $username;
	public $userid;
	
	function __construct() {
		$this->prModel=M('point_record');
		import('@.Yuol.autoLogin');
		$this->username=autoLogin::PC();
		$u=getData('user', array('usr_name'=>$this->username));
		$this->userid=$u['usr_id'];
	}
	/**
	 * 添加记录
	 * @param int $type 类型1,cmt;2,cls;3rat
	 * @param int $point 分数
	 * @param int $classid 课程
	 * @return Ambigous <mixed, boolean, string, unknown>
	 */
	private function add($type,$point,$classid){
		$point=(int)$point;
		if ($point>5) {
			$point=5;
		}elseif ($point<0){
			$point=0;
		}
		$prData=array();
		$prData['pr_point']=$point;
		$prData['pr_type']=$type;
		$prData['pr_user_id']=$this->userid;
		$prData['pr_item_id']=$classid;
		return $this->prModel->add($prData);
	}
	/**
	 * 用户是否已经打过分
	 * @param int $type
	 * @param int $classid
	 * @return boolean 若打过分返回true，否则返回false
	 */
	private function ispointed($type, $classid) {
		$result = $this->prModel->where('pr_type='.$type.' and pr_user_id='.$this->userid.' and pr_item_id='.$classid)->find();
		if(!$result){
			return false;
		}else{
			return true;
		}
	}
	
	
	/**
	 * 课程打分score, type=2
	 */
	function sco(){
		$point = @(int)$_GET['_URL_'][3];
		$classid = @(int)$_GET['_URL_'][2];
		$type=2;
		if (!$classid){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'打分必须是针对某一课程！'));
		}elseif (!$point){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'打分的分数不能为空！'));
		}elseif (!$this->username){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'请登录后再打分！'));
		}elseif($this->ispointed($type, $classid)){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'用户已经打过分！'));
		}else{
			if ($this->add($type, $point, $classid)) {
				$this->ajaxReturn(array('result'=>true, 'msg'=>'打分成功！'));
			}else {
				$this->ajaxReturn(array('result'=>false, 'msg'=>'打分失败！'));//系统内部错误时发生
			}
		}
		
	}
	/**
	 * 点名频率rate, type=3
	 */
	function rat() {
		$point = @(int)$_GET['_URL_'][3];
		$classid = @(int)$_GET['_URL_'][2];
		$type=3;
		if (!$classid){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'打分必须是针对某一课程！'));
		}elseif (!$point){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'打分的分数不能为空！'));
		}elseif (!$this->username){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'请登录后再打分！'));
		}elseif($this->ispointed($type, $classid)){
			$this->ajaxReturn(array('result'=>false, 'msg'=>'用户已经打过分！'));
		}else{
			if ($this->add($type, $point, $classid)) {
				$this->ajaxReturn(array('result'=>true, 'msg'=>'打分成功！'));
			}else {
				$this->ajaxReturn(array('result'=>false, 'msg'=>'打分失败！'));//系统内部错误时发生
			}
		}
	}
	
	function t() {
		import('@.Yuol.showClsPoint');
		$r=showClsPoint::GO(3, 2);
		var_dump($r);
	}
}