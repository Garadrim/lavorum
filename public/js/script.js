$(document).ready(function(){
	
	if (document.getElementById("lavorum")){
		setPadding();
		shadowHeader();
	}
	attentionMe();
	
});

function setPadding(){
	var headerHeight = $("#header").outerHeight();
	var footerHeight = $("#footer").outerHeight();
	
	$("#content").css({
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