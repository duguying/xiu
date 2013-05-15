<?php
/**
 * 模版简单渲染类
 * @author <a href="mailto:duguying2008@gmail.com">李俊</a>
 *
 */
class tpl{
	/**
	 * 模版路径
	 * @var string
	 */
	public $tpl_path;
	/**
	 * 输出值
	 * @var data:string
	 */
	public $output;
	/**
	 * 输出路径
	 * @var string
	 */
	public $output_path;
	/**
	 * 模版简单渲染类-实例化
	 * @param string $tpl_path 模版路径 
	 * @return tpl 当前对象
	 */
	static function GO($tpl_path){
		return new tpl($tpl_path);
	}
	/**
	 * 构造函数
	 * @param string $path 模版路径 
	 */
	function __construct($path){
		$this->tpl_path=$path;
	}
	/**
	 * 变量传值
	 * @param string $param_name 模版变量名
	 * @param string $value 模版值
	 * @return tpl 当前对象
	 */
	function assign($param_name, $value) {
		$tpl_path='./tpl.txt';
		$tpl_content=file_get_contents($tpl_path);
		$this->output=preg_replace('/{\$'.$param_name.'}/', $value, $tpl_content);
		return $this;
	}
	/**
	 * 保存渲染结果
	 * @param string $path 保存路径
	 * @return tpl 返回当前对象
	 */
	function save($path) {
		$this->output_path=$path;
		file_put_contents($this->output_path, $this->output);
		return $this;
	}
	/*
	 * 浏览器中显示当前结果
	 */
	function show() {
		header('location:'.$this->output_path);
	}
}