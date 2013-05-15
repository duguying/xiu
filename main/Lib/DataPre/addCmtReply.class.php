<?php
/**
 * 用户评论回复类
 * @author 李俊
 *
 */
class  addCmtReply{
	/**
	 * 评论回复表模型
	 * @var model
	 */
	public $cmtrplModel;
	/**
	 * 用户ID
	 * @var int
	 */
	public $user_id;
	/**
	 * 来自$_GET的源数据
	 * @var array
	 */
	public $get;
	/**
	 * 来自$_POST的源数据
	 * @var array
	 */
	public $post;
	/**
	 * 来自data()方法，准备的数组
	 * @var array
	 */
	public $data;
	/**
	 * 评论ID
	 * @var int
	 */
	public $cmt_id;
	
	
	function __construct($get, $post){
		$this->cmt_id=(int)$get['_URL_']['2'];//获取cmt_id
		$this->cmtrplModel=M('reply_cmt');
		import('@.Yuol.autoLogin');
		$username=autoLogin::PC();
// 		FFDEBUG($username);
		if (!$username) {
			throw new Exception('请登录后回复');
		}
		$user=getData('user',array('usr_name'=>$username));//TODO
		$this->user_id=$user['usr_id'];//用户ID
	}
	/**
	 * 数据准备
	 */
	function data(){
		$data=array();
		$data['rplcmt_content'] = $this->post['content'];//回复内容，来自post参数
		$data['rplcmt_user_id']=$this->user_id;//来自自动登录模块
		$data['rplcmt_time']=time();//来自系统
		$data['rplcmt_cmt_id']=$this->cmt_id;//来自get参数
		$this->data=$data;
		//FFDEBUG($this->data);
	}
	function store() {
		$result=$this->cmtrplModel->add($this->data);
// 		FFDEBUG($result);
		if(!$result){
			return '回复失败！';
		}else{
			return $this->data;
		}
	}
	/**
	 * 启动对象<br/>用户评论回复类
	 * @param array $get 来自$_GET的数组
	 * @param array $post 来自$_POST的数组
	 * @throws Exception 1.$get必须为数组;2.$post必须为数组;3.cmt_id不能为空
	 * @return Ambigous <string, multitype:>
	 */
	static function GO($get, $post) {
		$a=new addCmtReply($get, $post);
		if (is_array($get)) {
			$a->get=$get;
		}else{
			throw new Exception('内部错误：$get必须为数组');
		}
		if (is_array($post)) {
			$a->post=$post;
		}else{
			throw new Exception('内部错误：$post必须为数组');
		}
		if (!$a->cmt_id) {
			throw new Exception('内部错误：cmt_id不能为空');
		}
		$a->data();
// 		FFDEBUG($a->data);
		return $a->store();
	}
}