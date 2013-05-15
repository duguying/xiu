<?php
/**
 * 常用工具类；
 * @method L($ip) 获取ip对应的地址
 * @method M($mailAddr, $title, $content) 发送邮件
 * @static
 * @author 李俊
 *
 */
class tools{
	
	/**
	 * 获取ip对应的位置
	 * @param string $ip IP地址
	 * @return array ip及其地址信息数组
	 */
	static function L($ip) {
		import('ORG.Net.IpLocation');// 导入IpLocation类
		$Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
		$area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
		return $area;
	}
	/**
	 * 发送邮件
	 * 需要config.php文件的相关配置参数
	 * @param string $mailAddr 收件人地址
	 * @param string $title 邮件标题
	 * @param string $content 邮件内容
	 */
	static function M($mailAddr, $title, $content) {
		import('ORG.Net.Mail');
		try {
			FFDEBUG(SendMail($mailAddr, $title, $content,'修·长大-自动邮件-勿回复'));
		} catch (Exception $e) {
		}
		
	}
}