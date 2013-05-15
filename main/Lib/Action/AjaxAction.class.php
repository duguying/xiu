<?php
class AjaxAction extends Action {
	function share() {
		$this->display('./main/Tpl/ziliao/part_share.html');
	}
	function test() {
		var_dump(headers_list());
	}
}