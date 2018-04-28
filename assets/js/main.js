function checkScrollForNavbar() {
	if ($(window).scrollTop() > 0 || $(window).width() < 992) {
		$(".navbar").addClass("bg-dark");
		$(".navbar").css("padding", "10px 0");
	} else {
		$(".navbar").removeClass("bg-dark");
		$(".navbar").css("padding", "35px 0");
	}
}
function checkScrollForParallax() {
	if($(window).width() > 991) {
		oVal = ($(window).scrollTop() / 3);
		$('.page-header[data-parallax="true"]').css({
			'transform': 'translate3d(0,' + oVal + 'px,0)',
			'-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
			'-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
			'-o-transform': 'translate3d(0,' + oVal + 'px,0)'
		});
	} else {
		$('.page-header[data-parallax="true"]').css({
			'transform': 'translate3d(0, 0 ,0)',
			'-webkit-transform': 'translate3d(0, 0 ,0)',
			'-ms-transform': 'translate3d(0, 0 ,0)',
			'-o-transform': 'translate3d(0, 0 ,0)'
		});
	}
}
$(document).ready(function()
{
	checkScrollForNavbar();
	checkScrollForParallax();
	$(window).resize(function() {
		checkScrollForNavbar();
		checkScrollForParallax();
	});
	$(window).scroll(function() {
		checkScrollForNavbar();
		checkScrollForParallax();
	});
	$(".link-top").on('click', function() {
		$("html, body").animate({ scrollTop: 0 }, 500);
		return false;
	});
	$(".link-scroll").on('click', function(e) {
		var url = e.target.href;
		var hash = url.substring(url.indexOf("#")+1);
		$('html, body').animate({
			scrollTop: $('#'+hash).offset().top - 60
		}, 500);
		return false;
	});
	var firstClickOnBell = 0;
	$("a#notifications").on('click', function() {
		$(".unread-badge").css("display", "none");
		$(".notifications-body").load("assets/php/read_notifications.php");
	});
	var msg = $('.msg-list');
	msg.scrollTop(msg.prop("scrollHeight"));
});