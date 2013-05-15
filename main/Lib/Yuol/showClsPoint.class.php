<?php
/**
 * 统计并计算cls分数
 * @author Administrator
 *
 */
class showClsPoint{
	public $prModel;
	
	function __construct() {
		$this->prModel=M('point_record');
	}
	/**
	 * 统计打分次数
	 * @param int $type
	 * @param int $classid
	 * @return number
	 */
	function pr_count($type, $classid) {
		$type=(int)$type;
		$classid=(int)$classid;
		$sql='select count(*) as "0" from xiu_point_record where pr_type="'.$type.'" and pr_item_id="'.$classid.'"';
		$num = $this->prModel->query($sql);
		$num=$num[0][0];
		return (int)$num;
	}
	/**
	 * 求指定项目的总分
	 * @param int $type
	 * @param int $classid
	 * @return number
	 */
	function pr_sum($type, $classid) {
		$sql='select SUM(pr_point) as "0" from xiu_point_record where pr_type='.$type.' and pr_item_id='.$classid;
		$sum = $this->prModel->query($sql);
		$sum=$sum[0][0];
		return (int)$sum;
	}
	/**
	 * 获取指定项目的分数【平均分】
	 * @param int $type 项目类型
	 * @param int $classid 课程ID
	 * @return number 整形平均分【四舍五入取值】
	 */
	static function GO($type, $classid) {
		$pr=new showClsPoint();
		$pr_count=$pr->pr_count($type, $classid);
		if ($pr_count==0) {
			$pr_count++;
		}
		$pr_sum=$pr->pr_sum($type, $classid);
		return (int)round($pr_sum/$pr_count);
	}
}