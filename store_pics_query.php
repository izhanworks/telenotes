<?php
     
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   
	
	foreach ($update["message"]["photo"] as $photo)
{
	$imgfileid = $photo["file_id"];
	$imgfilesize = $photo["file_size"];
    $imgfileuniqueid = $photo["file_unique_id"];
}
	   
		$getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getfile?file_id=".$imgfileid),true);
		$getfilepath2 = $getfilepath["result"]["file_path"];
		$resultflag = $getfilepath["ok"];  
		if ($resultflag == "true"){
	    $randomid = secure_random_string(3);
        $downlink = "https://api.telegram.org/file/bot".$token."/".$getfilepath2;  
        file_put_contents('image.jpg', file_get_contents($downlink));
        $query=mysqli_query($con, "insert into tblstpic(file_id, unique_id, file_size, randomid) value('$imgfileid', '$imgfileuniqueid', '$imgfilesize', '$randomid')");
    if ($query) {
    	   
      $ch = curl_init();
    	$url = 'https://telegra.ph/upload';
    	$post_data = array("photo" => new CURLFile(realpath("image.jpg")));
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
    	$data =curl_exec($ch);
    	curl_close($ch);
    	$res= json_decode($data,TRUE);
    	$src = $res[0]['src'];
	
	}
        
        $replyMsg = "
Image Detail : ".$randomid."
======================
File ID : ".$imgfileid."
Unique ID : ".$imgfileuniqueid."
File Size : ".$imgfilesize."
Download Link : https://telegra.ph".$src."
======================";
    
    	$parameters = array(
        "chat_id" => $chatId,
        "text" => $replyMsg,
        "disable_web_page_preview" => true,
        "parseMode" => "markdown"
    	);
        
        send("sendMessage", $parameters);
/*        
         $parameters2 = array(
        "chat_id" => $chatId,
        "photo" => "https://telegra.ph".$src,
        "caption" => $downlink
    	);

    	send("sendPhoto", $parameters2);
	*/
	    unlink('image.jpg');
	}
     
    else {
      $replyMsg = "Hello ".$fullName."\n\n======================\nBad Request: file is too big.\nMaximum File Size : 20Mb\n======================";
    
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