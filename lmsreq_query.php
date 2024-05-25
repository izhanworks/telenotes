<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){
        	$titles = substr($message, 8);
	        $resultdata = array();
			$ret=mysqli_query($con,"select * from tblsreq WHERE MONTH(date)='$titles'");
			if ($ret){
			$cnt=1;
            		$num_rows = mysqli_num_rows($ret);
			if ($num_rows > 0) {
			while ($row=mysqli_fetch_array($ret)) {
			$date = $row['date'];
			$sereq = $row['sr'];
            		$location = $row['location'];
			$time = $row['time'];
			$remark = $row['remark'];  
			$randomid = $row['randomid'];
			$id = $row['id'];
			$cnt++;
			
			$resultdata[] = array(
             'date'    =>     $date,
             'sr'    =>     $sereq,
             'location'    =>     $location,
             'time'    =>     $time,
             'remark'    =>     $remark,
             'randomid'    =>     $randomid,
             'id'    =>     $id
			);
		}
		}
		}
          
        $final_data= json_encode($resultdata, JSON_PRETTY_PRINT);  
        $dataresult =  json_decode($final_data,true);
        usort($dataresult,function($a,$b) {
          return strnatcasecmp($a['date'],$b['date']);
        });
        
       		          $replyMsg8 = 
"My SR List : ".$titles."
===================\n"
.implode("\n", array_map(function ($entry) {return ($entry['date'])." : ".($entry['sr'])." : ".($entry['location'])." : ".($entry['time'])." : ".($entry['randomid']);}, $dataresult))."
===================
List command :
/lsreq
/dsreq SRID #y
/asreq #dt 2024-5-16 #sr 7413603226 #lc MBB MERLIMAU #tm 1005 1032 1200 #rm MNT 1000-1900
/ssreq < SR >";
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