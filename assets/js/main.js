$(document).ready(function()
{
	$(window).scroll(function() {
		if($(window).width() > 991)
		{
			if ($(window).scrollTop() > 0)
			{
				$(".navbar").addClass("bg-dark");
				$(".navbar").css("box-shadow", "0 2px 2px 0 rgba(0, 0, 0, 0.07)");
				$(".navbar-nav").addClass("ml-auto");
				$(".navbar-nav").removeClass("m-auto");
				$(".navbar-brand").removeClass("d-none");
			}
			else
			{
				$(".navbar").removeClass("bg-dark");
				$(".navbar").css("box-shadow", "none");
				$(".navbar-nav").removeClass("ml-auto");
				$(".navbar-nav").addClass("m-auto");
				$(".navbar-brand").addClass("d-none");
			}
		}
	});
	if($(window).width() <= 991)
	{
		$(".navbar").addClass("bg-dark");
		$(".navbar").css("box-shadow", "0 2px 2px 0 rgba(0, 0, 0, 0.07)");
		$(".navbar-nav").addClass("ml-auto");
		$(".navbar-nav").removeClass("m-auto");
		$(".navbar-brand").removeClass("d-none");
	}
});