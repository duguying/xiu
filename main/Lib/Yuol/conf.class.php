<?php
/**
 * 输出配置参数
 * @author 李俊
 *
 */
class conf{
	public $conf;
	
	function __construct() {
		$this->conf=array();
		$conf['root']=C('WWW_PATH');
		$conf['url_model']=C('URL_MODEL');
		$conf['url_html_suffix']=C('URL_HTML_SUFFIX');

		import('@.Yuol.autoLogin');
		$conf['username']=autoLogin::PC();
		$user=getData('user',array('usr_name'=>$conf['username']));
		$conf['userid']=$user['usr_id'];

		$this->conf=$conf;
	}
	
	static function GO() {
		$c=new conf();
		return $c->conf;
	}
}