function checkScroll() {
	if ($(window).scrollTop() > 0 || $(window).width() < 991) {
		$(".navbar").addClass("bg-dark");
		$(".navbar").css("padding", "10px 0");
	} else {
		$(".navbar").removeClass("bg-dark");
		$(".navbar").css("padding", "35px 0");
	}
}
$(document).ready(function()
{
	checkScroll();
	$(window).resize(function() {
		checkScroll();
	});
	$(window).scroll(function() {
		checkScroll();
	});
});