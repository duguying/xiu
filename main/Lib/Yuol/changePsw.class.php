<?php
class changePsw{
	
	
	
	public function sendMail() {
		import('@.Yuol.tools');
		$ip = get_client_ip();
		$lo = tools::L($ip);
		$title='[YUOL-XIU]取回密码';
		$content =
		<<<END
		<div style="background-color:#CCC; font-family:'微软雅黑'; padding:10px;">
		<p> 取回密码说明<br />
		</p>
		<p>$this->username， 这封信是由 <a href="http://xiu.yuol.cn">修·长大</a> 发送的。</p>
		<p>您收到这封邮件，是由于这个邮箱地址在 <a href="http://xiu.yuol.cn">修·长大</a>被登记为用户邮箱， 且该用户请求使用 Email 密码重置功能所致。</p>
		<p>----------------------------------------------------------------------<br />
		<strong>重要！</strong><br />
		----------------------------------------------------------------------</p>
		<p>如果您没有提交密码重置的请求或不是<a href="http://xiu.yuol.cn">修·长大</a>的注册用户，请立即忽略 并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的 内容。</p>
		<p>----------------------------------------------------------------------<br />
		<strong>密码重置说明</strong><br />
		----------------------------------------------------------------------</p>
		您只需在提交请求后的三天内，通过点击下面的链接重置您的密码：<br />
		<a href="http://bbs.yuol.cn/bbs/member.php?mod=getpasswd&amp;uid=6433&amp;id=pt46sT" target="_blank">http://bbs.yuol.cn/bbs/member.php?mod=getpasswd&amp;uid=6433&amp;id=pt46sT</a><br />
		(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问)
		<p>在上面的链接所打开的页面中输入新的密码后提交，您即可使用新的密码登录网站了。您可以在用户控制面板中随时修改您的密码。</p>
		<p>本请求提交者的 IP 为 {$ip} [{$lo['country']}-{$lo['area']}]</p>
		<p>此致<br />
		</p>
		<p><a href="http://xiu.yuol.cn">修·长大</a>——管理团队-长大在线. <a href="http://www.yuol.cn" target="_blank">http://www.yuol.cn</a></p>
		</div>
END;
	
	
		tools::M('706639632@qq.com', $title, $content);
	}
}