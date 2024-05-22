<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){  

$replyMsg8 = "Your Telegram ID is :";
$replyMsg9 = $userteleid;
               
			$parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);
    		$parameters9 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg9,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters9);
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