(function (a) {
	a.fn.extend({
		"star" : function (h, g) {
			h = parseInt(h);
			var k;
			var b = ["0px 17px", "0px 17px", "0px 17px", "0px 17px", "0px 17px"];
			for (var j = 0; j < h; j++) {
				b[j] = "0px 0px"
			}
			var e = C('root')+"Public/img/star.png";
			var f = '<li style="left:0px;position: absolute;width: 18px;height: 17px;list-style: none;background: url(' + e + ");background-position:" + b[0] + ';"></li><li style="left:18px;position: absolute;width: 18px;height: 17px;list-style: none;background: url(' + e + ");background-position:" + b[1] + ';"></li><li style="left:36px;position: absolute;width: 18px;height: 17px;list-style: none;background: url(' + e + ");background-position:" + b[2] + ';" ></li><li style="left:54px;position: absolute;width: 18px;height: 17px;list-style: none;background: url(' + e + ");background-position:" + b[3] + ';" ></li><li style="left:72px;position: absolute;width: 18px;height: 17px;list-style: none;background: url(' + e + ");background-position:" + b[4] + ';" ></li>';
			this.append(f);
			var c = this.children("li");
			this.mouseout(function (l) {
				for (var i = 0; i < 5; i++) {
					a(c[i]).css("background-position", b[i])
				}
			});
			for (var d = 0; d < 5; d++) {
				a(c[d]).data("data", d + 1);
				a(c[d]).mouseover(function (i) {
					a(this).nextAll().css("background-position", "0px 17px");
					a(this).css("background-position", "0px 0px");
					a(this).prevAll().css("background-position", "0px 0px")
				});
				a(c[d]).mouseout(function (i) {
					a(this).css("background-position", "0px 17px");
					a(this).prevAll().css("background-position", "0px 17px")
				});
				a(c[d]).click(function (i) {
					k = a(this).data("data");
					g(k, this);
					c.unbind("mouseover");
					c.unbind("mouseout");
					c.unbind("click")
				})
			}
			return this
		},
		"flush" : function () {
			if (arguments.length == 1) {
				window.setInterval(arguments[0], 1000)
			} else {
				if (arguments.length = 2) {
					window.setInterval(arguments[1], arguments[0])
				} else {
					alert("������󣡵��÷�����\n1.flush(hander(){})\n2.flush(time,hander(){})")
				}
			}
			return this
		}
	})
})(jQuery);

$eval=function(str){
	return eval('('+str+')');
}

$(document).ready(function(){
	window.$M=(function(){
		// if(C('url_model')=="2"){
			return '?';
		// }else{
			// return '&';
		// }
	})();
	window.islogin=(function(){
		if(parseInt(C('userid'))){
			return true;
		}else{
			return false;
		}
	})();
});



M={
	'show':function(id,msg){
		$('#msgbox'+id).remove();
		$("body").append('<div id="msgbox'+id+'" style="position:fixed;display:block;left:0;bottom:0;margin:0px;padding:0px;width:auto;height:auto;color:green;font-size:15px;background-color:#CCCCCC;z-index:500;">'+msg+'</div>');
	},
	'hide':function(id){
		$('#msgbox'+id).remove();
	}
}


function E(msg){
	$("#errorbox").remove();
	$("body").append('<div id="errorbox" style="position:fixed;display:none;left:0;bottom:0;margin:0px;padding:0px;width:auto;height:auto;color:red;background-color:#CCCCCC;z-index:500;">������Ϣ����</div>');
	$("#errorbox").html(msg);
	$("#errorbox").css("display","block");
	window.setTimeout(function(){
		$("#errorbox").css("display","none");
		$("#errorbox").remove();
	},5000);
}

window.onerror = function(msg,url,link) {
				E(msg);
			};


function C(k) {
	return $("meta[" + k + "]").attr(k);
};
/**
 * LocalStorage
 * @return {*}
 * @constructor
 */
function LS() {
    if (!window.localStorage) {
        throw Error("浏览器不支持LocalStorage");
    }
    if (arguments.length == 1) {
        var a = arguments[0];
        if("object"==typeof(a)&&a[0]=="clear"){
            window.localStorage.clear();
            return "cleared";
        }else{
            return window.localStorage.getItem(a);
        }
    } else {
        if (arguments.length == 2) {
            var a = arguments[0];
            var b = arguments[1];
            window.localStorage.removeItem(a);
            if (b) {
                window.localStorage.setItem(a, b)
            }
        } else {
            alert("参数错误\n1个参数：get(key)\n2个参数：set(key,value)")
        }
    }
};


function jalert(c) {
	var a = $("[root]").attr("root");
	function b() {
		$("#alert_box").css("display", "block");
		$("body").css("overflow", "hidden");
		var sty=$("[alert_mask]").attr("style");
		sty=sty||''+";position: fixed;left: 0;top: 0;width: 100%;height: 100%;z-index: 100;background-color:#000;opacity:.5;";
		$("[alert_mask]").attr("style",sty);
	}
	function d() {
		$("#alert_box").css("display", "none");
		$("body").css("overflow", "scroll");
		$("[alert_mask]").attr("class", "");
		$("[alert_mask]").detach();
		$("#alert_box").remove()
	}
	function get() {
		var cdata = $.ajax({
				type : "get",
				url : a + "Public/rs/alert_box.res",
				data : "",
				dataType : "text",
				async : false,
			}).responseText;
		LS('jalert', cdata);
		return cdata;
	}
	function lert() {
		var g = null;
		if (LS('jalert') == null) {
			g=get();
		} else {
			g = LS('jalert');
		}
		$("body").append(g);
		$(".alert_content").html(c);
		b();
		try {
			$("#alert_box").draggable()
		} catch (f) {};
		
		$(".alert_btn").hover(function(e){
			$(".alert_btn").css("border", "#903 solid 1px");
			$(".alert_btn").css("color", "#F00");
		}, function(e){
			$(".alert_btn").css("border", "1px solid #000");
			$(".alert_btn").css("color", "black");
		});
		
		$(".alert_btn").click(function (h) {
			d()
		})
	}
	lert();
};


function U(e) {
	var a = C("root");
	var b = C("url_html_suffix");
	var d = "index.php/";
	var c = e.match(/\//g);
	if (c) {
		if (C("url_model") == "2") {
			return a + e + "." + b
		} else {
			return a + d + e + "." + b
		}
	} else {
		alert('格式：\n"control/action"')
	}
};

// alert( readCookie("myCookie") );
	function readCookie(name){
	  var cookieValue = "";
	  var search = name + "=";
	  if(document.cookie.length > 0){ 
		offset = document.cookie.indexOf(search);
		if (offset != -1){ 
		  offset += search.length;
		  end = document.cookie.indexOf(";", offset);
		  if (end == -1) end = document.cookie.length;
		  cookieValue = unescape(document.cookie.substring(offset, end))
		}
	  }
	  return cookieValue;
	}

/////
function getYTime(){
	var d=new Date();
	var t_year=d.getFullYear();
	var t_month=d.getMonth()+1;
	var t_day=d.getDate();
	var t_week=d.getDay();
	var t_hour=d.getHours();
	var t_min=d.getMinutes();
	var t_sec=d.getSeconds();
	return t_year+'-'+t_month+'-'+t_day+' '+t_hour+':'+t_min+':'+t_sec+' ';//+t_noon;
}


