<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){      
  
      $ret=mysqli_query($con,"select * from tbluser");
			$cnt=1;
      $resultdata = array();
			$row=mysqli_num_rows($ret);
			if($row>0){
			while ($row=mysqli_fetch_array($ret)) {
			$teleid = $row['tele_user'];
			$telename = $row['tele_name'];
			$randomid = $row['randomid'];
			$cnt=$cnt+1;
			
			$resultdata[] = array(
            'tele_user'    =>     $teleid,
             'tele_name'    =>     $telename,
             'randomid'    =>     $randomid 
			);
		}
		}
//SORT TELEGRAM ID BY USERNAME  
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['tele_name'],$b['tele_name']);
        });
        
       		$replyMsg8 = "My User List :\n===================\nTelegram ID : User Name : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['tele_name'])." : ".($entry['tele_user'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /luser\n /duser SID #y\n /auser #1 tele-id #2 user-name";
        
			$parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);
//SORT TELEGRAM ID BY USERNAME     
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