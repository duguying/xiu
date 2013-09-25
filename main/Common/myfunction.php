<?php 
/**
 * 个人函数库
 * @author 李俊
 */

/**
 * 获取网站的根目录，例如http://localhost/aixuanxiu
 * @return string 返回根目录
 */
function getRoot() {
	return 'http://'.$_SERVER['HTTP_HOST'].C('WWW_PATH');
}
/**
 * 判断用户浏览器类型
 * @return string 返回值有chrome,ie,firefox,yuol,unknown五种
 */
function getBrowser() {
	$ua=$_SERVER['HTTP_USER_AGENT'];
	switch (true) {
		case preg_match('/Chrome/i', $ua):
			$browser='chrome';
			break;
		case preg_match('/MSIE/i', $ua):
			$browser='ie';
			break;
		case preg_match('/Firefox/i', $ua):
			$browser='firefox';
			break;
		case preg_match('/yuol/i', $ua):
			$browser='yuol';
			break;
		default:
			$browser='unknown';
		break;
	}
	return $browser;
}
/**
 * 判断是否为低版本的IE浏览器
 * @return boolean 若是IE7,IE6,IE5, 则返回True否则返回False
 */
function isOldIE() {
	$isOld=false;
	$ua=$_SERVER['HTTP_USER_AGENT'];
	switch (true) {
		case preg_match('/MSIE 5/i', $ua):
			$isOld=true;
			break;
		case preg_match('/MSIE 6/i', $ua):
			$isOld=true;
			break;	
		case preg_match('/MSIE 7/i', $ua):
			$isOld=true;
			break;
		case preg_match('/MSIE 8/i', $ua):
			$isOld=true;
			break;
	}
	return $isOld;
}
/**
 * 检测访问是否来自本站，防盗链
 * @return boolean True代表来自本站的访问，False代表非本站的访问
 */
function hostOnly() {
	$exp="/http:\/\/{$_SERVER['HTTP_HOST']}/i";
	return preg_match($exp, @$_SERVER["HTTP_REFERER"])!=0;
}
/**
 * 阻止低版本IE，提醒其升级
 */
function chkBrowser() {
	if (isOldIE()) {
		header('Location: http://www.google.cn/intl/zh-CN/chrome/browser/?hl=zh-CN&brand=CHMI');
	}
}
/**
 * 获取表中的信息
 * @param string $table 表名，遵循ThinkPHP规则，不包含表前缀
 * @param array $conditionArray 条件数组
 * @return Ambigous 返回数据记录(条)数组 <mixed, boolean, NULL, multitype:>
 */
function getData($table,$conditionArray) {
	return M($table)->where($conditionArray)->find();
}
/**
 * 获取所指定的时间与现在时间的间隔信息
 * 例如：1分钟以内显示“刚刚”；
 * 			大于1分钟小于30分钟显示“x分钟”
 * 			大于30分钟则显示所指定的时间H:m:s格式
 * @param int $time 指定输入时间
 * @return string 时间提示信息
 */
function timeInfo($time) {
	if (time()-$time<60) {
		$info='刚刚';
	}elseif (time()-$time>=60&&time()-$time<=1800){
		$info=(int)((time()-$time)/60).'分钟前';
	}else {
		$info=date('d/m H:i:s', $time);
	}
	return $info;
}
/**
 * 火狐浏览器Debug函数
 * 将php变量信息在firebug的控制台中显示
 * 注意：此功能可能会使页面UI发生轻微异常，UI设计工作时请关闭此功能
 * @param any_type $msg 变量，任意类型
 */
function FFDEBUG($msg) {
	if (C('FFDEBUG')) {
		echo '<script type="text/javascript">console.log('.json_encode($msg).')</script>',"\n";
	}
	return $msg;
}
/**
 * js，css资源文件压缩<br/>返回资源文件路径<br/>如果未开启压缩则返回原路径
 * @param string $path 资源文件原路径
 * @return string 返回压缩后的文件路径
 */
function mU($path) {
	$www=C('WWW_PATH');
	if (C('MINIFY')) {
		if (is_string($path)) {
			return $www.'min/?f='.$path;
		}elseif (is_array($path)){
			$str='';
			foreach ($path as $value) {
				$str=$str.$value.',';
			}
			return preg_replace('/,$/', '', $str);
		}
	}else{
		return $path;
	}
}

function RS($path) {
	$html='';
	if (is_array($path)) {
		if (C('MINIFY')) {
			foreach ($path as $value) {
				$url=$url.$value.',';
			};
			$url=C('WWW_PATH').'min/?f='.preg_replace('/,$/', '', $url);
			$html='<script type="text/javascript" src="'.$url.'"></script>';
		}else{
			foreach ($path as $value) {
				$html=$html.'<script type="text/javascript" src="'.$value.'"></script>';
			};
		}
	}else {
		$html='<script type="text/javascript">$(document).ready(function(e){M.show("网站内部错误：模版文件中RS()函数参数类型错误！$path应为array类型！");});</script>';
	}
	return $html;
}
?>
