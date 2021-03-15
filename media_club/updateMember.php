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
	<title>Update Crew Members</title>
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
	  <a class = "topic" href="crew_members.php">Back</a>
	</div>

	<div id="main">
	  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
	  <div class="container">
	  	<h2 style=" text-align: center">Update Member</h2>
	  	<div class="updateID">
	  	<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="id" placeholder="Enter Member ID" required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Show Member
				</button>
		</form>
	
		</div>
		<?php

		if(isset($_POST['submit1']))
		{

			$sql = "SELECT * from `crew member` where ID = '$_POST[id]' ";
			$rs = mysqli_query($db, $sql);

			if(mysqli_num_rows($rs) == 0)
			{
				?>
	 
			 	<script type="text/javascript">
		        	alert("Sorry....No such member!");
		     	</script>
		     	<?php

			}
			else if(mysqli_num_rows($rs) == 1)
			{
				$fetchRow = mysqli_fetch_assoc($rs);

			
			 
			
			
			
			
		?>

		<div>
	  	<form class="member" action="" method="post">
	  		<p>REGISTRATION NUMBER</p>
	  		<input type="text" name="RegistrationNumber" value="<?php echo $fetchRow['Registration Number'] ?>" class="form-control" placeholder="Registration Number" readonly><br>
	  		<p>ID NUMBER</p>
	        <input type="text" name="ID" value="<?php echo $fetchRow['ID'] ?>" class="form-control" placeholder="ID" readonly><br>
	        <p>FIRST NAME</p>
	        <input type="text" name="FirstName" value="<?php echo $fetchRow['First Name'] ?>" class="form-control" placeholder="First Name" required=""><br>
	        <p>MIDDLE NAME</p>
	        <input type="text" name="MiddleName" value="<?php echo $fetchRow['Middle Name'] ?>" class="form-control" placeholder="Middle Name" ><br>
	        <p>LAST NAME</p>
	        <input type="text" name="LastName" value="<?php echo $fetchRow['Last Name'] ?>" class="form-control" placeholder="Last Name" required=""><br>
	        <p>FACULTY</p>
	        <input type="text" name="Faculty" value="<?php echo $fetchRow['Faculty'] ?>" class="form-control" placeholder="Faculty" required=""><br>
	        <p>CURRENT EVENT</p>
	        <input type="text" name="CurrentEvent" value="<?php echo $fetchRow['Current Event'] ?>" class="form-control" placeholder="Current Event" ><br>

        <button style="text-align: center;" class="btn btn-default" type="submit" name="submit2" value="submit">UPDATE MEMBER</button>

	  		
	  	</form>
	  	<?php
	  		}
	  	}
	  	?>
	  	</div>
	  </div>
	 
	<?php
	if(isset($_POST['submit2']))
	{
		$regNum = $_POST['RegistrationNumber'];
		$idnum = $_POST['ID'];
		$fName = $_POST['FirstName'];
		$mName = $_POST['MiddleName'];
		$lName = $_POST['LastName'];
		$fac =  $_POST['Faculty'];
		$event = $_POST['CurrentEvent'];

		$checkEvent = "SELECT * FROM `event` WHERE `Event Name` ='$event'";
		$resEvent = mysqli_query($db, $checkEvent);

		if(mysqli_num_rows($resEvent) == 1){
			$update = "UPDATE `crew member` SET `Registration Number` = '$regNum', `First Name` = '$fName', `Middle Name` = '$mName', `Last Name` = '$lName', `Faculty` = '$fac', `Current Event` = '$event' WHERE `crew member`.`ID` = '$idnum'";
			 mysqli_query($db, $update);
			 ?>
				 
			<script type="text/javascript">
			    alert("Member Updated Successfully!");
			</script>
			<?php

		}
		elseif($event == ""){
			$update = "UPDATE `crew member` SET `Registration Number` = '$regNum', `First Name` = '$fName', `Middle Name` = '$mName', `Last Name` = '$lName', `Faculty` = '$fac', `Current Event` = NULL WHERE `crew member`.`ID` = '$idnum'";
			 mysqli_query($db, $update);
			 ?>
				 
			<script type="text/javascript">
			    alert("Member Updated Successfully!");
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