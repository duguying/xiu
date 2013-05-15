function jalert(message){//ÌáÊ¾¿òµ¯³ö²ã
	var root=$("[root]").attr("root");
	function lock(){
		$("#alert_box").css("display","block");
		$("body").css("overflow","hidden");
		$("[mask]").addClass("mask");
	}
	function unlock(){
		$("#alert_box").css("display","none");
		$("body").css("overflow","scroll");
		$("[mask]").attr("class","");
	}
	$.ajax({
		 type: "get",
		 url: root+"Public/rs/alert_box.rs",
		 data: "",
		 dataType: "text",
		 success: function(msg){
		 	$("body").append(msg);
			$(".alert_content").html(message);
			lock();
		 	try{
			   $("#alert_box").draggable();
			}catch(e){
		 	}
			$(".alert_btn").click(function(e) {
                unlock();
            });
	   	 }
	})
}
