<!--regards to Member Owned Section of Admin adding new memberOwned equipment to db-->
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
	<title>Add Member Owned Equipment</title>

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
		.srch
		{
			padding-left: 1000px;

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
	
	</style>
</head>
<body>
	
	<!-- SIDENAV -->
	<div id="mySidenav" class="sidenav">
	  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	  <a class = "topic" href="member_owned.php">Back</a>
	</div>

	<div id="main">
	  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
	  <div class="container">
	  	<h2 style=" text-align: center">Add New Equipment - Member Owned</h2>
	  	<form class="member" action="" method="post">
	  		<input type="number" name="EquipmentIndexNumber" class="form-control" placeholder="Equipment Index Number" required=""><br>
	        <input type="text" name="MemberID" class="form-control" placeholder="Member ID" required=""><br>
	        <input type="text" name="EquipmentModel" class="form-control" placeholder="Equipment Model" required=""><br>
	        <input type="text" name="EquipmentName" class="form-control" placeholder="Equipment Name" ><br>

        <button style="text-align: center;" class="btn btn-default" type="submit" name="submit" value="submit">ADD EQUIPMENT</button>
	  		
	  	</form>
	  </div>
	 
	<?php
if(isset($_POST['submit']))
{	 
	$eqIndexNum = $_POST['EquipmentIndexNumber'];
	$memID = $_POST['MemberID'];
	$eqModel = $_POST['EquipmentModel'];
	$eqName = $_POST['EquipmentName'];

	$checkMemEq = "SELECT * FROM `equipment` WHERE `Serial Number` = '$eqIndexNum'";
	$result = mysqli_query($db, $checkMemEq);

	$max = 2147483647;
	$min = 0;

	if(mysqli_num_rows($result) == 0){
		$check = "SELECT * FROM `crew member` WHERE ID ='$memID'";
		$checkID = mysqli_query($db, $check);

		if($eqIndexNum < $max and $eqIndexNum >= $min){
			if(mysqli_num_rows($checkID) == 0)
			{
				?>
			 
			 	<script type="text/javascript">
		        	alert("Sorry....No such member!");
		     	</script>
		     	<?php
			}
			else if(mysqli_num_rows($checkID) == 1)
			{
				$sql = "CALL `insert_member_owned`('$eqIndexNum', '$memID', '$eqModel', '$eqName')";

			 
			 	mysqli_query($db, $sql);
			 	?>
			 
			 	<script type="text/javascript">
		        	alert("Equipment Added Successfully.");
		     	</script>
		     	<?php
			}
		}
		else{
			?>
			 
			 <script type="text/javascript">
		        alert("Equipment Serial Number is invalid!");
		     </script>
		     <?php
		}

		
	}
	else{
		?>
		 
		 <script type="text/javascript">
	        alert("Equipment serial number already exists!.");
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
	  document.body.style.backgroundColor = "#0d518c";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.marginLeft= "0";
	  document.body.style.backgroundColor = "#5cabf0";
	}
	</script>


</body>
</html>