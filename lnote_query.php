<?php 
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){  
	        
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
        
      $replyMsg8 = "
General Notes List :
===================
Title : SID
===================
". implode("\n", array_map(function ($entry) {return ($entry['title'])." : ".($entry['randomid']);}, $dataresult))."
===================
List command :
/lnote
/snote <SID>
/dnote <SID> #y
/anote #1 <title> #2 <notes>
/enote #1 <title> #2 <notes> @@ <SID>";
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