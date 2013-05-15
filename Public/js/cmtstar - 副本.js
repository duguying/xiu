// JavaScript Document
// jQuery 1.8.2 plug-in
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
		})
	}
});


