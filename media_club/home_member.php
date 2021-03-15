<?php 
	include "connection.php";
	include "naviBarMember.php";

	if(!isset($_SESSION['user_member'])){
		header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style type="text/css">

		body{
			background-image: url("image/mem1.png");
		    -webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
			margin: 0;
		    font-family: Courier, "Lucida Console", monospace;
		}

		.homeMember{
			width: 500px;
			height: 400px;
			text-align: center;
			background-color: rgba(0, 0, 0, 1);
			opacity: 0.6;
			border-radius: 4px;
			margin: 0 auto;
			margin-top: 50px;
		}

		h1{
			text-align: center;
			text-transform: uppercase;
			font-size: 60px;
			font-weight: bold;
			font-family: Courier, "Lucida Console", monospace;
			color: #81DAF5;
			-webkit-text-stroke: 2px black;
			text-shadow: 2px 2px 2px #CEECF5;
		}

	</style>
</head>
<body>
	<div class="homeMember">
		<h1 class="welcome">WELCOME!</h1>
		<figure>
			<img src="image/logoPera.png" alt="Logo" width="320" height="320" >
		</figure>
	</div>

</body>
</html>