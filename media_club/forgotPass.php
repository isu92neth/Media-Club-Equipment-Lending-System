<?php 

    include "connection.php";
    session_start();



?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">   
    <style type="text/css">
        body{
            background-image: url("image/camera6.jpg");
            -webkit-background-size:cover;
            -moz-background-size:cover;
            -o-background-size:cover;
            background-size: cover;
            margin: 0;
        }
        h1{
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
            font-style: Serif;
        }

    </style>
</head>
    <body>
    <div class="adLogin">
    <img src="image/logo3.png" class="logo">
        <h1>FORGOT PASSWORD</h1>
            <form name="adminLog" action="" method="post">
                <p>USERNAME</p>
                <input type="text" name="username" placeholder="Enter your username">
                <p>ID NUMBER</p>
                <input type="text" name="id" placeholder="Enter your ID number">
                <input type="submit" name="submit" value="SEARCH">  
                <div class="back">
                    <a href="index.php">Back to home</a>
                </div> 
                
            </form>               
        </div>  
       
        <?php 
            if(isset($_POST['submit'])){
                $user = $_POST['username'];
                $idNumF = $_POST['id'];
                $res=mysqli_query($db,"SELECT * FROM `administator` WHERE `Username`='$user' && `Admin ID`='$idNumF';");

                if(mysqli_num_rows($res) == 0){
                    ?>
                    <script type="text/javascript">
                        alert("Sorry....No such record!");
                    </script>   
                    <?php

                }
                else{
                	?>
                	<script type="text/javascript">
                        window.location="newPassword.php";
                      </script>
				  	<?php

				}
			}
		?>
	 </body> 			  	

    
</html>