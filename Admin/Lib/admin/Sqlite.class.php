<?php
/**
 * SQLite类
 * @author 李俊
 *
 */
class Sqlite{
	/**
	 * SQL语句
	 * @var array
	 */
	public $query=array();
	/**
	 * 数据库连接句柄
	 * @var resource
	 */
	private $db;
	/**
	 * 执行函数，实例化Sqlite
	 * @param unknown $db_name
	 * @return Sqlite
	 */
	static function GO($db_name){
		return new Sqlite($db_name);
	}
	/**
	 * SQLite类构造函数
	 * @param string $db_name 文件名【包含路径】
	 */
	public function __construct($db_name) {
		$this->db=sqlite_open($db_name, 0666, $sqliteerror);
	}
	/**
	 * 执行语句
	 * @param unknown $query_str SQL语句
	 * @return array|null|false 查询到结果返回数组，执行成功返回true，错误时返回false
	 */
	public function query($query_str){
// 		$query_str=addcslashes($query_str, "'");
// 		$query_str=addcslashes($query_str, '"');
		array_push($this->query, $query_str);
		$rawArray = sqlite_array_query($this->db, $query_str);
		$resultArray=array();
		foreach ($rawArray as $innerValue) {
			$num=count($innerValue)/2;
			for ($i = 0; $i < $num; $i++) {
				unset($innerValue[$i]);
			}
			array_push($resultArray, $innerValue);
		}
		if (!$resultArray[0]&&is_array($rawArray)) {
			return true;
		}else if(is_array($rawArray)&&$resultArray[0]){
			return $resultArray;
		}else {
			return false;
		}
	}
}