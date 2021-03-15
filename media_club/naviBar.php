<?php
	include "connection.php";
  session_start();




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
	<header>
		<h1>PERA INFINITE MEDIA CLUB</h1>
	</header>
	
			<?php 
		    	if(isset($_SESSION['login_user'])){
		    		?>
		    		<nav class="">
					<div class="mainBar">
		    		<ul class="main">
		    			<li><a href="homeAdmin.php">HOME</a></li>
						<li><a href="event.php">EVENTS</a></li>
						<li><a href="crew_members.php">CREW MEMBERS</a></li>
						<li><a href="equipment.php">EQUIPMENT</a></li>
						<li><a href="club_owned.php">CLUB OWNED</a></li>
						<li><a href="member_owned.php">MEMBER OWNED</a></li>
						<li><a href="rented.php">RENTED</a></li>
						<li class="right"><a href="adminLogout.php">LOG OUT</a></li>
					</ul>
					</div>
		
					</nav>

		    		<?php

		    	}
		    	else{
		    		?>
		    		<script type="text/javascript">
                        window.location="index.php";
                      </script>
					<?php
		    	}
		     ?>	
		
    
	

</body>
</html>