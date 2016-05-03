$(document).ready(function(){
	
	if (document.getElementById("lavorum")){
		shadowHeader();
	}
	setPadding();
	attentionMe();
	
});

function setPadding(){
	var headerHeight = $("#header").outerHeight();
	var footerHeight = $("#footer").outerHeight();
	
	$("body").css({
		paddingTop: headerHeight
	});
}
function shadowHeader(){
	if (document.getElementById("header")){
		var scrolledTop = 0 //$("#header").offset().top;
		$(window).bind("scroll", function(){
			var scrolled = $(window).scrollTop();
			if (scrolled > scrolledTop){
				$("#header").addClass("shadow");
			}
			else {
				$("#header").removeClass("shadow");
			}
		});
	}
}
function attentionMe(){
	var meTime = new Date();
	var meYear = meTime.getFullYear();
	$("#footer_me").html("fredrik<b>sevesten</b>");
	$("#footer_year").html("1997-" + meYear);
}
function editComment(id, e){
	if (e == "edit"){
		$(".edit_btns_" + id + "").show();
		$(".edit_btn_" + id + "").hide();
		//$(".comment_id_" + id + "").attr('contenteditable','true');
		//$(".comment_id_" + id + "").attr('onblur','copyMe(' + id + ')');
		$(".comment_id_" + id).parent().css({backgroundColor:"#eee"})
		$(".comment_id_" + id).hide();
		$(".comment_new_" + id).show().focus();
	}
	else if (e == "cancel"){
		$(".edit_btns_" + id).hide();
		$(".edit_btn_" + id + "").show();
		//$(".comment_id_" + id).attr('contenteditable','false');
		//$(".comment_id_" + id).attr('onblur','');
		//$(".comment_id_" + id).html($("#comment_old_" + id).val());
		//$("#comment_new_" + id).val($("#comment_old_" + id).val());
		$(".comment_id_" + id).parent().css({backgroundColor:""})
		$(".comment_new_" + id).hide()
		$(".comment_id_" + id).show();
	}
}
function copyMe(id){
	var txt = $(".comment_id_" + id).html();
	//.replace(/\n/g, '<br>')
	$("#comment_new_" + id).text(txt);
}