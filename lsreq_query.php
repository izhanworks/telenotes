<?php

include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){
	     $resultdata = array();
			$ret=mysqli_query($con,"select * from tblsreq WHERE MONTH(date)=MONTH(CURRENT_DATE)");
			if ($ret){
			$cnt=1;
                $num_rows = mysqli_num_rows($ret);
			//$row=mysqli_num_rows($ret);
			
			//if($row>0){
				if ($num_rows > 0) {
			while ($row=mysqli_fetch_array($ret)) {
			$date = $row['date'];
			$sereq = $row['sr'];
               $location = $row['location'];
			$time = $row['time'];
			$remark = $row['remark'];  
			$randomid = $row['randomid'];
			$id = $row['id'];
			//$cnt=$cnt+1;
			$cnt++;
			
			$resultdata[] = array(
             'date'    =>     $date,
             'sr'    =>     $sereq,
             'location'    =>     $location,
             'time'    =>     $time,
             'remark'    =>     $remark,
             'randomid'    =>     $randomid,
             'id'    =>     $tid
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
"My SR List : ".date("F Y")."
===================\n"
.implode("\n\n", array_map(function ($entry) {return ($entry['date'])." : ".($entry['sr'])." : ".($entry['time'])." :\n".($entry['location'])." : \n".($entry['remark'])." : ".($entry['randomid']);}, $dataresult))."
===================
List command :
/lsreq
/dsreq SRID #y
/asreq #dt 2023-6-15 #sr 7543322111 #lc MBB Malim Jaya #tm 1014 1100 1205 #rm 1000-1900
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