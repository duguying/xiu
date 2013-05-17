// JavaScript Document
// Author:李俊 长大在线
// set point by star评论打分模块

$(document).ready(function(e) {
    var nodes=$("ul[star]");
	var nodenum=nodes.length;
	for(var i=0;i<nodenum;i++){
		var defaultScore=$(nodes.eq(i)).attr("star");//get default score
		var cmt_id_array=[];
		$(nodes.eq(i)).parent().parent().parent().parent().data("id",($(nodes.eq(i)).parent().parent().children("input").attr("value")));
		$(nodes[i]).star(defaultScore,function(data,ele){
			//处理函数
			var id=$(ele).parent().parent().parent().parent().parent().data("id");
			var url=U('vote/cmt/'+id+'/'+data);
			$.ajax({
			  type: "GET",
			  url: url,
			  success: function(msg){
				jalert(msg);
			  },
			  error: function(){
				jalert('<font color="red">打分失败！请检查网络！</font>');
				throw Error('<font color="red">打分失败！请检查网络！</font>');
			  }
			});
		});
	};


    /**
     * 评论回复模块
     */

    /**
     * 显示回复框
     */
	$(".cmtbox").delegate(".reply_comment","click",function(){
  		var $ansNode=$(this).parent().parent().next();
		//console.log($ansNode);
		if($ansNode.css("display")=="none"){
			$ansNode.show("slow");
			$(this).data("cache",$(this).html());
			$(this).html("收起");
			$(this).css("color","red");
		}else{
			$ansNode.hide("slow");
			$(this).html($(this).data("cache"));
			$(this).removeData("cache");
			$(this).css("color","#006699");
		}
	});


    /**
     * 回复评论
     */
	$(".cmtbox").delegate(".add_reply_comment","click",function(){
		var parentUl=$(this).parent().parent();
		var cmt_id=parentUl.children("li").children("input[type='hidden']").attr("value");
		var cmt_textarea=parentUl.children("li").children("textarea");
		var cmt_content=cmt_textarea.val();
		var result=$.ajax({
			async:false,
			type: "POST",
   			url: U('ajaxcmtrpl/add/'+cmt_id),
   			data: "content="+cmt_content,
		}).responseText;
		cmt_textarea.val('');
		var rpls=parentUl.parent().parent().children("li")[0];
		try{
			var obj=eval('['+result+']')[0];
			if(!obj.rplcmt_user_id){//这种情况在用户未登录时发生
				jalert(eval(result));
			}else{
				var str='<ul class="item"><li><a href="'+U('home/user/'+obj.rplcmt_user_id)+'">'+obj.rplcmt_user_nickname+' </a>回应： '+obj.rplcmt_content+'</li><li class="time">回应时间：'+obj.rplcmt_time+'<a class="at_comment" href="javascript:void(0);" content="@匿名用户(0)">回复</a></li></ul>';
				$(rpls).append(str);
			}
		}catch(e){
			jalert('<font color="red">回复失败！请检查网络！</font>');
		};
			
	});

    /**
     * 分页模块
     */

    /**
     *加载分页内容
     * @param page 页码
     * @return {String} 返回分页内容
     */
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
	};
    /**
     * 将内容绑定到指定区域
     */
	function pbind(){
		var currentTag=$("#on");
		var currentPageNum=parseInt(currentTag.html());
		$("#page_comment_index").delegate("a[page]","click",function(e){
			var page=parseInt($(this).attr("page"));
			/**Loading Data**/
			var phtml=pload(page);
			$("#comment").html(phtml);
		});
	};
	pbind();

});

/**
 * 显示主题详情
 * @param id 主题ID
 * @param title 主题标题
 */
function tpc_detail(id,title){
	var tpc_id=arguments[0];
	if(arguments.length==2){
		var tpc_name=arguments[1];
	}else{
		var tpc_name='';
	}
	var hstr='<div id="tpc_frame"><span class="tpc_title">主题：'+tpc_name+'<div tbtn>X</div></span><iframe id="page" allowtransparency="false" src="'+U('tpcdetail/tpc/'+tpc_id)+'"  frameborder="0" marginwidth="0" marginheight="0" scrolling="auto" ></iframe></div>'
	$("#tpc_frame").remove();
	$("body").append(hstr);
	$("#tpc_frame").draggable();
	$("div[tbtn]").click(function(e) {
        $("#tpc_frame").remove();
    });
};

