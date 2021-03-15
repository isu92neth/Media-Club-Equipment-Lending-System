<?php
include  "connection.php";
include  "naviBarMember.php";
if(!isset($_SESSION['user_member'])){
		header('Location: index.php');
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>
       EVENT_MEMBER PAGE
	</title>
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
 
		  
		thead tr th { 
		    width: 5%;
		    max-width: 60px;
		    height: 40px;  
		    line-height: 40px;
		    color: white; 
		    text-align: center;
		    border: 1px solid white;
		   
		} 
		  

		 
		tbody {  
		    border-top: 2px solid white; 
		    border-bottom: solid white; 
		} 
		tbody td
		{ 
		  
		    width:5%  ;
		    height: 50px;
		    max-width: 60px;
		    text-align: center;
		    word-break: break-all;
		    border: 1px solid white;
		    
		    color: white;
		   
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
			text-align: center;
			font-size: 40px;
			font-weight: bold; 
			color: white;
			text-transform: uppercase;
			font-family: Courier, "Lucida Console", monospace;
			
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
	<div id="main">
	
				<div class="box3" style="width: 1200px; height:520px; background-color: black;opacity: 0.7; margin: auto;">
					<br>
					<form name="search1" action="" method="post" style="padding-left: 10px;">
                    <h5 style="color: white;">Press 'Search' for search event ..</h5><br>
                    <input class="search"  type="text" name="search"  placeholder="Enter Event Name..">
                     <input class="search" type="Submit" name="Search" value="Search" style="width: auto;">
                     
                    </form><br>
					<h2 >Event Table</h2>
					<?php
					    function test_input($data) {
							  $data = trim($data);
							  $data = stripslashes($data);
							  $data = htmlspecialchars($data);
							  return $data;
					    }
					    if (isset($_POST['search'])){
	                        $name=$_POST['search'] ;
	                        $check=test_input($name);
	                    }
					    $res=mysqli_query($db,"SELECT * FROM `events`;");
					    if (isset($_POST['Search']) && (!empty($check)) ){
					    	$res=mysqli_query($db,"SELECT * FROM `events` WHERE `Event Name` LIKE '$check';");

					    	
					    } 
					    echo "<div class = 'table-wrapper-scroll-y my-custom-scrollbar'>";
						echo "<table class = 'table table-bordered table-fixed'>";
					    echo "<thead>";
					    echo "<tr style='background-color:white'>";
						    echo "<th>"; echo "Event Name"; echo "</th>"; 
						    echo "<th>"; echo "Venue"; echo "</th>";
						    echo "<th>"; echo "Start Time"; echo "</th>";
						    echo "<th>"; echo "End Time"; echo "</th>";
						    echo "<th>"; echo "Year"; echo "</th>";
						    echo "<th>"; echo "Month"; echo "</th>";
						    echo "<th>"; echo "Day"; echo "</th>";
						    echo "<th>"; echo "Member<br>F.Name"; echo "</th>";
						    echo "<th>"; echo "Member<br>L.Name"; echo "</th>";
						    echo "<th>"; echo "Faculty"; echo "</th>";
					    echo "</tr>";
					    echo "</thead>";
					    echo "<tbody>";
					    if ($res) {
					    	# code...
					    
						    while($row=mysqli_fetch_assoc($res))
						    {
						    	echo "<tr>";
						    	echo "<td>";echo $row['Event Name']; echo "</td>";
						    	echo "<td>";echo $row['Venue']; echo "</td>";
						    	echo "<td>";echo $row['Start Time']; echo "</td>";
						    	echo "<td>";echo $row['End Time']; echo "</td>";
						    	echo "<td>";echo $row['Year']; echo "</td>";
						    	echo "<td>";echo $row['Month']; echo "</td>";
						    	echo "<td>";echo $row['Day']; echo "</td>";
						    	echo "<td>";echo $row['Member F.Name']; echo "</td>";
						    	echo "<td>";echo $row['Member L.Name']; echo "</td>";
						    	echo "<td>";echo $row['Faculty']; echo "</td>";
						    	echo "</tr>";
						    }
						}
					    echo "</tbody>";
					    echo "</table>";
					     echo "</div>";
					 
					?>
					 
       
   
		
	</div>
</body>
</html>