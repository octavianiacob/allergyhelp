$(document).ready(function()
{
	$(window).scroll(function() {
		if($(window).width() > 991)
		{
			if ($(window).scrollTop() > 0)
			{
				$(".navbar").addClass("bg-dark");
				$(".navbar").css("box-shadow", "0 2px 2px 0 rgba(0, 0, 0, 0.07)");
			}
			else
			{
				$(".navbar").removeClass("bg-dark");
				$(".navbar").css("box-shadow", "none");
			}
		}
	});
	if($(window).width() <= 991)
	{
		$(".navbar").addClass("bg-dark");
		$(".navbar").css("box-shadow", "0 2px 2px 0 rgba(0, 0, 0, 0.07)");
	}
});