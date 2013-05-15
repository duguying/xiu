// JavaScript Document

function tpc_detail(){
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
}




















