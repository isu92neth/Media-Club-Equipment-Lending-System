<?php 

    include "connection.php";
    session_start();



?>

<!DOCTYPE html>
<html>
<head>
    <title>Password Recovery</title>
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
        <h1>PASSWORD RECOVERY</h1>
        <form name="adminLog" action="" method="post">
            <p>NEW PASSWORD</p>
            <input type="password" name="password" placeholder="Enter your new password">
            <p>CONFIRM PASSWORD</p>
            <input type="password" name="conPass" placeholder="Confirm your password">
            <input type="submit" name="submit" value="UPDATE">  
            <div class="back">
                <a href="index.php">Back to home</a>
            </div> 
                                    
        </form>               
    </div>  
    
    <?php 
        if(isset($_POST['submit'])){
            $pass = $_POST['password'];
            $cPass = $_POST['conPass'];
            
            if($pass == $cPass){
                $updatePass = "UPDATE `administator` SET `Password` = '$cPass'";
                mysqli_query($db, $updatePass);
                ?>
                <script type="text/javascript">
                    alert("Password Recovery Successful!");
                </script>   
               
                <script type="text/javascript">
                    window.location="adminLogin.php";
                </script>
                <?php
            }
            else{
                ?>
                <script type="text/javascript">
                    alert("Password confirmation failed!");
                </script>   
                <?php
            }

		}
		?>
	</body> 		  	

    
</html>