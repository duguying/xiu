<?php
/**
 * 管理员管理
 * @author rexlee李俊
 */
class AdminAction extends Action{
	public $adminModel;
	function _initialize() {
		import("@.admin.AdminLib");
		$this->adminModel=M("admin");
		$this->assign("root",C("WWW_PATH"));
		$this->assign("tpl",C("TPL_PATH"));
	}
	function index() {
		$admin=$this->adminModel->select();
		$this->assign("admin",$admin);
		$this->display();
	}
	/**
	 * 添加管理员
	 */
	function add() {
		$username=$_POST["username"];
		$password=$_POST["password"];
		$nickname=$_POST['nickname'];
		$grade=$_POST['grade'];
	
		if ($username=='super') {
			$this->show('此用户名被系统保留！<br>');
			$msg='错误，正在自动跳回……
			<script>
					window.setTimeout(function(){window.location.href="'.U("admin/index").'";},3000);
			</script>';
			$this->show($msg);
			return ;//程序截断
		}
		
		if (!AdminLib::addChk($_POST)) {//检查没通过
			$msg='错误，正在自动跳回……
			<script>
					window.setTimeout(function(){window.location.href="'.U("admin/index").'";},3000);
			</script>';
			$this->show($msg);
			return ;//程序截断
		}
		$rec=$this->adminModel->where(array("username"=>$username))->find();
		if ($rec) {
			$msg='<font color="red">管理员'.$username.'存在</font>，请修改管理员用户名，正在自动跳回……
			<script>
					window.setTimeout(function(){window.location.href="'.U("admin/index").'";},3000);
			</script>';
			$this->show($msg);
			return ;//程序截断
		}
		$data=array(
				"username"=>$username,
				"password"=>$password,
				"nickname"=>$nickname,
				"grade"=>$grade
		);
		$this->adminModel->add($data);
	}
	/**
	 * 管理员详情
	 */
	function detail() {
		;
	}
	/**
	 * 修改管理员信息
	 */
	function modify() {
		$userid=$_POST["userid"];
		$username=$_POST["username"];
		$password=$_POST["password"];
		$nickname=$_POST['nickname'];
		$grade=$_POST['grade'];
		if (!AdminLib::updateChk($_POST)) {
			$msg='修改错误，正在自动跳回……
			<script>
					window.setTimeout(function(){window.location.href="'.U("admin/index").'";},3000);
			</script>';
			$this->show($msg);
			return ;//程序截断
		}
		$data=array(
// 				"username"=>$username,//用户名不可修改
				"password"=>$password,
				"nickname"=>$nickname,
				"grade"=>$grade
		);
		$result=$this->adminModel->where(array("$userid"=>$$userid))->save($data);//根据用户ID修改信息
		if ($result) {
			$this->show("修改成功<br>");
		}else {
			$this->show("修改失败<br>");
		}
	}
}