<?php
/*Created By RexLee
**PHP file MySQL.php 2012-12-19 
*/
/**
 * MySQL数据库操作基本类
 * @author 李俊
 *
 */
class MySQL{
	private $host;
	private $name;
	private $password;
	private $dbname;		//数据库名
	private $link;
	private $errlog=array();
	public $errreport=true;//开启错误报告
	private $runStat;//运行状态，记录当前运行的成员
	private $value;//结果

	public function __construct($server,$dbuser,$psw){//连接主机
		$this->host=$server;
		$this->name=$dbuser;
		$this->password=$psw;
		$this->link=@mysql_connect($this->host,$this->name,$this->password) or die('<font color="red">ERROR: <b><em>数据库主机连接失败！<em></b></font><br/>');
		$this->runStat="init";//定义为初始化
		$this->fn=0;
	}
	/**
	 * 解析为二维数组
	 * @return MySQL
	 */
	public function dump(){//构造二维数组
		/////////////检测//////////////////
		if(!is_resource($this->value)){
			array_push($this->errlog, "ERROR: <em>运行错误，在<font color=\"red\"><b>to2DArray</b></font>层调用错误的方法<em><br/>");
			$this->runStat="error";//将运行状态设置为错误
			return $this;
		}
		$this->runStat="to2DArray";
		/////////////////////////////////////
		$_2DArray=Array();
		while($row=@mysql_fetch_array($this->value)){//直接取value值，此时的value应当为resource类型
			$keyarr=array_keys($row);
			foreach ($keyarr as $key) {
				if (is_int($key)) {
					unset($row[$key]);//去掉以数组为键名的数组元素
				};
			}
			array_push($_2DArray, $row);
		}
		$this->value=$_2DArray ;
		return $this;
	}
	/**
	 * 连接数据库
	 * @param string $database 数据库名
	 * @param string $charset 字符集
	 * @return MySQL
	 */
	public function db($database,$charset){//连接数据库
		/////////////检测//////////////////
		if(!is_resource($this->link)){
			array_push($this->errlog, "ERROR: <em>运行错误，在<font color=\"red\"><b>db</b></font>层调用错误的方法<em><br/>");
			$this->runStat="error";//将运行状态设置为错误
			return $this;
		}
		$this->runStat="db";
		/////////////////////////////////////
		$this->dbname=$database;
		mysql_query("set names ".$charset);//设置字符集
		$this->value=mysql_select_db($this->dbname,$this->link);
		if (!$this->value) {
			echo "<font color=\"blue\"><b>ERROR:打开数据库错误！</b></font><br/>";
			$this->runStat="error";
		}
		return $this;
	}
	/**
	 * 执行SQL语句
	 * @param string $sql SQL语句
	 * @return MySQL
	 */
	public function query($sql) {
		/////////////检测//////////////////
		if(!is_string($sql)){
			array_push($this->errlog,"ERROR: <em>运行错误，在<font color=\"red\"><b>query</b></font>层调用错误的方法<em><br/>");
			$this->runStat="error";//将运行状态设置为错误
			return $this;
		}
		$this->runStat="query";
		/////////////////////////////////////
		$sql=addslashes($sql);//防注入
		$result=mysql_query($sql);
		if (!$result) {
			array_push($this->errlog,"ERROR: <em><b style=\"color:red;\">语句运行错误！</b></em></br>");
			$this->runStat="sqlerror";
		}
		$this->value=$result;
		return $this;
	}
	/**
	 * 取得数据库操作的当前值
	 * @return Ambigous <NULL, multitype:, boolean, resource>
	 */
	function value() {
		if ($this->errreport&&($this->runStat!="error")) {
			foreach ($this->errlog as $value) {
				echo $value;
			}
		}
		$this->runStat="init";
		$this->errlog=array();//clean
		$result=$this->value;
		$this->value=null;//clean
		return $result;
	}
	/**
	 * 错误方法吸收
	 * @param string $f 方法名
	 * @param string $v 变量名
	 * @return MySQL
	 */
	public function __call($f,$v){//错误方法吸收
		echo "<font color=\"red\"><b>ERROR</b></font>: 不存在".$f."()方法. <br/>";
		$this->runStat="error";
		return $this;
	}
	
	static public function data($server, $dbuser, $psw) {
		$d=new MySQL($server, $dbuser, $psw);
		return $d;
	}
}

// var_dump(MySQL::data('localhost', 'root', 'lijun')->db('ip', 'utf8')->query('SELECT * FROM ip LIMIT 0 , 2')->dump()->value());
?>