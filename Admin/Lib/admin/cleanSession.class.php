<?php
class cleanSession{
	/**
	 * session目录
	 * @var string
	 */
	public $session_dir_path;
	/**
	 * 实例化cleanSession类<br/>
	 * 删除失败或部分成功都返回false，完全成功返回true
	 * @return boolean
	 */
	static function GO(){
		$s=new cleanSession();
		$r=$s->del();
		$s->security();
		return $r;
	}
	/**
	 * 若session路径在本站则返回路径。否则null
	 * @return string
	 */
	static public function ISABLE(){
		$cs=new cleanSession();
		return $cs->session_dir_path;
	}
	function __construct() {
		$conf=include_once 'main/Conf/config.php';
		if (!$conf['SESSION_PATH']) {
			throw new Exception('没有指定session路径，当前使用的是系统默认路径，不能清空session!');
		}
		$this->session_dir_path=$conf['SESSION_PATH'];
	}
	/**
	 * 删除session<br>
	 * 只要有一个文件删除失败就返回false
	 * @return boolean
	 */
	function del() {
		$result=true;
		$items=ls($this->session_dir_path);
		foreach ($items['file'] as $file) {
			$r=unlink($this->session_dir_path.$file);
			if (!$r) {
				$result=$r;
			}
		}
		return $result;
	}
	/**
	 * 写入目录保护
	 */
	function security() {
		import('@.admin.tpl');
		tpl::GO('./Admin/Public/Tpl/index.tpl')
				->assign('www', C('WWW_PATH'))
				->save($this->session_dir_path.'index.html');
	}
}