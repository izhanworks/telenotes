<?php
     
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   

$getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getfile?file_id=".$docfileid),true);
$getfilepath2 = $getfilepath["result"]["file_path"] ?? null ;
$resultflag = $getfilepath["ok"] ?? false ;  

if ($resultflag && $getfilepath2) {
$randomid = secure_random_string(3);
$downlink = "https://api.telegram.org/file/bot".$token."/".$getfilepath2;  
$query=mysqli_query($con, "insert into tblstpic(file_id, unique_id, file_size, randomid) value('$docfileid', '$docfileuniqueid', '$docfilesize', '$randomid')");
    	
if ($query) {
      $ch = curl_init();
    	$url = 'https://telegra.ph/upload';
        if ($docmime == "image/jpeg"){	
        file_put_contents('image.jpg', file_get_contents($downlink));
    	$post_data = array("photo" => new CURLFile(realpath("image.jpg")));
        }
        if ($docmime == "image/png"){	
        file_put_contents('image.png', file_get_contents($downlink));
    	$post_data = array("photo" => new CURLFile(realpath("image.png")));
        }
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
    	$data =curl_exec($ch);
    	curl_close($ch);
    	$res= json_decode($data,TRUE);
    	$src = $res[0]['src'] ?? null ;
        
    if ($src){
$replyMsg = "
Image Detail : ".$randomid."
======================
File ID : ".$docfileid."
Unique ID : ".$docfileuniqueid."
File Size : ".$docfilesize."
Download Link : https://telegra.ph".$src."
======================";
    
    	$parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "disable_web_page_preview" => true,
        "parseMode" => "markdown"
    	);
		send("sendMessage", $parameters);

		   // Clean up the files
      if ($docmime === "image/jpeg") {
      unlink('image.jpg');
      } else if ($docmime === "image/png") {
      unlink('image.png');
      }
    } 
	}   
	//end query
	
else{
	sendErrorMessage($chatId, "Failed to insert image data into the database.");
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