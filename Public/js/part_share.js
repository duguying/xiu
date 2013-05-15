// JavaScript Document
$(document).ready(function(e) {
    /**
     * 选项卡切换
     */
	$(".li_share_file").click(
        /**
         * 点击【分享文件】
         * @param e
         */
        function(e) {
            $(".li_share_doc").css("background-color","#FFF");
            $(".li_share_file").css("background-color","#CCC");
            if($("#share_file").css("display")=="none"){
                $("#share_file").show();
                $("#share_doc").hide();
            };
        }
    );
	$(".li_share_doc").click(
        /**
         * 点击【分享文档】
         * @param e
         */
        function(e) {
            $(".li_share_file").css("background-color","#FFF");
            $(".li_share_doc").css("background-color","#CCC");
            if($("#share_doc").css("display")=="none"){
                $("#share_doc").show();
                $("#share_file").hide();
            };
        }
    );
	
});



