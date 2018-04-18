<?php
	$name = md5(rand(100, 200));
	$ext = explode('.', $_FILES['file']['name']);
	$filename = $name . '.' . $ext[1];
	$destination = '../img/uploads/' . $filename;
	$location = $_FILES["file"]["tmp_name"];
	$allowed = array('png', 'jpg', 'gif', 'bmp');
	if (in_array(strtolower($ext[1]), $allowed))
	{
		move_uploaded_file($location, $destination);
		echo '../assets/img/uploads/' . $filename;
	}
?>