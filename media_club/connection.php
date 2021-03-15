<?php
   $db=mysqli_connect("localhost","root","","media");
   if(!$db)
   {
      die("connection failed : ".mysqli_connect_error());
   }
   

?>