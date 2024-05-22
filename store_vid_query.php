
<?php

include('dbconnection.php');
include('user_auth.php');  
   if ($chatId == $teleid){   

      $getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getfile?file_id=".$videofileid),true);
      $getfilepath2 = $getfilepath["result"]["file_path"];
      $resultflag = $getfilepath["ok"];
      if ($resultflag == "true"){
	$randomid = secure_random_string(3);
      $downlink = "https://api.telegram.org/file/bot".$token."/".$getfilepath2;
      file_put_contents($videofilename2, file_get_contents($downlink));
      
     $parameters2 = array(
        "chat_id" => $chatId,
        "video" => new CURLFile(realpath($videofilename2)),
        "parseMode" => "html"
    );

    	send("sendVideo", $parameters2);
      	unlink($videofilename2);
      
    	 $query=mysqli_query($con, "insert into tblstvid(file_id, file_name, file_size, randomid) value('$videofileid', '$videofilename2', '$videofilesize', '$randomid')");
    	if ($query) {

          $replyMsg7 = "
Entry Added Successfully to database!!
=========================
File_ID : ".$videofileid."
File_Name : ".$videofilename2."
File_Size : ".$videofilesize."
SID : ".$randomid."
=========================";
$parameters7 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg7,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters7);

        }
    
    } 
      else {
      $replyMsg =
"Hello ".$fullName."
======================
Bad Request: file is too big.
Maximum File Size : 20Mb
======================";
    
    	$parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "parseMode" => "html"
    	);

    	send("sendMessage", $parameters);
      }   
      }  
       else {
            $replyMsg6 = "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================";
            $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
            }


?>