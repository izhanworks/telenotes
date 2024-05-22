<?php
			include('dbconnection.php');
         	if (($chatId == 601383514)||($chatId == 700873795)||($chatId == -926780390)||($chatId == -824680592)||($chatId == 5323195702)){
        	$deltitle2 = substr($message, 7);
            $cost2 = (strpos($deltitle2,"#y"))+1;
			$deltitle3 = rtrim($deltitle2,"#y");
			$deltitle3 = trim($deltitle3);
			$dflag = substr($deltitle2,$cost2);
			$dflag = trim($dflag);
        	
            if ($dflag =="y"){
        	$sql=mysqli_query($con,"delete from tblntvid where randomid='$deltitle3'");
			
            $ret=mysqli_query($con,"select * from tblntvid");
			$cnt=1;
          	$resultdata = array();
			$row=mysqli_num_rows($ret);
			if($row>0){
			while ($row=mysqli_fetch_array($ret)) {
			$file_name = $row['file_name'];
			$file_id = $row['file_id'];
			$randomid = $row['randomid'];
			$cnt=$cnt+1;
			
			$resultdata[] = array(
             'file_name'    =>     $file_name,
             'file_id'    =>     $file_id,
             'randomid'    =>     $randomid
			);
		}
		}
          
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['file_name'],$b['file_name']);
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

       		if ($deltitle2 == NULL){
       		$replyMsg6 = "Invalid! Please select SID!\n=======================";
       		$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
       		exit;
           	}
       		else{
       		if ($dflag =="y"){  
       		$replyMsg6 = "Video Deleted Successfully ! :\n=======================";
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
			
       		$replyMsg6 = "My Video Notes :\n===================\nTitle : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['file_name'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /lvidn\n /dvidn SID #y\n /avidn #1 < file_name > #2 < file_id >\n /snote SID";
        	
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
			
			
			