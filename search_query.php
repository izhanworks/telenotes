<?php 
include('dbconnection.php');
include('user_auth.php');   
      
        if ($chatId == $teleid){  

			$mysearch = substr($message, 6);
	        
     // $ret=mysqli_query($con,"select * from tblnotes");
     //$mysearch = "imcrw";
$ret = mysqli_query($con, "SELECT * FROM tblnotes WHERE title LIKE '%$mysearch%' OR notes LIKE '%$mysearch%'");


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
        
        
        
     // imgnotes list
        
           // $ret=mysqli_query($con,"select * from tblimgn");
			$ret2 = mysqli_query($con, "SELECT * FROM tblimgn WHERE title LIKE '%$mysearch%' OR notes LIKE '%$mysearch%'");

            $cnt2=1;
            $resultdata2 = array();
			$row2=mysqli_num_rows($ret2);
			if($row2>0){
			while ($row2=mysqli_fetch_array($ret2)) {
			$title2 = $row2['title'];
			$notes2 = $row2['notes'];
			$randomid2 = $row2['randomid'];
			$id2 = $row2['id'];
			$cnt2=$cnt2+1;
			
			$resultdata2[] = array(
             'title2'    =>     $title2,
             'notes2'    =>     $notes2,
             'randomid2'    =>     $randomid2,
             'id2'    =>     $id2
			);
		}
		}
		
        $final_data2= json_encode($resultdata2, JSON_PRETTY_PRINT);  
        $dataresult2 =  json_decode($final_data2,true);
        usort($dataresult2,function($a,$b) {
        return strnatcasecmp($a['title2'],$b['title2']);
        });

		// pdf docs list
        
           	$ret3 = mysqli_query($con, "SELECT * FROM tblpdfdata WHERE title LIKE '%$mysearch%' OR notes LIKE '%$mysearch%'");

            $cnt3=1;
            $resultdata3 = array();
			$row3=mysqli_num_rows($ret3);
			if($row3>0){
			while ($row3=mysqli_fetch_array($ret3)) {
			$title3 = $row2['title'];
			$notes3 = $row2['notes'];
			$randomid3 = $row2['randomid'];
			$cnt3=$cnt3+1;
			
			$resultdata2[] = array(
             'title3'    =>     $title3,
             'notes3'    =>     $notes3,
             'randomid3'    =>     $randomid3
			);
		}
		}
		
        $final_data3= json_encode($resultdata3, JSON_PRETTY_PRINT);  
        $dataresult3 =  json_decode($final_data3,true);
        usort($dataresult3,function($a,$b) {
        return strnatcasecmp($a['title3'],$b['title3']);
        });
        
        
        
      $replyMsg8 = "
General Notes Result :
===================
". implode("\n", array_map(function ($entry) {return ($entry['title'])." : ".($entry['randomid']);}, $dataresult))."
===================
/snote <SID>\n
Image Notes Result :
===================
". implode("\n", array_map(function ($entry2) {return ($entry2['title2'])." : ".($entry2['randomid2']);}, $dataresult2))."
===================
/simgn <SID>\n
PDF Doc Result :
===================
". implode("\n", array_map(function ($entry3) {return ($entry3['title3'])." : ".($entry3['randomid3']);}, $dataresult3))."
===================
/spdf <SID>";
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