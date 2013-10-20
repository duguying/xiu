<?php
return array(
		//'配置项'=>'配置值'
		//'URL_HTML_SUFFIX'=>'do',//页面为page.do形式
		'URL_MODEL'          => '1', //URL模式
		'LOAD_EXT_FILE'=>'myfunction,adminfunction',//载入自定义函数库
		'ROOT_PATH'			=>getcwd().'/',
		'WWW_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']),
		'TPL_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']).APP_NAME."/tpl/",
		'FFDEBUG'=>true,//开启firebug调试
		'URL_CASE_INSENSITIVE' =>true,//兼容URL小写
// 		'DB'		=>'./Admin/data/file.php',//管理后台数据文件
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'xiu', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'lijun', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'xiu_admin_', // 数据库表前缀，请勿改动
);
?>