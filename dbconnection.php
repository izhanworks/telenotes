<?php
$con=mysqli_connect("localhost", "databasename", "dbpassword", "dbuser");

     
 if(mysqli_connect_errno()){
        $replyMsg7 = "Database Connection Error";
        echo "Connection Fail".mysqli_connect_error();
        } 
?>
