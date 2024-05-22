<?php

$replyMsg6 = "
Bot Function !!!
=========================
Bot Capturing Video Docs and Image 
=========================";
            $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);


?>