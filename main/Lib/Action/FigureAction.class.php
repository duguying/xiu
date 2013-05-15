<?php
/**
 * 头像显示测试类
 */
class FigureAction extends Action{
	function test(){
		$srcurl='http://localhost/aixuanxiu/Public/img/te.jpg';
		import('@.Yuol.figure');
		figure::GO($srcurl);
	}
}