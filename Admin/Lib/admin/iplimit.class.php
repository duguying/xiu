<?php
/**
 * ip限制类
 * @author 李俊
 *
 */
class iplimit {
	public $db;
	function __construct() {
// 		import('@.admin.Sqlite');
// 		$this->db=Sqlite::GO(C('DB'));
// 		$num=$this->db->query("SELECT count(*) as num FROM sqlite_master WHERE type='table' AND name='ip'");//check whether the table exist
// 		$num=$num[0]['num'];
// 		if(!$num){//if not exist, create it
// 			$this->db->query('CREATE TABLE ip (ip int(20))');
// 		}
// 		$num1=$this->db->query("SELECT count(*) as num FROM sqlite_master WHERE type='table' AND name='ips'");//check whether the table exist
// 		$num1=$num1[0]['num'];
// 		if(!$num1){//if not exist, create it
// 			$this->db->query('CREATE TABLE ips (ips int(15))');
// 		}
		$this->db=M("admin_iplimit");//限制IP表
	}
	/**
	 * 不存在则返回false
	 * @param string $table 表名
	 * @param array $where=array('key'=>'value') 条件数组
	 * @throws Exception 条件数组格式错误时抛出异常
	 * @return Ambigous <multitype:, NULL, boolean>
	 */
	private function chk_exist($table=null, $where){
		if (!is_array($where)) {
			throw new Exception('内部错误！$where必须为键值对条件数组！');
		}
		$key=array_keys($where);
		$key=$key[0];
		$value=$where[$key];
		$result=$this->db->query('select '.$key.' from '.$table.' where '.$key.'="'.$value.'"');
		if (is_array($result)) {
			return true;
		}else{
			return false;
		}
	}
	/**
	 * 添加ip记录
	 * @param string $ip ip地址
	 * @throws Exception 所添加的ip地址已经存在
	 * @return boolean 添加成功返回true，失败返回false
	 */
	function addip($ip){
		////load('@.adminfunction');
		$ip=ip2int($ip);
		if(!$this->chk_exist('ip', array('ip'=>$ip))){
			return $this->db->query('insert into ip values('.$ip.')');
		}else{
			throw new Exception('内部错误！ip地址已经存在！');
		};
	}
	/**
	 * 添加ip域记录，ip域指的是去掉第4段的ip，格式xxx.xxx.xxx
	 * @param string $ips ip域,格式xxx.xxx.xxx
	 * @throws Exception ip域格式不对时抛出异常，ip域已经存在时抛出异常。
	 * @return boolean 返回false时错误，true时正常
	 */
	function addips($ips) {
		$tmp=explode('.',$ips);
		if(3!=count($tmp)){
			throw new Exception('不是ip域！');
		}
		$ips=ip2int($ips);
		if(!$this->chk_exist('ips', array('ips'=>$ips))){
			return $this->db->query('insert into ips values('.$ips.')');
		}else{
			throw new Exception('内部错误！ip地址域已经存在！');
		};
	}
	function get($ip){
		$arr=explode('.', $ip);
		$ip=ip2int($ip);
		$ips=$arr[0]*1000000+$arr[1]*1000+$arr[2];
		if(!$this->chk_exist('ips', array('ips'=>$ips))&&!($this->chk_exist('ip', array('ip'=>$ip)))){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 从表中获取指定IP，如果存在则返回true，否则返回false<br/>
	 * 即IP被禁则返回false，否则返回true
	 * @param string $ip IP
	 * @return boolean
	 */
	static function G($ip) {
		$i=new iplimit();
		return $i->get($ip);
	}
	static function GO(){
		return new iplimit();
	}
}