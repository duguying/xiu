<?php
class C {//TODO
	public $db;
	function _initialize() {
		$this->ip = get_client_ip();
		$this->db=M('config');
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
		$this->db->where(array('name'=>$name))->delete();
		$data['name']=$name; 
		$data['value']=$value;
		$result=$this->db->add($data);
		return $result;
	}
	/**
	 * 获取配置值
	 * @param string $name 配置名
	 * @return mixed 从json解析而来
	 */
	function get($name) {
		$result=$this->db->where(array('name'=>$name))->find();
		return json_decode(base64_decode(($result['value'])));
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