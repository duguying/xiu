<?php
$xiu_config=array(//�벻Ҫ�޸ı�����$xiu_config
		//'������'=>'����ֵ'
		'SHOW_PAGE_TRACE' => true,
		'SESSION_AUTO_START' =>false,//��ֹ�Զ�����session
		'URL_HTML_SUFFIX'=>'do',//ҳ��Ϊpage.do��ʽ
		'URL_MODEL'          => '0', //URLģʽ
		'ROOT_PATH'			=>getcwd().'/',//��Ŀ��Ŀ¼�����뿪��
		'WWW_PATH'			=>preg_replace('/[\w|.]*$/i', '', $_SERVER['SCRIPT_NAME']),//��վ��Ŀ¼�����뿪��
		'URL_CASE_INSENSITIVE' =>true,//����URLСд������
		'LOAD_EXT_FILE'=>'myfunction,strfunction',//�����Զ��庯���⣬���뿪��

		'USER_SESSION_TIME'=>31536000,//�Ự����ʱ��, 1��
		'SID_COOKIE_NAME'=>'xiu_sid',//session��cookie��
		'AUTHOR'=>'LiJun(RexLee)',//Authorͷ��Ϣ
		'X_POWERED'=>'RexLee@Yuol PHP Team',//X-Powered-by��ҳͷ��Ϣ
		'FFDEBUG'=>true,//����firebug����
		//��������վ������������
		'SESSION_PATH'=>'./session/',//session����·��
		'MAIL_ADDRESS'=>'xiu_yuol@163.com', // �����ַ
		'MAIL_SMTP'=>'smtp.163.com', // ����SMTP������
		'MAIL_LOGINNAME'=>'xiu_yuol', // �����¼�ʺ�
		'MAIL_PASSWORD'=>'lijunxiu', // ��������
		'MAIL_CHARSET'=>'UTF-8',//����
		'MAIL_AUTH'=>true,//������֤
		'MAIL_HTML'=>true,//true HTML��ʽ false TXT��ʽ
		//'DB_SQL_BUILD_CACHE' => true,
		//'DB_SQL_BUILD_QUEUE' => 'File',
		//'DB_SQL_BUILD_LENGTH' => 20, // SQL����Ķ��г���
		//////////////
 		//'MINIFY'=>true,//����ѹ��js��css
 		
		//��һ��(TYPE)�������Ӧ��SDK����
		'THINK_SDK_QQ' => array(
				'APP_KEY'    => '100373443', //Ӧ��ע��ɹ������� APP ID
				'APP_SECRET' => 'f66c81f52e36f865c14e1100b9e77d58', //Ӧ��ע��ɹ�������KEY
				'CALLBACK'   => 'www.duguying.tk/oc/qqcallback', //ע��Ӧ����д��callback
		),
		
		'THINK_SDK_RENREN' => array(
				'APP_KEY'    => '7373b38a9fb94ad882cb332ed0247c7d', //Ӧ��ע��ɹ������� APP ID
				'APP_SECRET' => '18bc236007ad4396b1f20860d3f27fdb', //Ӧ��ע��ɹ�������KEY
				'CALLBACK'   => 'www.duguying.tk', //ע��Ӧ����д��callback
		),
		
		'THINK_SDK_DOUBAN' => array(
				'APP_KEY'    => '074e3ac140b27ff615eab043c2177fe2', //Ӧ��ע��ɹ������� APP ID
				'APP_SECRET' => '7ded05883d3560a5', //Ӧ��ע��ɹ�������KEY
				'CALLBACK'   => 'www.duguying.tk/oc/doubancallback', //ע��Ӧ����д��callback
		),
);
if($xiu_config['SESSION_PATH']){
	session_save_path($xiu_config['SESSION_PATH']);
}

return $xiu_config;

?>