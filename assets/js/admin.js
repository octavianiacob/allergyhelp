$(document).ready(function()
{
	$(window).scroll(function()
	{
		if ($(window).scrollTop() > 56) $('.navbar-links').addClass('navbar-links-fixed');
		else $('.navbar-links').removeClass('navbar-links-fixed');
	});
	$('.image-editor').cropit({
		allowDragNDrop: false
	});
	$('.rotate-cw').click(function() {
		$('.image-editor').cropit('rotateCW');
	});
	$('.rotate-ccw').click(function() {
		$('.image-editor').cropit('rotateCCW');
	});
	$('#photo').submit(function() {
		var imageData = $('.image-editor').cropit('export');
		$('.hidden-image-data').val(imageData);
	});
	$("#load-photo").change(function() {
		if ($('#load-photo').get(0).files.length !== 0) {
			$(".image-editor-controls").show();
			$(".export").fadeTo("fast", 1);
		} else {
			$(".image-editor-controls").hide();
			$(".export").fadeTo("fast", 0.5);
		}
	});
});