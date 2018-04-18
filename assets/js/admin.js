$(document).ready(function()
{
	$(window).scroll(function() {
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
	$('#allergy-content').summernote({
		minHeight: 150,
		toolbar: [
			["style", ["style"]],
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["table", ["table"]],
			["insert", ["link", "picture", "video"]],
			["view", ["fullscreen", "codeview"]]
		],
		callbacks: {
			onImageUpload: function(files, editor, welEditable) {
				for (var i = files.length - 1; i >= 0; i--) {
					sendFile(files[i], this);
				}
			}
		}
	});
	function sendFile(file, el) {
		var form_data = new FormData();
		form_data.append('file', file);
		$.ajax({
			data: form_data,
			type: "POST",
			url: '../php/upload.php',
			cache: false,
			contentType: false,
			enctype: 'multipart/form-data',
			processData: false,
			success: function(url) {
				$(el).summernote('editor.insertImage', url);
			},
		});
	}
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	});
});
