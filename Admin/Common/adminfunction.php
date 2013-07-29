<?php
/**
 * 列出目录下的所有文件及文件夹
 * @param string $path 路径
 * @return array
 * @author <a href="mailto:duguying2008@gmail.com">李俊</a>
 */
function ls($path) {
	if (!is_dir($path)) {
		throw new Exception('指定目'.$path.'录不存在！');
	}
	$handle = opendir($path);
	$dirArray=array();
	$fileArray=array();
	while (false !== ($file = readdir($handle))) {
	        if (is_dir($file)) {
	        	array_push($dirArray, $file);
	        }else{
	        	array_push($fileArray, $file);
	        }
	    }
	return array('dir'=>$dirArray, 'file'=>$fileArray);
}
/**
 * 将ip地址去掉点，然后转化为int型数据，支持4位标准ip和3位ip域
 * @param string $ip IP地址
 * @return number
 */
function ip2int($ip) {
	$tmp=explode('.',$ip);
	if (4==count($tmp)) {
		return (int)$tmp[0]*1000000000+(int)$tmp[1]*1000000+(int)$tmp[2]*1000+(int)$tmp[3];
	}elseif(3==count($tmp)){
		return (int)$tmp[0]*1000000+(int)$tmp[1]*1000+(int)$tmp[2];
	}
}
/**
 * 超级管理员验证
 */
function supA($user,$psw){
	$key=file_get_contents("C:\\supA.xiu");//请将超级管理员密码文件放到非网站目录下
	if ($user=="admin"&&$psw==$key) {
		return true;
	}else {
		return false;
	}
}