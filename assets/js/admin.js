$(document).ready(function()
{
	$(window).scroll(function()
	{
		if ($(window).scrollTop() > 56) $('.navbar-links').addClass('navbar-links-fixed');
		else $('.navbar-links').removeClass('navbar-links-fixed');
	});
});