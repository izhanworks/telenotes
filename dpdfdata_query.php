<?php
			include('dbconnection.php');
         	if (($chatId == 601383514)||($chatId == 700873795)||($chatId == 5323195702)){
        	$deltitle2 = substr($message, 6);
            $cost2 = (strpos($deltitle2,"#y"))+1;
			$deltitle3 = rtrim($deltitle2,"#y");
			$deltitle3 = trim($deltitle3);
			$dflag = substr($deltitle2,$cost2);
			$dflag = trim($dflag);
        	
            if ($dflag =="y"){
        	$sql=mysqli_query($con,"delete from tblpdfdata where randomid='$deltitle3'");
			
            $ret=mysqli_query($con,"select * from tblpdfdata");
			$cnt=1;
          	$resultdata = array();
			$row=mysqli_num_rows($ret);
			if($row>0){
			while ($row=mysqli_fetch_array($ret)) {
			$docfileid = $row['notes'];
			$docfilename = $row['title'];
			$randomid = $row['randomid'];
			$cnt=$cnt+1;
			
			$resultdata[] = array(
             'notes'    =>     $docfileid,
             'title'    =>     $docfilename,
             'randomid'    =>     $randomid
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
       		$replyMsg6 = "Pdf Deleted Successfully ! :\n=======================";
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
			
       		$replyMsg6 = "My Pdf List :\n===================\nPdf Title : SID\n===================\n". implode("\n", array_map(function ($entry) {return ($entry['title'])." : ".($entry['randomid']);}, $dataresult))."\n===================\nList command :\n /lpdf\n /dpdf SID #y\n /spdf SID";
        	
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
			
			
			