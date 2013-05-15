<?php
class getFigure{
	public $figure;
	
	function __construct() {
		$this->figure=M('figure');
	}
	
	function get($p) {
		$userid=$p;
		$figuretable=$this->figure->where('fg_user_id="'.$userid.'"')->find();
		if ($figuretable['fg_type']=='1') {
			$usr_figure=$figuretable['fg_url'];
			if (!$usr_figure) {
				$usr_figure=C('WWW_PATH').'Public/img/figure_f.png';//女头像
			}
		}elseif ($figuretable['fg_type']=='2'){
			;//TODO来自资源
		}else {
			$u=getData('user', array('usr_id'=>$userid));
			if ($u['usr_sex']=='男') {
				$usr_figure=C('WWW_PATH').'Public/img/figure_m.png';//男头像
			}else {
				$usr_figure=C('WWW_PATH').'Public/img/figure_f.png';//女头像
			}
		}
		return $usr_figure;
	}
	/**
	 * 获取用户图像的url
	 * @param int $p 用户ID
	 */
	static function GO($p) {
		$f=new getFigure();
		return $f->get($p);
	}
}