<?php 
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){  
	
       $value = substr($message, 7);
       
        $str = $value;

        $hex = hash('crc32b',$str); // in hex
        $dec = crc32($str);
       
       if ($value == NULL){
       $replyMsg7 = "
Hex crc32 Checksum
===================
Invalid!!! String cannot be empty!
===================";
       }
       else {
       $replyMsg7 = "
Hex crc32 Checksum
===================
string : ".$str."
crc32 : ".$hex."
===================";
}       
}
         
         else {
       $replyMsg7 = "
Hex crc32 Checksum
===================
Unauthorized to use command!!!
===================";
         }
    $parameters7 = array(
        "chat_id" => $chatId,
        "text" => $replyMsg7,
        "parseMode" => "html"
    );
    send("sendMessage", $parameters7);
		
		
?>