<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   

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
        $notes = substr($str,$cost2);
        $notes = trim($notes);
       // $notes = addslashes($notes)
        //$notes = str_ireplace("\'"," ",$notes);
        $titlea = substr($str,$cost1);
        $titlea = str_ireplace($notes,"",$titlea);
        $titlea = trim($titlea);
        $titlea = rtrim($titlea,"#2");
        $title = trim($titlea);
        $title = trim($title);
        $randomid = secure_random_string(3);
        $tid = time();
        
    	$query=mysqli_query($con, "insert into tblnotes(title, notes, randomid, id) value('$title','$notes', '$randomid', '$tid' )");
    	if ($query) {
    
    	$replyMsg7 = "Entry Added Successfully !!!\n=========================\nTitle : ".$title."\nSID : ".$randomid."\n=========================";
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
     
     
		$ret=mysqli_query($con,"select * from tblnotes");
			$cnt=1;
          	$resultdata = array();
			$row=mysqli_num_rows($ret);
			if($row>0){
			while ($row=mysqli_fetch_array($ret)) {
			$title = $row['title'];
			$notes = $row['notes'];
			$randomid = $row['randomid'];
			$id = $row['id'];
			$cnt=$cnt+1;
			
			$resultdata[] = array(
             'title'    =>     $title,
             'notes'    =>     $notes,
             'randomid'    =>     $randomid,
             'id'    =>     $id
			);
		}
		}
          
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['title'],$b['title']);
        });
        
       		$replyMsg8 = "My Notes List :\n===================\nTitle : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['title'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /lnote\n /dnote SID #y\n /anote #1 < title > #2 < notes >\n /enote #1 < title > #2 < notes > @@ SID\n /snote SID";
        
			$parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);
     
   ?>