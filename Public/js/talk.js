// JavaScript Document

/**
 * 提交说说
 */
function submitMe(){
    /**
     * 信息提示条
     * @param msg 信息
     */
	function msg(msg){
		$("#DivPubStatus").html(msg);
		$("#DivPubStatus").css("display","block");
		window.setTimeout(function(){
            /**
             * 一秒钟后提示信息消失
             */
			$("#DivPubStatus").css("display","none");
		},1000);
	}

    /**
     * ajax联网检查用户登录状态
     * @type {String} 返回json串，登录则为用户名，否则null
     */
    var userState;
    userState = $.ajax({
        type:"GET",
        url:U('chk/islogin'),
        dataType:"json",
        async:false,
        error:function () {
            throw Error('请检查网络连接……');
        },
    }).responseText;
    /**
     * 若未登录，抛出异常
     */
	if($eval(userState)==null){
		msg('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请登录后发布！');
		throw Error('<font color="green">请先登录！<font>');
	};

	
	var textarea=$("#TForm>textarea");
	var c=textarea.val();
    /**
     * 不允许发布空信息，消息为空则提示并返回终止
     */
	if(c==''){
		msg('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;不能发布空信息！');
		return;
	}
    /**
     * 发送信息，并获取返回json值到result
     * @type {String}
     */
	var result=$.ajax({
	  type: "POST",
	  url: U('tk/ad'),
	  data: "c="+c,
	  dataType: "text",
	  async:false,
	  error: function(){
		  jalert('<font color="red">发送失败！请检查网络！</font>');
		}
	}).responseText;
	result=eval(result);
	if(result){
		textarea.val('');
		msg('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;已发布 :)');
	}else{
		msg('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布失败 :)');
	}
}


$(document).ready(function(e) {
    /**
     * 时间戳
     * @return {Number} int型时间戳
     */
	function stmp(){
		var tkt=parseInt(readCookie('tk'));
		if(tkt){
			return tkt;
		}else{
			return Math.floor(Date.now()/1000);
		}
	}

    /**
     * html片段重建
     * @param data 传入数据
     * @return {*} html片段
     */
	function rebuild(data){
		var hstr=data;
		var lis=$(".TopTweets").children("li");
		var item_num=data.match(/<li>/g).length;
		var oldlis_num=lis.length-item_num;
		for(var i=0;i<oldlis_num;i++){
			hstr=hstr+'<li>'+$(lis[i]).html()+'</li>';
		}
		return hstr;
	}
	
    $("#TForm").flush(5000,function(){
		var rep=$.ajax({
			type: "GET",
			url: U('tk/ls')+$M+'t='+stmp(),
			dataType: "html",
			async:false,
			success:function(){
				M.hide(0);
			},
			error: function(){
				M.show(0,'网络错误,请检查网络连接……');
				//throw Error('网络错误,请检查网络连接……');
			},
		}).responseText;
		//console.log(rep);
		//console.log((rep));
		if(typeof(rep)=="undefined"){
			
		}else if(rep != ""){
			try{
				$(".TopTweets").html(rebuild(rep));
			}catch(e){
				throw Error('解析错误……');
			};
		}
		
	}).flush(60000,function(){
		//console.log('1分');
		//tk/rn
		var rep=$.ajax({
			type: "GET",
			url: U('tk/rn'),
			dataType: "html",
			async:false,
			error: function(){
				throw Error('网络错误,请检查网络连接……');
			},
		}).responseText;
		
		if(typeof(rep)=="undefined"){
			
		}else if(rep != ""){
			try{
				rebuild(rep);
				$(".TopTweets").html(rep);
			}catch(e){
				throw Error('解析错误……');
			};
		}
	})
	
	

	
});













