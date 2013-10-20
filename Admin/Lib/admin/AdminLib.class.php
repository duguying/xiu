<?php
/**
 * AdminAction使用的预处理库
 */
class AdminLib{
	function _initialize() {
		;
	}
	/**
	 * 检查添加用户时提交的数据是否合法
	 * @param array $param $_POST数组
	 */
	static public function addChk($param) {
		if (!is_array($param)) {
			throw new  Exception("The param must be Array. ");
		};
		$result=true;
		if (empty($param["username"])||!$param["username"]) {//为空或不存在
			echo '<font color="red">管理员用户名必填！</font><br>';
			$result=false;
		}
		if (empty($param["password"])||!$param["password"]) {
			echo '<font color="red">管理员密码必填！</font><br>';
			$result=false;
		}
		return $result;
	}
	/**
	 * 修改管理员信息
	 * @param unknown $param $_POST数组
	 * @throws Exception 参数非数组，抛出异常
	 * @return boolean 检查通过true
	 */
	static public function updateChk($param) {
		if (!is_array($param)) {
			throw new  Exception("The param must be Array. ");
		};
		$result=true;
		if (empty($param["password"])||!$param["password"]) {
			echo '<font color="red">管理员密码必填！</font><br>';
			$result=false;
		}
		return $result;
	}
	
}