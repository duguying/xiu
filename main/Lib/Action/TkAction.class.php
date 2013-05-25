<?php
/**
 * Talk类-“说一句”板块
 * @author 李俊
 *
 */
class TkAction extends Action{
	public $talkModel;
	
	function __construct() {
		import('@.Yuol.talk');
		$this->talkModel=M('talk');
	}
	/**
	 * 获取一条数据
	 */
	function gt() {
		var_dump(talk::GET1($_GET['t']));
	}
	/**
	 * 获取五条数据
	 */
	function ls() {
		$tk=talk::GET5($_GET['t']);
		cookie('tk', time());
		dump($tk);
		if($tk){
			$this->assign('tk', $tk);
			$this->display();
		}
	}
	/**
	 * 添加记录，发表记录
	 */
	function ad(){
		try {
			$result=talk::ADD($_POST['c']);
			if($result){
				$this->ajaxReturn(true);
			}
		} catch (Exception $e) {
			$this->ajaxReturn(false);
		}
	}
	/**
	 * renew 补漏刷新
	 */
	function rn(){
    	$this->assign('tk',talk::GET5(0));
		$this->display('./main/Tpl/index/talk_all.html');
	}
	
}