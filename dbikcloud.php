<?php
$con2=mysqli_connect("127.0.0.1", "databasename", "dbpassword", "dbuser");
     
 if(mysqli_connect_errno()){
        $replyMsg7 = "Database Connection Error";
        echo "Connection Fail".mysqli_connect_error();
        } 
?>
