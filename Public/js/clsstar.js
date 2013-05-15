// JavaScript Document
/**
 * 课程打分
 */
$(document).ready(function(e) {
    /**
     * 设定课程分数——打分
     * @param classid 课程ID
     * @param point 分数
     * @param type 打分类型
     * @return {*}
     */
	function set_cpoint(classid,point,type){
		//eg. http://localhost/aixuanxiu/clspoint/sco/2/4.do
		var url=U('clspoint/'+type+'/'+classid+'/'+point);
		var resp=$.ajax({
		  type: "GET",
		  url: url,
		  async:false,
		  error: function(){
			jalert('<font color="red">打分失败！请检查网络！</font>');
			throw Error('<font color="red">打分失败！请检查网络！</font>');
		  }
		}).responseText;
		return eval('['+resp+']')[0];
	};
	var class_id=C('classid');
    var class_score=$("ul[csstar]");
	var class_pinlv=$("ul[lvstar]");
	var class_score_defaultScore=$(class_score).attr("csstar");//get default score
	var class_pinlv_defaultScore=$(class_pinlv).attr("lvstar");//get default score
	$(class_score.eq(0)).star(class_score_defaultScore,function(data,ele){
		var result_json=set_cpoint(class_id,data,'sco');
		if(result_json.result==false){
			jalert(result_json.msg);
		}else{
			jalert(result_json.msg+'您打分'+data+'分');
		}
	});
	$(class_score.eq(1)).star(class_score_defaultScore,function(data,ele){
		var result_json=set_cpoint(class_id,data,'sco');
		if(result_json.result==false){
			jalert(result_json.msg);
		}else{
			jalert(result_json.msg+'您打分'+data+'分');
		}
	});
	$(class_pinlv).star(class_pinlv_defaultScore,function(data,ele){
		var result_json=set_cpoint(class_id,data,'rat');
		if(result_json.result==false){
			jalert(result_json.msg);
		}else{
			jalert(result_json.msg+'您打分'+data+'分');
		}
	});
});








