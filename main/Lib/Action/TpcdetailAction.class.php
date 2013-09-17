<?php
/**
 * Class TpcdetailAction
 * 主题详情类，在弹出层显示，可回复主题
 */
class TpcdetailAction extends Action{
	public $tpcModel;
	public $tpcrplModel;
	public $usrname;
	public $usrid;
	public $usrnickname;
	public $tpcid;
	
	
	function _initialize() {
		$this->tpcModel=M('topic');
		$this->tpcrplModel=M('reply_tpc');
		import('@.Yuol.autoLogin');
		$this->usrname=autoLogin::PC();
		$u=getData('user', array('usr_name'=>$this->usrname));
		$this->usrid=$u['usr_id'];
		$this->usrnickname=$u['usr_nickname'];
		$this->tpcid=(int)$_GET['_URL_'][2];//主题ID
		import('@.Yuol.conf');
		$this->assign('config', conf::GO());
	}
	/**
	 * 显示主题的详细内容【包括其回复】
	 */
	function tpc(){//http://localhost/aixuanxiu/tpcdetail/tpc/1.do
		$resultArray=$this->tpcModel->where('tpc_id='.$this->tpcid)->find();
		$resultArray['tpc_time']=timeInfo($resultArray['tpc_time']);
		$u=getData('user', array('usr_id'=>$resultArray['tpc_user_id']));
		$resultArray['tpc_nickname']=$u['usr_nickname'];
		unset($u);
		$c=getData('class', array('cls_id'=>$resultArray['tpc_class_id']));
		$resultArray['tpc_class_name']=$c['cls_name'];
		unset($c);
		import('@.Yuol.getFigure');
		$resultArray['tpc_figure']=getFigure::GO((int)$resultArray['tpc_user_id']);//头像
		$tmpArray=$this->tpcrplModel->where('rpltpc_topic_id='.$this->tpcid)->select();
		$tmpCArray=array();
		foreach ($tmpArray as $value) {
			$u=getData('user', array('usr_id'=>$value['rpltpc_user_id']));
			$value['rpltpc_user_nickname']=$u['usr_nickname'];
			unset($u);
			$value['rpltpc_time']=timeInfo($value['rpltpc_time']);
			array_push($tmpCArray, $value);
		}
		$resultArray['tpc_rpl']=$tmpCArray;
		$this->assign('tpc', $resultArray);
		$this->display();
	}
	
	function rpl() {
// 		echo json_encode(array('hi'));
		if (!$this->usrname) {
			echo json_encode(array('msg'=>'请先登录！'));
		}else {
			$data['rpltpc_topic_id']=$this->tpcid;
			$data['rpltpc_content']=$_POST['c'];//回复内容
			$data['rpltpc_user_id']=$this->usrid;
			$data['rpltpc_time']=time();
			$result=$this->tpcrplModel->add($data);
			if(!$result){
				echo json_encode(array('msg'=>'回复失败！'));
			}else {
				$returnArray=array();
				$returnArray['userurl']=U('/home/user/'.$this->usrid);
				$returnArray['usernickname']=$this->usrnickname;
				$returnArray['content']=$_POST['c'];//回复内容
				$returnArray['time']=timeInfo($data['rpltpc_time']);
				echo json_encode($returnArray);
			};
		}
		
		header("Content-type:application/json;charset=utf-8");
	}
}
