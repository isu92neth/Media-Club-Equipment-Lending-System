<?php 
	include "connection.php";
	session_start();
	

	if(!isset($_SESSION['login_user'])){
		header('Location: index.php');
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Set Equipment Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">

		.updateID
		{
			padding-left: 400px;
		}
		h1{
			text-align: center;
			text-transform: uppercase;
			font-size: 60px;
			font-weight: bold;
			font-family: Courier, "Lucida Console", monospace;
			color: #81DAF5;
			-webkit-text-stroke: 2px black;
			text-shadow: 2px 2px 2px black;
		}

		h2{
			text-transform: uppercase;
			font-size: 40px;
			font-weight: bold;
			font-family: Courier, "Lucida Console", monospace;
			color: #81DAF5;
			-webkit-text-stroke: 2px black;
			text-shadow: 2px 2px 2px black;
		}
		body {
		  	font-family: Courier, "Lucida Console", monospace;
		  	background-image: url("image/f5.jpg");
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
			margin: 0;
		}

		.sidenav {
		  height: 100%;

		  width: 0;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: #111;
		  overflow-x: hidden;
		  transition: 0.5s;
		  padding-top: 60px;
		}

		.sidenav a {
		  padding: 8px 8px 8px 32px;
		  text-decoration: none;
		  font-size: 25px;
		  color: #818181;
		  display: block;
		  transition: 0.3s;
		}
		.sidenav a.topic:hover{
			color:white;
			width: 300px;
			height:50px;
			background-color: #575252;
		}

		.sidenav a:hover {
		  color: #f1f1f1;
		}

		.sidenav .closebtn {
		  position: absolute;
		  top: 0;
		  right: 25px;
		  font-size: 36px;
		  margin-left: 50px;
		}

		.member
		{
		    width: 400px;
		    margin: 0px auto;
		}
		.form-control
		{
		  background-color: #080707;
		  color: white;
		  height: 40px;
		}

		#main {
		  transition: margin-left .5s;
		  padding: 16px;
		}

		@media screen and (max-height: 450px) {
		  .sidenav {padding-top: 15px;}
		  .sidenav a {font-size: 18px;}
		}
		p{
			font-weight: bold;
			color: black;
		}
	
	</style>
</head>
<body>
	
	<!-- SIDENAV -->
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a class = "topic" href="rented.php">Back</a>
	</div>

	<div id="main">
	  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
	  <div class="container">
	  	<h2 style=" text-align: center">Set Returned</h2>
	  	<div class="updateID">
	  	<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="id" placeholder="Enter Rent ID" required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Show Details
				</button>
		</form>
	
		</div>
		<?php

		if(isset($_POST['submit1']))
		{

			$sql = "SELECT * from `rented` where `Equipment ID` = '$_POST[id]' ";
			$rs = mysqli_query($db, $sql);

			$fetchRow = mysqli_fetch_assoc($rs);
			

			if(mysqli_num_rows($rs) == 0)
			{
				?>
	 
			 	<script type="text/javascript">
		        	alert("Sorry....No such equipment!");
		     	</script>
		     	<?php

			}
			else if(mysqli_num_rows($rs) == 1)
			{
				
			
		?>

	  	<form class="member" action="" method="post">
	  		<p>Rent ID</p>
	  		<input type="text" name="ID" value="<?php echo $fetchRow['Equipment ID'] ?>" class="form-control" placeholder="Rent ID" readonly><br>
	  		<p>Is Returned</p>
	        <input type="text" name="Returned" value="<?php echo $fetchRow['Returned'] ?>" class="form-control" placeholder="Returned" ><br>

        <button style="text-align: center;" class="btn btn-default" type="submit" name="submit2" value="submit">SUBMIT</button>

	  		
	  	</form>
	  	<?php
	  		}
	  	
	  	}
	  	?>
	  </div>
	 
	<?php
	if(isset($_POST['submit2']))
	{
		$rentID = $_POST['ID'];
		$returnStatus = $_POST['Returned'];

		if($returnStatus == ""){
			?>
	 
			 	<script type="text/javascript">
		        	alert("Sorry....Please state if equipment is YES or NO!");
		     	</script>
		     	<?php
		}
		elseif($returnStatus == 'YES' or $returnStatus == 'NO'){
			$update = "UPDATE `rented` SET `Returned` = '$returnStatus' WHERE `Equipment ID` = '$rentID'";
		 	mysqli_query($db, $update);
		 	?>
	 
			 	<script type="text/javascript">
		        	alert("Request update successful!");
		     	</script>
		     	<?php
		}
		else{
			?>
	 
			 	<script type="text/javascript">
		        	alert("Wrong status....Please state if YES or NO!");
		     	</script>
		     	<?php
		}
	}
	?>
	

	</div>

	<script>
	function openNav() {
	  document.getElementById("mySidenav").style.width = "300px";
	  document.getElementById("main").style.marginLeft = "300px";
	  document.body.style.backgroundColor = "#740b2b";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.marginLeft= "0";
	  document.body.style.backgroundColor = "#c31348";
	}
	</script>


</body>
</html>