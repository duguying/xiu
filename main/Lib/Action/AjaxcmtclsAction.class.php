<?php
/**
 * 评论分页Ajax响应<br/>
 * 调用http://localhost/aixuanxiu/ajaxcmt/page/2.do
 * @author 李俊
 *
 */
class AjaxcmtclsAction extends Action {
	public $userid;
	public $cls_id;
	
	function _initialize(){
		import('@.Yuol.conf');
		$this->assign('config', conf::GO());
		import('@.Yuol.autoLogin');
		$this->userid=autoLogin::PC();
	}
	/**
	 * 评论分页页面<br/>
	 * 调用http://localhost/aixuanxiu/ajaxcmtcls/page/cls2/pg1.do
	 */
	function page() {
		$page=@$_GET['_URL_'][3];//获取课程
		$this->cls_id=@$_GET['_URL_'][2];//获取页码
		if ($page==null) {//页面参数为空时，强制将页面设置为1
			$page=1;
		}
		$result=$this->fenye($page);
		
		import('@.Yuol.preCmt');
		$result=preCmt::GO($result);
		$this->assign('result', $result);
		import('@.Yuol.cmtTail');
		$tail=cmtTail::GO($page, $this->getPages());//生成尾部页码导航
		$this->assign('tail', $tail);
		$this->assign('verify', U('tools/verify'));//验证码
		$this->assign('userid',$this->userid);//用户id
		
		
		$this->display();
	}
	/**
	 * 获取当前分页的内容
	 * @param int $page 页码，从1开始
	 * @return 返回二维的内容数组 Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	private function fenye($page){
		$page=(int)$page;//数据预处理为int
		$totalPages=$this->getPages();//获得总页面
		if ($page<0) {//限定页面范围
			$page=0;
		}elseif ($page>$totalPages){
			$page=$totalPages;
		}
		$cmt = D("Comment");
		$start=($page-1)*8;//按8页分页
		return $cmt->relation(true)->where('cmt_class_id='.$this->cls_id)->order('cmt_time desc')->limit($start,8)->select();
	}
	/**
	 * 获取表中数据的总页数
	 * @return number 返回页数
	 */
	private function getPages() {
		$cmt = M("Comment");
		$tmp1=$cmt->query('select count(*) as "0" from xiu_comment where cmt_class_id="'.$this->cls_id.'"');
		$counts=$tmp1[0][0];
		$counts=(int)$counts;
		if ($counts%8==0) {
			$pages=(int)($counts/8);
		}else{
			$pages=(int)($counts/8)+1;//每页8条
		}
		return $pages;
	}

}
?>
