<?php
class figure {
	public $figureModel;
	
	function __construct(){
		$this->figureModel=M('figure');
	}
	function storeFigure($srcurl){
		$dynpage= fopen($srcurl, 'r');//从网络读取
		$picstring=fread($dynpage, 1024*10240);
		$picstring=addslashes($picstring);
		$data['fg_user_id']=1;
		$data['fg_url']='xxx';
		$data['fg_rs']=$picstring;
		$this->figureModel->add($data);
	}
	static function GO($srcurl){
		$fg=new figure();
// 		$fg->storeFigure($srcurl);
		$fg->readFigure();
	}
	
	function readFigure() {
		$rst=$this->figureModel->find();
		echo ($rst['fg_rs']);
// 		header("content-type:image/jpg");
		
	}
}