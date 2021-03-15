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
		    	if(isset($_SESSION['user_member'])){
		    		?>
		    		<nav class="">
					<div class="mainBar">
		    		<ul class="main">
		    			<li><a href="home_member.php">HOME</a></li>
						<li><a href="event_member.php">EVENTS</a></li>
						<li><a href="member_view.php">EQUIPMENT</a></li>
						<li class="right"><a href="memberLogout.php">LOG OUT</a></li>
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