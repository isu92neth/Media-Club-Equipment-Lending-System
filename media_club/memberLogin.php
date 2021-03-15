<?php 

    include "connection.php";
    session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Member Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">   
    <style type="text/css">
        body{
            background-image: url("image/camera16.jpg");
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
        <h1>MEMBER LOGIN</h1>
            <form name="adminLog" action="" method="post">
                <p>USERNAME</p>
                <input type="text" name="username" placeholder="Enter Username">
                <p>PASSWORD</p>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="submit" value="LOGIN">  
                <div class="back">
                    <a href="index.php">Back to home</a>
                </div> 
                
            </form>               
        </div>   
        <?php 
            if(isset($_POST['submit'])){
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $res=mysqli_query($db,"SELECT * FROM `crew member` WHERE `First Name` = '$user' && `ID` = '$pass';");

                $row= mysqli_fetch_assoc($res);
                if(mysqli_num_rows($res) == 0){
                    ?>
                    <script type="text/javascript">
                        alert("The username and password doesn't match.");
                    </script>   
                    <?php

                }
                else{
                    $user = $_POST['username'];
                    $_SESSION['user_member'] = $user;
                    ?>
                    <script type="text/javascript">
                        alert("The username and password matched.");
                    </script>   
                    <?php
                    
                    ?>
                      <script type="text/javascript">
                        window.location="home_member.php";
                      </script>
                    <?php
                
                }
            }

         ?>

    </body>
</html>