<?php
/**
 * 课程详情页面<br/> 数据准备
 * @author 李俊
 *
 */
class clsDetailPrepare {
	/**
	 * 课程id
	 * @var int
	 */
	public $id;
	/**
	 * 未经处理的来自数据库的源数组
	 * @var array
	 */
	public $rawArray=array();
	/**
	 * 处理后的结果数组，数据准备的最终结果储存在里面
	 * @var array
	 */
	public $resultArray=array();
	/**
	 * class表的模型
	 * @var object model
	 */
	public $class_model;
	/**
	 * 构造函数
	 * 创建class表的model
	 * @param int 课程id
	 */
	function __construct($id) {
		$this->class_model=M('class');
	}
	/**
	 * 通过id获取指定id的查询数据
	 * @param int 课程id
	 * @throws Exception class id不能为空
	 * @return array 返回值为查询的源结果数组
	 */
	function getInfoById($id) {
		if (!$id) {
			throw new Exception('内部错误：class id不能为空！');
		}
		$this->rawArray=$this->class_model->where('cls_id='.$id)->find();
		return $this->rawArray;
	}
	/**
	 * 重构数组
	 * @throws Exception 源数组不能为空
	 */
	function rebuild(){
		$ctModel=M('class_category');
		
		if (!$this->rawArray) {
			throw new Exception('内部错误：源数组不能为空！');
		}
		$rawArray=$this->rawArray;
		$tmpArray=array();
		$tmpArray=$rawArray;

		import('ORG.Util.String');
		$cls_time=$tmpArray['cls_time'];
		$tmpArray['cls_time']=$cls_time;
		$tmp1=getData('teacher', array('tch_id'=>$tmpArray['cls_teacher_id']));
		$tmpArray['cls_teacher_name']=$tmp1['tch_name'];//获取老师姓名
		
		$tmpArray['cls_clsscore']=$tmpArray['cls_clsscore'].'分';
		$tmpArray['cls_class_time']=$tmpArray['cls_class_time'].'周';
		
		
		$this->resultArray=$tmpArray;
	}
	/**
	 * 对象工厂<br/>课程详情页面<br/> 数据准备
	 * @param int $id 课程ID
	 * @return multitype:array 返回结果数组
	 */
	static function GO($id) {
		$c=new clsDetailPrepare($id);
		$c->getInfoById($id);
		$c->rebuild();
		return $c->resultArray;
	}
}