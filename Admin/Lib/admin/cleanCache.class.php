<?php
/**
 * 清除缓存
 * @author Administrator
 *
 */
class cleanCache{
	private $cache_dir_path;
	/**
	 * 清除缓存-实例化对象<br/>
	 * 成功则返回true,失败或部分成功返回false;
	 * @param string $AppName
	 * @return boolean
	 */
	static function GO($AppName){
		$c=new cleanCache($AppName);
		$r=$c->del();
		$c->security();
		if (!$r) {
			return false;
		}else{
			return false;
		}
	}
	/**
	 * 
	 * @param string $AppName 应用名
	 */
	function __construct($AppName) {
		$this->cache_dir_path='./'.$AppName.'/Runtime/Cache/';
		
	}
	/**
	 * 删除缓存文件
	 * 只要有一个文件删除失败就返回false
	 * @return boolean
	 */
	function del() {
		//load('@.adminfunction');
		$result=true;
		$items=ls($this->cache_dir_path);
		foreach ($items['file'] as $file) {
			$r=unlink($this->cache_dir_path.$file);
			if (!$r) {
				$result=$r;
			}
		}
		return $result;
	}
	/**
	 * 写入目录保护文件
	 */
	function security() {
		import('@.admin.tpl');
		tpl::GO('./Admin/Public/Tpl/index.tpl')
				->assign('www', C('WWW_PATH'))
				->save($this->cache_dir_path.'index.html');
	}
}