<?php
return array(
		'SHOW_PAGE_TRACE' => true,
		'BUCKET_PREFIX'=>'jk1101rex-',

		'DB_TYPE'   => 'mysql', // 数据库类型
		'DB_NAME'   => 'cCBBuhUMoXBXqXjHuMBL', // 数据库名
		'DB_HOST'=> HTTP_BAE_ENV_ADDR_SQL_IP, // 服务器地址
		'DB_USER'=> HTTP_BAE_ENV_AK, // 用户名
		'DB_PWD'=> HTTP_BAE_ENV_SK, // 密码
		'DB_PORT'=> HTTP_BAE_ENV_ADDR_SQL_PORT, // 端口
		'DB_PREFIX' => 'xiu_', // 数据库表前缀，请勿改动

		//更改模板替换变量，让普通能在所有平台下显示
		'TMPL_PARSE_STRING'=>array(
		// __PUBLIC__/upload --> /Public/upload -->http://appname-public.stor.sinaapp.com/upload 
		//'/Public/upload'=>file_domain('think-test')
		)
//);
);
?>