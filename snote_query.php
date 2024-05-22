<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   

   	$titles = substr($message, 7);
          
    $ret=mysqli_query($con,"select * from tblnotes where randomid ='$titles'");
		
		$cnt=1;
		while ($row=mysqli_fetch_array($ret)) {
		$title = $row['title'];
		$notes = $row['notes'];
		$randomid = $row['randomid'];
		$id = $row['id'];
		$cnt=$cnt+1;
		}
		
		$resultdata = array(
             'title'    =>     $title,
             'notes'    =>     $notes,
             'randomid'    =>     $randomid,
             'id'    =>     $id
        );

        $final_data = json_encode($resultdata, JSON_PRETTY_PRINT);
        $dataresult =  json_decode($final_data,true);


        $rtitle = $dataresult['title'];
        $rnotes = $dataresult['notes'];
        $rrandomid = $dataresult['randomid'];
        $rrid = $dataresult['id'];
        
        if ($rtitle === NULL){
            $replyMsg7 = "General Notes List :\n===================\nSorry, No Result Found!\n===================";
  $parameters7 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg7,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters7);
$totalmsg = 2;
include('del_msg.php');
       }
        else{
        	              
            $replyMsg7 = "
General Notes List :  ".$rrandomid."
=========================
Title :  ".$rtitle."
Notes : \n\n".$rnotes."
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
            $replyMsg6 = "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================";
            $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
            }

?>