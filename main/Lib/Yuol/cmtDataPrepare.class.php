<?php
/**
 * 评论分页第一页数据准备，与AjaxCmtAction类的内容相同
 * @author 李俊
 *
 */
class cmtDataPrepare {
	/**
	 * 评论分页页面数据
	 */
	function page() {
		$page=1;
		$result=$this->fenye($page);
		import('@.Yuol.preCmt');
		$result=preCmt::GO($result);
		import('@.Yuol.cmtTail');
		$tail=cmtTail::GO($page, $this->getPages());//生成尾部页码导航
		return array('result'=> $result, 'tail'=>$tail);
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
		return $cmt->relation(true)->order('cmt_time desc')->limit($start,8)->select();
	}
	/**
	 * 获取表中数据的总页数
	 * @return number 返回页数
	 */
	private function getPages() {
		$cmt = M("Comment");
		$counts=$cmt->query('select count(*) as "0" from xiu_comment');
		$counts=$counts[0][0];
		$counts=(int)$counts;
		if ($counts%8==0) {
			$pages=(int)($counts/8);
		}else{
			$pages=(int)($counts/8)+1;//每页8条
		}
		return $pages;
	}
	/**
	 * 实例化cmtDataPrepare，生成评论分页第一页数据
	 * @return array('result'=>评论板块数据, 'tail'=>尾部页码导航html片段)
	 */
	static function GO() {
		$c=new cmtDataPrepare();
		return $c->page();
	}
}

?>