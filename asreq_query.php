<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   

$value = substr($message, 7);
        if ($value == NULL){
            sendErrorMessage($chatId, "Invalid !!!\n=========================\n Data cannot be empty !!!\n=========================");
            exit;
        }
        else{
$value = preg_replace('/[^a-zA-Z0-9# -]/', '', $value);
        // Regular expression to match the required fields
        preg_match('/#dt (\S+)/', $value, $dateMatch);
        preg_match('/#sr (\S+)/', $value, $srMatch);
        preg_match('/#lc ([^#]+)/', $value, $locationMatch);
        preg_match('/#tm ([^#]+)/', $value, $timeMatch);
        preg_match('/#rm (.+)/', $value, $remarkMatch);

        $date = $dateMatch[1] ?? '';
        $sereq = $srMatch[1] ?? '';
        $location = trim($locationMatch[1] ?? '');
        $time = trim($timeMatch[1] ?? '');
        $remark = trim($remarkMatch[1] ?? '');
// Check if all required fields are extracted
        if (empty($date) || empty($sereq) || empty($location) || empty($time) || empty($remark)) {
            sendErrorMessage($chatId, "Invalid !!!\n=========================\n One or more required fields are missing !!!\n=========================");
            $parameters6 = array(
                "chat_id" => $chatId,
                "text" => $replyMsg6,
                "parseMode" => "html"
            );
            send("sendMessage", $parameters6);
            exit;
        }
$randomid = secure_random_string(3);
$tid = time();
          
$query=mysqli_query($con, "insert into tblsreq(date, sr, location, time, remark, randomid, id) value('$date', '$sereq', '$location', '$time', '$remark', '$randomid', '$tid' )");
    	if ($query) {
		
          $replyMsg7 = 
"Entry Added Successfully !!!
=========================
Date : ".$date."
SR : ".$sereq."
Location : ".$location."
Time : ".$time."
Remark : ".$remark."
SRID : ".$randomid."
=========================";

   $parameters7 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg7,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters7);
        
        }
  		else
    	{
        sendErrorMessage($chatId, "Sorry Invalid !!!\n=========================\nSomething Went Wrong. Please try again\n========================="); 
    	}       		
               
        }
        }
        else {
            sendErrorMessage($chatId, "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================");
        }

	?>	
		
		
		
		