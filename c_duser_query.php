<?php
			include('dbconnection.php');
            if (($chatId == 601383514)||($chatId == 700873795)||($chatId == 5323195702)){
        	$deltitle2 = substr($message, 7);
            $cost2 = (strpos($deltitle2,"#y"))+1;
			$deltitle3 = rtrim($deltitle2,"#y");
			$deltitle3 = trim($deltitle3);
			$dflag = substr($deltitle2,$cost2);
			$dflag = trim($dflag);
        	
            if ($dflag =="y"){
        	$sql=mysqli_query($con,"delete from tbluser where randomid='$deltitle3'");
			
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
             
			}
			
              else {
              $replyMsg6 = "
Invalid !!!
=========================
Please use correct delete command !!!
=========================";
              $parameters6 = array(
        	  "chat_id" => $chatId,
        	  "text" => $replyMsg6,
        	  "parseMode" => "html"
    		  );
    		 send("sendMessage", $parameters6);
              }

       		if ($deltitle2 == NULL){
       		$replyMsg6 = "
=======================
Invalid! Please select SID!
=======================";
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
       		$replyMsg6 = "
=======================
Note Deleted Successfully ! :
=======================";
             }
              else {
              $replyMsg6 = "
=======================
Incorrect Command Format ! :
=======================";
              }
       		$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
       		}
			
       		$replyMsg6 = "
My User List :
===================
User Name : Telegram ID : SID
===================
". implode("\n", array_map(function ($entry) {return ($entry['tele_name'])." : ".($entry['tele_user'])." : ".($entry['randomid']);}, $dataresult))."
===================
List command :
/luser
/duser SID #y
/auser #1 < user id > #2 < user name > ";
        	
			$parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
			}
         	else {
            $replyMsg6 = "
Unauthorized !!!
=========================
You are not allowed to use this command !!!
=========================";
            $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
			}
			
?>	