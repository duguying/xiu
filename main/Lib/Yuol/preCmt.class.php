<?php
/**
 * Cmt返回数组，数组预处理，重构
 * @author 李俊
 *
 */
class preCmt{
	function __do($rawData) {
		$contener=array();//容器数组
		foreach ($rawData as $value) {
			if (is_array($value['reply_cmt'])) {
				$value['reply_cmt']=$this->innerArrayDo($value['reply_cmt']);
			}
			$cmt_score_point=(int)($value['cmt_score']/$value['cmt_score_time']);
			unset($value['cmt_score']);
			unset($value['cmt_score_time']);
			$usrtmparr=getData('user', array('usr_id'=>$value['cmt_user_id']));
			$value['user_name']=$usrtmparr['usr_nickname'];//获取用户名
			$clstmparr=getData('class', array('cls_id'=>$value['cmt_class_id']));
			$value['class_name']=$clstmparr['cls_name'];//课程名
			import('@.Yuol.getFigure');
			$value['cmt_user_figure']=getFigure::GO((int)$value['cmt_user_id']);//头像
			$value['class_url']=U('/classdetail/detail/'.$clstmparr['cls_id']);//课程URL
			$value['cmt_score']=$cmt_score_point;//分数
			$value['cmt_time']=timeInfo($value['cmt_time']);//时间信息
			$value['reply_cmt_len']=count($value['reply_cmt']);//回复数
			array_push($contener, $value);
		};
		return $contener;
	}
	/**
	 * 内层数组处理
	 * @param array $innerArray 内层数组
	 * @return multitype: array 返回的数组
	 */
	function innerArrayDo($innerArray) {
		$contener=array();//容器数组
		foreach ($innerArray as $value) {
			$tmp1=getData('user', array('usr_id'=>$value['rplcmt_user_id']));
			$value['rpl_user_name']=$tmp1['usr_nickname'];//获取用户名
			$value['rplcmt_time']=timeInfo($value['rplcmt_time']);//回复时间信息
			array_push($contener, $value);
		};
		return $contener;
	}
	/**
	 * 实例化preCmt对象
	 * Cmt返回数组，数组预处理，重构
	 * @param array $rawData 源数组
	 * @return multitype: array 重构数组
	 */
	static function GO($rawData) {//实例化preCmt对象
		$p=new preCmt();
		$v=$p->__do($rawData);
		return $v;
	}
}
