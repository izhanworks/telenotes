
<?php

include('dbconnection.php');
include('user_auth.php');  
   if ($chatId == $teleid){   

      $getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getfile?file_id=".$docfileid),true);
      $getfilepath2 = $getfilepath["result"]["file_path"];
      $resultflag = $getfilepath["ok"];
      if ($resultflag == "true"){
      	$randomid = secure_random_string(3);
      $downlink = "https://api.telegram.org/file/bot".$token."/".$getfilepath2;
 /*
     $getserver = json_decode(file_get_contents("https://api.gofile.io/getServer"),true);
      $getserverlist = $getserver["data"]["server"];
      */
      file_put_contents($docfilename, file_get_contents($downlink));
   /*   
        $ch = curl_init();
    	$url = 'https://'.$getserverlist.'.gofile.io/uploadFile';
    	$post_data = array("document" => new CURLFile(realpath($docfilename)));
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
    	$data =curl_exec($ch);
    	curl_close($ch);
    	$res= json_decode($data,TRUE);
    	$src = $res['data']['downloadPage'];
        
      $replyMsg = "File Name : ".$docfilename." \n======================\nDownload Link :\n".$src."\n======================";
    
    $parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "disable_web_page_preview" => true,
        "parseMode" => "markdown"
    );

    send("sendMessage", $parameters);
  */    
     $parameters2 = array(
        "chat_id" => $chatId,
        "document" => new CURLFile(realpath($docfilename)),
        "parseMode" => "html"
    );

    send("sendDocument", $parameters2);
unlink($docfilename);   

$query=mysqli_query($con, "insert into tblstpdf(file_id, file_name, file_unique_id, file_size, randomid) value('$docfileid', '$docfilename', '$docfileuniqueid', '$docfilesize', '$randomid')");
    	if ($query) {

          $replyMsg7 = 
"Entry Added Successfully to database!!
=========================
File_ID : ".$docfileid."
File_Name : ".$docfilename."
Unique_ID : ".$docfileuniqueid."
File_Size : ".$docfilesize."
SID : ".$randomid."
=========================";

        }
  		else
    	{
        $replyMsg7 = "Sorry Invalid !!!\n=========================\nSomething Went Wrong. Please try again\n========================="; 
    	}       		        
	   
         $parameters7 = array(
        "chat_id" => $chatId,
        "text" => $replyMsg7,
        "parseMode" => "html"
    	);

    	send("sendMessage", $parameters7);
        
    } 
      else {
      $replyMsg = "Hello ".$userName."\n\n======================\nBad Request: file is too big.\nMaximum File Size : 20Mb\n======================";
    
    	$parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "parseMode" => "html"
    	);

    	send("sendMessage", $parameters);
      }    
      }
        else {
            $replyMsg8 = "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================";
        }

        $parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);
     
    


?>