// JavaScript Document
//ziliao.listall script
$(document).ready(function(e) {
	var root=C('root');
	//http://localhost/aixuanxiu/chk/islogin.do;
	islogin=$.ajax({
				url: U('chk/islogin'),
				dataType:"script",
				async: false,
				error: function(){
					throw Error('网络错误,请检查网络连接……');
				}
			}).responseText;
	islogin=$eval(islogin);
	
	var html_script=$.ajax({
	   type: "GET",
	   url: U('ajax/share'),
	   data: "",
	   async: false,
	}).responseText;
	$("#uploads>a").click(function(e) {
		if(islogin){
			$.getScript(root+'Public/js/part_share.js');
			$("#main").html(html_script);
			$("[pziliao]").attr("href",root+'Public/css/part_share.css');
		}else{
			jalert("请登陆后再分享！");
		}
    });
});



















