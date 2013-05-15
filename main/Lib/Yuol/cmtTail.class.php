<?php
/**
 * 生成Comment的尾部分页导航
 * @author 李俊
 *
 */
class cmtTail{
	private $currentPage;
	private $totalPage;
	
	/**
	 * 生成页码导航--总控函数
	 * @param string $currentPage 当前页码
	 * @param string $totalPage 总页数
	 * @throws Exception 页码小于1将会抛出异常
	 * @return string
	 */
	function __do($currentPage, $totalPage) {
		$this->currentPage=$currentPage;
		$this->totalPage=$totalPage;
		if($this->totalPage<=10){//总页数小于等于10页
			if($this->currentPage==1){//当前页是第一页
				$str='上一页'.$this->currentTag();
				for ($i = 2; $i <= $this->totalPage; $i++) {
					$str=$str.$this->commonTag($i);
				}
				$str=$str.$this->next();
			}elseif ($this->currentPage==$this->totalPage){//已跳至最后一页
				$str=$this->up();
				for ($i = 1; $i <= $this->totalPage-1; $i++) {
					$str=$str.$this->commonTag($i);
				}
				$str=$str.$this->currentTag();
				$str=$str.$this->next();
			}else{
				$str=$this->up();
				for($i=1; $i<$this->currentPage; $i++){
					$str=$str.$this->commonTag($i);
				}
				$str=$str.$this->currentTag();//生成当前页标签
				for ($i = $this->currentPage+1; $i <= $this->totalPage; $i++) {
					$str=$str.$this->commonTag($i);
				}
				$str=$str.$this->next();
			}
		}elseif ($this->totalPage>10){//页码大于10
			if($this->currentPage==1){//8+2
				$str='上一页'.$this->currentTag();
				for ($i = 2; $i <= 8; $i++) {
					$str=$str.$this->commonTag($i);
				}
				$str=$str.'...';//添加省略号
				$str=$str.$this->commonTag($this->totalPage-1);
				$str=$str.$this->commonTag($this->totalPage);
			}elseif($this->currentPage==$this->totalPage) {//当前为最后一页
				$str=$this->up();
				$str=$str.$this->commonTag(1);
				$str=$str.'...';//添加省略号
				for ($i = $this->totalPage-6; $i < $this->totalPage; $i++) {
					$str=$str.$this->commonTag($i);
				}
				$str=$str.$this->currentTag();
				$str=$str.$this->next();
			}else {
				if ($this->currentPage<6) {
					$str=$this->up();
					for ($i = 1; $i < $this->currentPage; $i++) {
						$str=$str.$this->commonTag($i);
					}
					$str=$str.$this->currentTag();
					for ($i = $this->currentPage+1; $i <= 7; $i++) {
						$str=$str.$this->commonTag($i);
					}
					$str=$str.'...';//添加省略号
					$str=$str.$this->commonTag($this->totalPage);
					$str=$str.$this->next();
				}else {
					if ($this->currentPage>=$this->totalPage-4) {
						$str=$this->up();
						$str=$str.$this->commonTag(1);
						$str=$str.'...';//添加省略号
						for ($i = $this->totalPage-6; $i < $this->currentPage; $i++) {
							$str=$str.$this->commonTag($i);
						}
						$str=$str.$this->currentTag();
						for ($i = $this->currentPage+1; $i <= $this->totalPage; $i++) {
							$str=$str.$this->commonTag($i);
						}
						$str=$str.$this->next();
					}elseif ($this->currentPage<$this->totalPage-4){//1+5+1
						$str=$this->up();
						$str=$str.$this->commonTag(1);
						$str=$str.'...';//添加省略号
						$str=$str.$this->commonTag($this->currentPage-2);
						$str=$str.$this->commonTag($this->currentPage-1);
						$str=$str.$this->currentTag();
						$str=$str.$this->commonTag($this->currentPage+1);
						$str=$str.$this->commonTag($this->currentPage+2);
						$str=$str.'...';//添加省略号
						$str=$str.$this->commonTag($this->totalPage);
						$str=$str.$this->next();
					}
				};
			}
		}elseif ($this->totalPage<=0){
			throw new Exception("页面不可能小于1");
		}
		return $str;
	}
	/**
	 * 一般标签
	 * @param int $param 页码
	 * @return string
	 */
	function commonTag($param) {
		return '<a page="'.$param.'">'.$param.'</a>';
	}
	/**
	 * 生成当前页标签
	 * @param int $param 页码
	 * @return string
	 */
	function currentTag() {
		return '<strong id="on">'.$this->currentPage.'</strong>';
	}
	/**
	 * 生成下一页标签
	 * @param int $param 下一页页码
	 * @return string
	 */
	function next() {
		if ($this->currentPage==$this->totalPage) {
			return '下一页';
		}
		return '<a page="'.($this->currentPage+1).'">下一页</a>';
	}
	/**
	 * 生成上一页标签
	 * @param int $param 上一页页码
	 * @return string
	 */
	function up() {
		if ($this->currentPage==1){
			return '上一页';
		}else{
			return '<a page="'.($this->currentPage-1).'">上一页</a>';
		}
	}
	/**
	 * 实例化cmtTail,
	 * 功能：生成Comment的尾部分页导航
	 * @param string $currentPage 当前页码
	 * @param string $totalPage 总页数
	 * @return string 返回html标签字符串
	 */
	static function GO($currentPage, $totalPage) {
		$p=new cmtTail();
		return $p->__do($currentPage, $totalPage);
	}
}
