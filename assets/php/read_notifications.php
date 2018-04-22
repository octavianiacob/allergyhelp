<?php
	session_start();
	include_once "functions.php";
	$user = new User();

	if(isset($_SESSION['allergyhelp_id']))
	{
		$id = $_SESSION['allergyhelp_id'];
		$user->get_notifications($id);
		$user->read_notifications($id);
	}
?>