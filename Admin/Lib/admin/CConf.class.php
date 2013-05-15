<?php
/**
 * 配置文件读取及修改类<br>
 * 读取配置文件；修改配置文件
 * @author <a href="mailto:duguying2008@gmail.com">李俊</a>
 * @package admin
 *
 */
class CConf{
	public $content;
	public $path;
	/**
	 * 配置文件读取及修改类
	 * @param string $AppName 项目名：必须
	 * @param string $ConfigFile 配置文件名：默认为config;自动添加.php后缀
	 * @throws Exception 指定的配置文件不存在时抛出异常
	 */
	function __construct($AppName, $ConfigFile){
		if (!$ConfigFile||$ConfigFile=='') {
			$ConfigFile='config';
		}
		$this->path='./'.$AppName.'/Conf/'.$ConfigFile.'.php';
		if (is_dir($this->path)||!file_exists($this->path)) {
			throw new Exception('指定的配置文件不存在！');
		}else{
			$this->content=file_get_contents($this->path);
		}
	}
	/**
	 * 执行函数<br/>
	 * 当$content参数为null或只有一个参数时执行读取操作<br/>
	 * 当$content参数存在且不为null时执行写入操作<br/>
	 * 注意：写入操作将会覆盖原有的所有数据
	 * @param string $AppName 应用配置路径
	 * @param string $content=null 写入值
	 * @throws Exception 路径参数错误时抛出异常，路径参数格式Appname/Configfile
	 * @return string|number 读取操作时返回读取内容，写入操作时返回int型
	 */
	public static function C($appconf, $content=null) {
		$tmp=explode('/',$appconf);
		if ($tmp[0]==''||!$tmp[0]) {
			throw new Exception('路径参数错误！');
		}
		$c=new CConf($tmp[0], $tmp[1]);
		if (!$content) {
			return $c->content;
		}else{
			return file_put_contents($c->path, $content);
		}
	}
}