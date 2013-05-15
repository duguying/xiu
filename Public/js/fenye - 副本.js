// JavaScript Document
//分页函数
$(document).ready(function(e) {
	function pload(page){
		if(!page){//page参数预处理
			page='';
		}
		M.show(1,'数据加载中……');
		return $.ajax({
			type: "GET",
			url: U(C('fenye')+page),
			dataType: "text",
			async: false,
			error: function(){
				throw Error('网络错误,请检查网络连接……');
			},
			success:function(){
				M.hide(1);
			}
		}).responseText;
	}
	function pbind(){
		var currentTag=$("#on");
		var currentPageNum=parseInt(currentTag.html());
		$("#page_comment_index").delegate("a[page]","click",function(e){
			var page=parseInt($(this).attr("page"));
			/**Loading Data**/
			var phtml=pload(page);
			$("#comment").html(phtml);
		});
	}
	pbind();
});







