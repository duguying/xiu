// JavaScript Document
/**
 * 注册页面
 */
$(document).ready(function(e){
    /**
     * 验证码控制，text获得焦点则刷新并显示验证码图片
     */
	$.ajax($(".reg_yanz").attr("yz")+"?"+Math.random());//此句用于刷掉后退时的session缓存
	$("input[name='yanz']").focusin(function(e) {
		$(".reg_yanz").attr("src",$(".reg_yanz").attr("yz")+"?"+Math.random());
		$(".reg_yanz").css("display","block");
    });
	$("input[name='yanz']").focusout(function(e) {
        $(".reg_yanz").css("display","none");
    });

    /**
     * 表单验证
     */
	$("input[name='username']").change(function(e) {
		var par=$(this)[0].value;
		var url=$(this).attr("chk");
		$.ajax({
			type: "GET",
			url: url+$M+"username="+par,
			success: function(msg){
			   $("input[name='username']").next("em").html(msg);
			}
		});
    });
})













