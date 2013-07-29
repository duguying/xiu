$(document).ready(function() {
	var odd=$("ul.list:odd");
	odd.addClass("list_odd");
	var chkbox=$(".list>li>input:checkbox");
	$("#all").click(function() {
		if ($(this).attr("checked")) {
			chkbox.attr("checked",true);
		} else{
			chkbox.attr("checked",false);
		};
	});
	$(".list").hover(function(){
		$(this).addClass("list_hover");
	},function(){
		$(this).removeClass("list_hover");
	})
});