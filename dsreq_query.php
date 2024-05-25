<?php

include('dbconnection.php');
include('user_auth.php');   
     
        if ($chatId == $teleid){

			$deltitle2 = substr($message, 7);
			$cost2 = (strpos($deltitle2,"#y"))+1;
			$deltitle3 = rtrim($deltitle2,"#y");
			$deltitle3 = trim($deltitle3);
			$dflag = substr($deltitle2,$cost2);
			$dflag = trim($dflag);
			
             if (!empty($deltitle2)) {
            sendErrorMessage($chatId, "Invalid! Please insert SeqID to delete entry!\n=======================");
            exit;
        }      
          if ($dflag =="y"){
      $sql=mysqli_query($con,"delete from tblsreq where randomid='$deltitle3'");
			
      $ret=mysqli_query($con,"select * from tblsreq");
      $resultdata = array();

			while ($row=mysqli_fetch_array($ret)) {
			$resultdata[] = array(
                    'date'     => $row['date'],
                    'sr'       => $row['sr'],
                    'location' => $row['location'],
                    'time'     => $row['time'],
                    'remark'   => $row['remark'],
                    'randomid' => $row['randomid'],
                    'id'       => $row['id']
                );
					
		}
	
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['date'],$b['date']);
        });
             $replyMsg6 = "SR Entry Deleted Successfully ! :\n=======================";
		$parameters6 = array(
            "chat_id" => $chatId,
            "text" => $replyMsg6,
            "parseMode" => "html"
        );
        send("sendMessage", $parameters6);
   
			 }
              else {
              sendErrorMessage($chatId, "Incorrect Command Format ! :\n=======================");
			exit;
              }
        $replyMsg8 = 
"My SR List :
===================\n"
.implode("\n", array_map(function ($entry) {
    return ($entry['date'])." : ".($entry['sr'])." : ".($entry['location'])." : ".($entry['time'])." : ".($entry['randomid']);
}, $dataresult))."
===================
List command :
/lsreq
/dsreq SRID #y
/asreq #dt 2023-6-15 #sr 7543322111 #lc MBB Malim Jaya #tm 1014 1100 1205 #rm 2nd job
/ssreq < title >";
        
        $parameters8 = array(
            "chat_id" => $chatId,
            "text" => $replyMsg8,
            "parseMode" => "html"
        );
        send("sendMessage", $parameters8);

       		}
            else {
        sendErrorMessage($chatId, "Unauthorized !!!\n=========================\nYou are not allowed to use this command !!!\n=========================");
}
		
?>		
		
		
		
		
		
		
		