<?php
	session_start();
	if(isset($_SESSION['user_member'] ))
	{
		unset($_SESSION['user_member'] );
	}
	header("location:index.php");
?>