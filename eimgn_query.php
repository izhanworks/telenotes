<?php      

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){   

	      $value = substr($message, 7);
				$str = $value;
			
        $cost3 = (strpos($str,"@@"))+2;
        $cost1 = (strpos($str,"#1"))+3;
        $cost2 = (strpos($str,"#2"))+3;
        $notes = substr($str,$cost2);
        $notes = trim($notes);
        $titlea = substr($str,$cost1);
        $titlea = str_ireplace($notes,"",$titlea);
        $titlea = trim($titlea);
        $titlea = rtrim($titlea,"#2");
        $title = trim($titlea);
        $title = trim($title);
		 		$dflag = substr($str,$cost3);
				$dflag = trim($dflag);
        $notes = str_ireplace($dflag,"",$notes);
        $notes = str_ireplace("@@","",$notes);
        $notes = trim($notes);
              
            if (!empty($dflag)) {
        		$query=mysqli_query($con, "update tblimgn set title='$title',notes='$notes' where randomid='$dflag'");
			
            $ret=mysqli_query($con,"select * from tblimgn");
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
     

			}
			
              else {
              $replyMsg6 = "Invalid !!!\n=========================\nPlease use correct delete command !!!\n=========================";
              $parameters6 = array(
        	  "chat_id" => $chatId,
        	  "text" => $replyMsg6,
        	  "parseMode" => "html"
    		  );
    		 send("sendMessage", $parameters6);
              }

       		if ($value == NULL){
       		$replyMsg6 = "Invalid! Please select title!\n=======================";
       		$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
       		exit;
           	}
       		else{
       		if (!empty($dflag)) {  
			
			$retx=mysqli_query($con,"select * from tblimgn where randomid ='$dflag'");
		
		$cntx=1;
		while ($row=mysqli_fetch_array($retx)) {
		$randomidx = $row['randomid'];
		$cntx=$cntx+1;
		}
			
			if ($randomidx===NULL){
	$replyMsg9 = "Invalid !!! SID = ".$dflag."\n=========================\nSID not exist in the database !!!\n=========================";
              $parameters9 = array(
        	  "chat_id" => $chatId,
        	  "text" => $replyMsg9,
        	  "parseMode" => "html"
    		  );
    		 send("sendMessage", $parameters9);
	}
	else{
	$replyMsg6 ="Note Edit Successfully ! :\n=======================";
            
	}
       		
 }
              else {
              $replyMsg6 = "Incorrect Command Format ! :\n=======================";
              }
       		$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
       		}
			
       		$replyMsg6 = "My Notes List :\n===================\nTitle : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['title'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /limgn\n /dimgn SID #y\n /aimgn #1 < title > #2 < img link >\n /eimgn #1 < title > #2 < img link > @@ SID\n /simgn SID";
        	
			$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
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
			
			
			
			