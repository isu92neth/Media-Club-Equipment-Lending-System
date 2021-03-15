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
	<title>Equipment</title>
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
			background-image: url("image/mem3.jpg");
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

		
	
	</style>
</head>
<body>
	<!-- SEARCH BAR -->
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="Enter Member ID" required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>
	<h2>Equipment List</h2>
	<?php 

		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT * from `member` where `ID` = '$_POST[search]' ");

			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No member found. Try searching again.";
			}
			else
			{
				echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";
				echo "<table class = 'table table-bordered table-fixed'>";
				echo "<thead>";
				echo "<tr style = 'background-color: #313957;'>";
				echo "<th>"; echo "Member Name";  echo "</th>";
				echo "<th>"; echo "ID Number";  echo "</th>";
				echo "<th>"; echo "Event";  echo "</th>";
				echo "<th>"; echo "Equipment Name";  echo "</th>";
				echo "<th>"; echo "Serial Number";  echo "</th>";
				echo "<th>"; echo "Is Returned";  echo "</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
			

			while($row=mysqli_fetch_assoc($q))
			{
				echo "<tr>";
				echo "<td>"; echo $row['MEMBER_NAME']; echo "</td>";
				echo "<td>"; echo $row['ID']; echo "</td>";
				echo "<td>"; echo $row['EVENT']; echo "</td>";
				echo "<td>"; echo $row['EQUIPMENT']; echo "</td>";
				echo "<td>"; echo $row['SERIAL_NUMBER']; echo "</td>";
				echo "<td>"; echo $row['IS_RETUNED']; echo "</td>";

				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</div>";
			}
		}
		
		else
		{
			$res = mysqli_query($db,"SELECT * FROM `member`;");

			echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";
			echo "<table class = 'table table-bordered table-fixed'>";
			echo "<thead>";
			echo "<tr style = 'background-color: #313957;'>";
			echo "<th>"; echo "Member Name";  echo "</th>";
			echo "<th>"; echo "ID Number";  echo "</th>";
			echo "<th>"; echo "Event";  echo "</th>";
			echo "<th>"; echo "Equipment Name";  echo "</th>";
			echo "<th>"; echo "Serial Number";  echo "</th>";
			echo "<th>"; echo "Is Returned";  echo "</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";

			while($row=mysqli_fetch_assoc($res))
				{
					echo "<tr>";
					echo "<td>"; echo $row['MEMBER_NAME']; echo "</td>";
					echo "<td>"; echo $row['ID']; echo "</td>";
					echo "<td>"; echo $row['EVENT']; echo "</td>";
					echo "<td>"; echo $row['EQUIPMENT']; echo "</td>";
					echo "<td>"; echo $row['SERIAL_NUMBER']; echo "</td>";
					echo "<td>"; echo $row['IS_RETUNED']; echo "</td>";

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