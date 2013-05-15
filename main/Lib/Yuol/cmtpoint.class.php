<?php
/**
 * 评论打分处理
 * @author 李俊
 *
 */
class cmtpoint{
	public $userid;
	public $pr;//数据库模型对象point_record
	public $cmt;
	public $itemid;//打分项目的id
	public $point;//将要打得分数
	
	public function __construct(){
		$this->pr=M('point_record');
		$this->cmt=M('comment');
	}
	/**
	 * 打分总控函数
	 * @param array $pointArray 打分信息数组
	 * @throws Exception 用户id['user_id']为空时，抛出异常
	 * @return 数据更新的执行结果
	 */
	public function point($pointArray) {
		if (!$pointArray['user_id']) {
			throw new Exception('用户名不能为空！');
			exit();
		}
		$this->userid=$pointArray['user_id'];//用户id
		$id=$pointArray['id'];//打分项目id
		$this->itemid=$id;
		$point=$pointArray['point'];
		if($point<0){
			$point=0;
		}else if($point>5){
			$point=5;
		}
		$this->point=$point;//打分分数
		$this->userid=(int)$pointArray['user_id'];
		$this->chkRecordExist($id);//检查记录是否存在
		if(!$this->chkWhetherPointed()){//如果没有打分
			/**
			 * 加入打分记录表
			 */
			$data['pr_point'] = $point;
			$data['pr_type'] = 1;//类型为1表示为cmt类型
			$data['pr_user_id'] = $this->userid;
			$data['pr_item_id'] = $id;
			$this->pr->add($data);
			//下面加入到comment表
			return $this->updateCmt();
		}else {
			throw new Exception('用户已经打过分！');
			exit();
		}
	}
	/**
	 * 更新cmt表中的记录
	 * @return 数据更新的执行结果
	 * @throws 记录不存在异常
	 */
	function updateCmt() {
		// 先查找到要更新的数据
		$tp1=$this->cmt->where('cmt_id='.$this->itemid)->find();
		$cmt_score=(int)$tp1['cmt_score'];//总分数
		$cmt_score_time=(int)$tp1['cmt_score_time'];//打分次数
		//数据处理
		$cmt_score=$cmt_score+$this->point;//分数相加
		$cmt_score_time++;
		//数据准备
		$data['cmt_score'] = $cmt_score;
		$data['cmt_score_time'] = $cmt_score_time;
		//comment表数据更新
		return $this->cmt->where('cmt_id='.$this->itemid)->save($data); // 根据条件保存修改的数据
	}
	/**
	 * 检查是否[当前用户]已经为[当前项目]打分
	 * @return 若打分了，则返回非null。若没有打分则null
	 */
	function chkWhetherPointed() {
		return $this->pr->where('pr_type=1 and pr_user_id='.$this->userid.' and pr_item_id='.$this->itemid)->find();
	}
	/**
	 * 检测记录id是否存在
	 * @param int $id
	 */
	function chkRecordExist($id) {
		if(!$this->cmt->where('cmt_id='.$id)->find()){
			throw new Exception('记录不存在！');
			exit();
		};
	}
	
	/**
	 * 评论打分处理
	 * @param array $rawArray 原数据数组
	 * @return Ambigous <数据更新的执行结果, boolean, unknown>
	 */
	static function GO($rawArray){
		$p=new cmtpoint();
		return $p->point($rawArray);
	}
}