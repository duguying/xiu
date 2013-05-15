// JavaScript Document
/**
 * 课程详情页
 */
$(document).ready(function(e) {
	var root=C("root");

	$(".close_btn").css("background-image","url("+root+"Public/img/close.png)");
	$(".close_btn").hover(function(e){
			$(".close_btn").css("background-image","url("+root+"Public/img/close_h.png)");
		},function(e){
			$(".close_btn").css("background-image","url("+root+"Public/img/close.png)");
		})
    /**
     * 关闭按钮
     */
	$($(".close_btn")[0]).click(function(e) {
        $("#cmt_box").hide();
		$("[mask]").attr("class","");
		$("body").css("overflow","scroll");
		$("#comment_form")[0].reset();
    });
	$($(".close_btn")[1]).click(function(e) {
        $("#tpc_box").hide();
		$("[mask]").attr("class","");
		$("body").css("overflow","scroll");
		$("#topic_form")[0].reset();
    });

    /**
     * 弹出弹出层
     */
    $($(".intro>.show_box")[0]).click(function(e) {
		$("body").css("overflow","hidden");
		$("[mask]").attr("class","mask");
		$("#cmt_box").css("display","block").draggable();
		
    });
    $($(".intro>.show_box")[1]).click(function(e) {
		$("body").css("overflow","hidden");
		$("[mask]").attr("class","mask");
		$("#tpc_box").css("display","block");
		$("#tpc_box").draggable();

		
    });
	
	var comment_form=$("#comment_form");
	var topic_form=$("#topic_form");
	var cmt_t=$("[sendcmt]");//cmt内容
	var tpc_t=$("[sendtpc]");//tpc内容
	var tt_t=$("[sendtt]");//标题

    /**
     * 判断提交的内容是否为空
     * @param ele 文本框jquery元素
     * @return {Boolean} 为空则返回true
     */
	function is_empty(ele){
		if(ele.val()==''){
			return true;
		}else{
			return false;
		};
	}

    /**
     * 评论内容提交前的检查
     */
	function chkcmt(){
		if(is_empty(cmt_t)){
			jalert('不能发布空评论！');
		}else{
			if(C('userid')==''){
				jalert('请先登录！')
			}else{
				comment_form.submit();
			}
		}
	}

    /**
     * 主题内容提交前的检查
     */
	function chktpc(){
		if(is_empty(tt_t)){
			jalert('主题标题不能为空！');
		}else if(is_empty(tpc_t)){
			jalert('主题内容不能为空！');
		}else{
			if(C('userid')==''){
				jalert('请先登录！')
			}else{
				topic_form.submit();
			}
		}
	}

    /**
     * 点击按钮提交
     */
	$("[btn_cmt]").click(function(e) {
        chkcmt();
		return false;
    });
	$("[btn_tpc]").click(function(e) {
        chktpc();
		return false;
    });
    /**
     * Ctrl+Enter提交评论
     */
	cmt_t.keydown(function(e) {
		if(e.ctrlKey&&e.keyCode==13){
			chkcmt();
			return false;
		}
    });
    /**
     * Ctrl+Enter提交主题
     */
	tpc_t.keydown(function(e) {
		if(e.ctrlKey&&e.keyCode==13){
			chktpc();
			return false;
		}
    });
	
});












