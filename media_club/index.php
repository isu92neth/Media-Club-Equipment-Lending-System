<?php 
	include "connection.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style type="text/css">

		body{
			background-image: url("image/back2.jpg");
		    -webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
			margin: 0;
		    font-family: Courier, "Lucida Console", monospace;
		}


		.home{
			width: 500px;
			height: 700px;
			text-align: center;
			background-color: rgba(0, 0, 0, 0);
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
	<div class="home">
		<figure>
			<img src="image/backFinal.png" alt="Logo" width="400" height="400" >
		</figure>
		<div class="btnHome" style="font-family: Tahoma, Geneva, sans-serif;">
			<a href="adminLogin.php" style="color: white;border:1px solid white;padding: 10px 30px;font-size: 18px;">ADMIN LOGIN</a>
			<a href="memberLogin.php" style="color: white;border:1px solid white;padding: 10px 30px;font-size: 18px;">MEMBER LOGIN</a>
		</div>
		
	</div>

</body>
</html>