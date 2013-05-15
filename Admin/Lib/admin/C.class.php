<?php
class C {//TODO
	public $db;
	function __construct() {
		$this->ip = get_client_ip();
		import('@.admin.Sqlite');
		$this->db=Sqlite::GO(C('DB'));//把数据库后缀人为地改成php
		$num=$this->db->query("SELECT count(*) as num FROM sqlite_master WHERE type='table' AND name='config'");//check whether the table exist
		$num=$num[0]['num'];
		if(!$num){//if not exist, create it
			$this->db->query('CREATE TABLE config (name varchar(20), value varchar(512))');
		}
	}
	/**
	 * 设定配置值
	 * @param string $name
	 * @param any $value 将会被编码为json存储
	 * @return Ambigous <multitype:, NULL, false, boolean>
	 */
	function set($name, $value) {
		$value=json_encode($value);
		$value=base64_encode($value);
		$this->db->query('DELETE FROM config WHERE name = "'.$name.'"');
		$result=$this->db->query('INSERT INTO config(name, value) values("'.$name.'", \''.$value.'\')');
		return $result;
	}
	/**
	 * 获取配置值
	 * @param string $name 配置名
	 * @return mixed 从json解析而来
	 */
	function get($name) {
		$result=$this->db->query('select value from config where name="'.$name.'"');
		return json_decode(base64_decode(($result[0]['value'])));
	}
	/**
	 * 设置
	 * @return config
	 */
	static function S($name, $value){
		$c= new C();
		return $c->set($name, $value);
	}
	static function G($name) {
		$c= new C();
		return $c->get($name);
	}
}