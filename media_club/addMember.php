
<!--regards to Member Section of Admin adding new member to member table-->
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
	<title>Add Crew Members</title>
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
	  <a class = "topic" href="crew_members.php">Back</a>
	</div>

	<div id="main">
	  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
	  <div class="container" style="text-align: center;">
	  	<h2 style="text-align: center">Add New Member</h2>
	  	<form class="member" action="" method="post">
	  		<input type="text" name="RegistrationNumber" class="form-control" placeholder="Registration Number" required=""><br>
	        <input type="text" name="ID" class="form-control" placeholder="ID" required=""><br>
	        <input type="text" name="FirstName" class="form-control" placeholder="First Name" required=""><br>
	        <input type="text" name="MiddleName" class="form-control" placeholder="Middle Name" ><br>
	        <input type="text" name="LastName" class="form-control" placeholder="Last Name" required=""><br>
	        <input type="text" name="Faculty" class="form-control" placeholder="Faculty" required=""><br>
	        <input type="text" name="CurrentEvent" class="form-control" placeholder="Current Event" ><br>

        <button class="btn btn-default" type="submit" name="submit" value="submit">ADD MEMBER</button>

	  		
	  	</form>
	  </div>
	 
	<?php
if(isset($_POST['submit']))
{	 
	$regNum = $_POST['RegistrationNumber'];
	$idnum = $_POST['ID'];
	$fName = $_POST['FirstName'];
	$mName = $_POST['MiddleName'];
	$lName = $_POST['LastName'];
	$fac =  $_POST['Faculty'];
	$event = $_POST['CurrentEvent'];

	$checkMem = "SELECT * FROM `crew member` WHERE `ID` ='$idnum'";
	$result = mysqli_query($db, $checkMem);

	$checkMemReg = "SELECT * FROM `crew member` WHERE `Registration Number` ='$regNum'";
	$resultReg = mysqli_query($db, $checkMemReg);

	$checkMemEvent = "SELECT * FROM `event` WHERE `Event Name` ='$event'";
	$resultEvent = mysqli_query($db, $checkMemEvent);

	if(mysqli_num_rows($result) == 0){
		if(mysqli_num_rows($resultReg) == 0){
			if(strlen($idnum) != 10){
				?>
				 
				<script type="text/javascript">
				    alert("Wrong format of ID number!");
				</script>
				<?php

			}
			else{
				if(mysqli_num_rows($resultEvent) == 1 or $event == ""){

				if($mName == "" && $event == ""){
					$sql = "INSERT INTO `crew member` (`Registration Number`, `ID`, `First Name`, `Middle Name`, `Last Name`, `Faculty`, `Current Event`) VALUES ('$regNum', '$idnum', '$fName', NULL, '$lName', '$fac', NULL)";
				}
				else if($mName == ""){
					$sql = "INSERT INTO `crew member` (`Registration Number`, `ID`, `First Name`, `Middle Name`, `Last Name`, `Faculty`, `Current Event`) VALUES ('$regNum', '$idnum', '$fName', NULL, '$lName', '$fac', '$event')";
				}
				else if($event == ""){
					$sql = "INSERT INTO `crew member` (`Registration Number`, `ID`, `First Name`, `Middle Name`, `Last Name`, `Faculty`, `Current Event`) VALUES ('$regNum', '$idnum', '$fName', '$mName', '$lName', '$fac', NULL)";
				}
				else{
					$sql = "INSERT INTO `crew member` (`Registration Number`, `ID`, `First Name`, `Middle Name`, `Last Name`, `Faculty`, `Current Event`) VALUES ('$regNum', '$idnum', '$fName', '$mName', '$lName', '$fac', '$event')";
				}

				 
				 mysqli_query($db, $sql);
				 ?>
				 
				 <script type="text/javascript">
			        alert("Member Added Successfully.");
			     </script>
			     <?php

			}
			
			else{
				?>
		 
				 <script type="text/javascript">
			        alert("No such event!");
			     </script>
			     <?php
			}
			}
			
		}
		else{
			?>
		 
			 <script type="text/javascript">
		        alert("Register Number already exists!");
		     </script>
		     <?php
		}
	}
	else{
		?>
		 
		<script type="text/javascript">
		    alert("Member ID already exists!");
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