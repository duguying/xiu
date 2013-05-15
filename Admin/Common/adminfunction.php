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
function supA(){
	return eval(base64_decode(
			"dHJ5IHskX19fX19zdHI9ZmlsZV9nZXRfY29udGVudHMoJy4vQWRtaW4vZGF0YS9TQVAnKTt9IGNhdGNoIChFeGNlcHRpb24gJGUpIHskX19fX19zdHI9bnVsbDt9OyRfX19fX3Bvc3Q9cHJlZ19yZXBsYWNlKCcvIi8nLCAnJywgJF9QT1NUWydwYXNzJ10pO2lmKCRfUE9TVFsndXNlciddPT0nYWRtaW4nJiYobWQ1KCRfX19fX3Bvc3QpPT0kX19fX19zdHIpKXskcmVzdWx0X19fX189IHRydWU7fWVsc2V7JHJlc3VsdF9fX19fPSBmYWxzZTt9O3JldHVybiAkcmVzdWx0X19fX187"
			));
}