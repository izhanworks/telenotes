<?php 
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){  
	        
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
        
      
$replyMsg8 = "
Video Notes List :
===================
Title : SID
===================
". implode("\n", array_map(function ($entry) {return ($entry['file_name'])." : ".($entry['randomid']);}, $dataresult))."
===================
List command :
/lvidn
/svidn <SID>
/dvidn <SID> #y
/avidn #1 <file_name> #2 <file_id>";
      $parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg8,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters8);
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