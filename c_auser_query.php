<?php
include('dbconnection.php');
if (($chatId == 601383514)||($chatId == 5323195702)||($chatId == 700873795)){
        $value = substr($message, 7);
        if ($value == NULL){
            $replyMsg6 = "Invalid !!!\n=========================\n Data cannot be empty !!!\n=========================";
            $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
            exit;
        }
        else{
           
        $str = $value;
        $cost1 = (strpos($str,"#1"))+3;
        $cost2 = (strpos($str,"#2"))+3;
        $telename = substr($str,$cost2);
        $telename = trim($telename);
        $titlea = substr($str,$cost1);
        $titlea = str_ireplace($telename,"",$titlea);
        $titlea = trim($titlea);
        $titlea = rtrim($titlea,"#2");
        $teleid = trim($titlea);
		$teleid = trim($teleid);
		$randomid = secure_random_string(3);
  
        $query=mysqli_query($con, "insert into tbluser(tele_user, tele_name, randomid) value('$teleid','$telename', '$randomid' )");
		
		
  if ($query) {
    
    	$replyMsg7 = "Entry Added Successfully !!!\n=========================\nTelegram ID : ".$teleid."\nUser Name : ".$telename."\n=========================";
  		}
  		else
    	{
        $replyMsg7 = "Sorry Invalid !!!\n=========================\nSomething Went Wrong. Please try again\n========================="; 
    	}

        }	
        }
        else {
            $replyMsg7 = "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================";
        }

        $parameters7 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg7,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters7);
			
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
          
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['tele_name'],$b['tele_name']);
        });
        
       		$replyMsg8 = "My User List :\n===================\nTelegram ID : User Name : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['tele_name'])." : ".($entry['tele_user'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /luser\n /duser SID #y\n /auser #1 tele-id #2 user-name\n /suser SID";
        
			$parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);




?>