<?php
$xiu_config=array(//请不要修改变量名$xiu_config
		
				//'配置项'=>'配置值'
		'TEMP_STRIP_SPACE'=>true,
		'SHOW_PAGE_TRACE' => true,
		'SESSION_AUTO_START' =>false,//禁止自动启动session
		'URL_HTML_SUFFIX'=>'do',//页面为page.do形式
		'URL_MODEL'          => '1', //URL模式
		'DEFAULT_THEME'=>'default',
		'ROOT_PATH'			=>getcwd().'/',//项目根目录，必须开启
		'WWW_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']),//网站根目录，必须开启
		'TPL_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']).APP_NAME."/tpl/",//模版目录
		'URL_CASE_INSENSITIVE' =>true,//兼容URL小写，开启
		'LOAD_EXT_FILE'=>'myfunction,strfunction',//载入自定义函数库，必须开启

		'USER_SESSION_TIME'=>31536000,//会话保存时间, 1年
		'SID_COOKIE_NAME'=>'xiu_sid',//session的cookie名
		'AUTHOR'=>'LiJun(RexLee)',//Author头信息
		'X_POWERED'=>'RexLee@Yuol PHP Team',//X-Powered-by网页头信息
		'FFDEBUG'=>true,//开启firebug调试
		//以下是网站公共邮箱配置
		'SESSION_PATH'=>'./session/',//session保存路径
		'MAIL_ADDRESS'=>'xiu_yuol@163.com', // 邮箱地址
		'MAIL_SMTP'=>'smtp.163.com', // 邮箱SMTP服务器
		'MAIL_LOGINNAME'=>'xiu_yuol', // 邮箱登录帐号
		'MAIL_PASSWORD'=>'lijunxiu', // 邮箱密码
		'MAIL_CHARSET'=>'UTF-8',//编码
		'MAIL_AUTH'=>true,//邮箱认证
		'MAIL_HTML'=>true,//true HTML格式 false TXT格式
		//'DB_SQL_BUILD_CACHE' => true,
		//'DB_SQL_BUILD_QUEUE' => 'File',
		//'DB_SQL_BUILD_LENGTH' => 20, // SQL缓存的队列长度
		//////////////
 		//'MINIFY'=>true,//开启压缩js，css
 		
		//将一下(TYPE)换成你对应的SDK类型
		'THINK_SDK_QQ' => array(
				'APP_KEY'    => '100373443', //应用注册成功后分配的 APP ID
				'APP_SECRET' => 'f66c81f52e36f865c14e1100b9e77d58', //应用注册成功后分配的KEY
				'CALLBACK'   => 'www.duguying.tk/oc/qqcallback', //注册应用填写的callback
		),
		
		'THINK_SDK_RENREN' => array(
				'APP_KEY'    => '7373b38a9fb94ad882cb332ed0247c7d', //应用注册成功后分配的 APP ID
				'APP_SECRET' => '18bc236007ad4396b1f20860d3f27fdb', //应用注册成功后分配的KEY
				'CALLBACK'   => 'www.duguying.tk', //注册应用填写的callback
		),
		
		'THINK_SDK_DOUBAN' => array(
				'APP_KEY'    => '074e3ac140b27ff615eab043c2177fe2', //应用注册成功后分配的 APP ID
				'APP_SECRET' => '7ded05883d3560a5', //应用注册成功后分配的KEY
				'CALLBACK'   => 'www.duguying.tk/oc/doubancallback', //注册应用填写的callback
		),
		
		
		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_HOST'   => 'localhost', // 服务器地址
		'DB_NAME'   => 'xiu', // 数据库名
		'DB_USER'   => 'root', // 用户名
		'DB_PWD'    => 'lijun', // 密码
		'DB_PORT'   => 3306, // 端口
		'DB_PREFIX' => 'xiu_', // 数据库表前缀，请勿改动
);

if($xiu_config['SESSION_PATH']){
	if (!is_dir($xiu_config['SESSION_PATH'])) {
		mkdir($xiu_config['SESSION_PATH']);//如果目录不存在，创建目录
	}
	session_save_path($xiu_config['SESSION_PATH']);
}

return $xiu_config;
