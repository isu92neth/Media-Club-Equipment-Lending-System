<?php 
	include "connection.php";
	include "naviBar.php";
	
	if(!isset($_SESSION['login_user'])){
		header('Location: index.php');
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Club Owned</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.table-fixed thead th { position: sticky; top: 0; background-color: #313957; }

		.my-custom-scrollbar {
		position: relative;
		height: 200px;
		overflow: auto;
		}
		.table-wrapper-scroll-y {
		display: block;
		}
		th{
			color: white;
		}
		tr{
			color: white;
			font-weight: bold;
			text-shadow: 2px 2px 2px black;
		}
		tr:hover{
			background-color: rgba(0, 0, 0, 0.7);
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
		body{
			background-image: url("image/img2.jpg");
			-webkit-background-size:cover;
			-moz-background-size:cover;
			-o-background-size:cover;
			background-size: cover;
			margin: 0;
		}
		.srch
		{
			padding-left: 1000px;

		}
		body {
		  font-family: Courier, "Lucida Console", monospace;
		  transition: background-color .5s;
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
	  <a class = "topic" href="addClubOwned_eq.php">Add Equipment</a>
	</div>

	<div id="main">
	  <span style="font-size:30px;cursor:pointer; color: white;" onclick="openNav()">&#9776; open</span>
	

	<script>
	function openNav() {
	  document.getElementById("mySidenav").style.width = "300px";
	  document.getElementById("main").style.marginLeft = "300px";
	  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
	}

	function closeNav() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.marginLeft= "0";
	  document.body.style.backgroundColor = "white";
	}
	</script>
	<!-- SEARCH BAR -->
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="Enter Eq Identity Number" required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="id" placeholder="Enter Eq Identity Number" required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Delete
				</button>
		</form>
	</div>
	<h2>Club Owned Equipment List</h2>
	<?php 

		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT * from `club owned` where `Equipment Identification Number` = '$_POST[search]' ");

			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No equipment found. Try searching again.";
			}
			else
			{
				echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";
				echo "<table class = 'table table-bordered table-fixed'>";
				echo "<thead>";
				echo "<tr style = 'background-color: #313957;'>";
				echo "<th>"; echo "Equipment Identification Number";	echo "</th>";
				echo "<th>"; echo "Donor";  echo "</th>";
				echo "<th>"; echo "Date Donated";  echo "</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
			

			while($row=mysqli_fetch_assoc($q))
			{
				echo "<tr>";
				echo "<td>"; echo $row['Equipment Identification Number']; echo "</td>";
				echo "<td>"; echo $row['Donor']; echo "</td>";
				echo "<td>"; echo $row['Date Donated']; echo "</td>";

				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			}
		}
		else if(isset($_POST['submit1']))
		{
			$check = "SELECT * FROM `club owned` where `Equipment Identification Number` = '$_POST[id]'";
			$checkDelete = mysqli_query($db, $check);

			if(mysqli_num_rows($checkDelete) == 0){
				echo "No such equipment!";
			}
			elseif (mysqli_num_rows($checkDelete) == 1) {
				mysqli_query($db,"DELETE from `club owned` where `Equipment Identification Number` = '$_POST[id]'; ");
				$res = mysqli_query($db,"SELECT * FROM `club owned`;");

				?>
				<script type="text/javascript">
			        alert("Equipment Deleted Successfully.");
			     </script>
				<?php
				echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";
				echo "<table class = 'table table-bordered table-fixed'>";
				echo "<thead>";
				echo "<tr style = 'background-color: #313957;'>";
				echo "<th>"; echo "Equipment Identification Number";	echo "</th>";
				echo "<th>"; echo "Donor";  echo "</th>";
				echo "<th>"; echo "Date Donated";  echo "</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";

				while($row=mysqli_fetch_assoc($res))
					{
						echo "<tr>";
						echo "<td>"; echo $row['Equipment Identification Number']; echo "</td>";
						echo "<td>"; echo $row['Donor']; echo "</td>";
						echo "<td>"; echo $row['Date Donated']; echo "</td>";

						echo "</tr>";
					}
					echo "</tbody>";
				echo "</table>";
				echo "</div>";
			}

			


		}

		else
		{
			$res = mysqli_query($db,"SELECT * FROM `club owned`;");
			echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";

			echo "<table class = 'table table-bordered table-fixed'>";
			echo "<thead>";
			echo "<tr style = 'background-color: #313957;'>";
			echo "<th>"; echo "Equipment Identification Number";	echo "</th>";
			echo "<th>"; echo "Donor";  echo "</th>";
			echo "<th>"; echo "Date Donated";  echo "</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			while($row=mysqli_fetch_assoc($res))
				{
					echo "<tr>";
					echo "<td>"; echo $row['Equipment Identification Number']; echo "</td>";
					echo "<td>"; echo $row['Donor']; echo "</td>";
					echo "<td>"; echo $row['Date Donated']; echo "</td>";

					echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
			echo "</div>";

		}
		
		
			
		
	
	?>
	</div>

</body>
</html>