$(document).ready(function(){
	
	setPadding();
	checkHeader();
	attentionMe();
	
	$("textarea").autoResize();

});

function setPadding(){
	var headerHeight = $("#header").outerHeight();
	var footerHeight = $("#footer").outerHeight();
	
	$("#content").css({
			paddingTop: headerHeight
	});
}
function checkHeader(){
	if ($("#header")){
		var scrolledTop = $("#header").offset().top;
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
	$("#footer_me").html("©<b>SEVESTEN</b>");
	$("#footer_year").html("1997-" + meYear);
}