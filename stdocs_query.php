<?php

include('dbconnection.php');
include('user_auth.php');  
   if ($chatId == $teleid){   

      $getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getfile?file_id=".$docfileid),true);
      $getfilepath2 = $getfilepath["result"]["file_path"];
      $resultflag = $getfilepath["ok"];
      if ($resultflag && $getfilepath2) {
      $randomid = secure_random_string(3);
      $downlink = "https://api.telegram.org/file/bot".$token."/".$getfilepath2;

      file_put_contents($docfilename, file_get_contents($downlink));

     $parameters2 = array(
        "chat_id" => $chatId,
        "document" => new CURLFile(realpath($docfilename)),
        "parseMode" => "html"
    );

    send("sendDocument", $parameters2);
    unlink($docfilename);   

$query=mysqli_query($con, "insert into tblstpdf(file_id, file_name, file_unique_id, file_size, randomid) value('$docfileid', '$docfilename', '$docfileuniqueid', '$docfilesize', '$randomid')");
    	if ($query) {

$replyMsg = 
"Entry Added Successfully to database!!
=========================
File_ID : ".$docfileid."
File_Name : ".$docfilename."
Unique_ID : ".$docfileuniqueid."
File_Size : ".$docfilesize."
SID : ".$randomid."
=========================";
$parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "parseMode" => "html"
    	);

    	send("sendMessage", $parameters);

     }
		else
    	{
		sendErrorMessage($chatId, "Invalid: Something Went Wrong. Please try again.");
	}       		       
        
     }
      	else {
		sendErrorMessage($chatId, "Bad Request: file is too big. Maximum File Size: 20MB.");
      }    
      }
        	else {
		sendErrorMessage($chatId, "Unauthorized: You are not allowed to use this command.");
}
     
    


?>