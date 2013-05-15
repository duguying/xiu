// JavaScript Document
/**
 * 显示登录框
 */
;$(document).ready(function(e) {
	$(".login_btn").click(function(e) {
        $("#login_form").show("slow");
    });
	$("#close_btn").click(function(e) {
        $("#login_form").hide("slow");
    });
});










