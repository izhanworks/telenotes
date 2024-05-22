<?php

include('dbconnection.php');
include('user_auth.php');   
$tokencloud = "6439847185:AAErsA0bboHOganGXSZBqn2iXTbG656E6SE";      
        if ($chatId == $teleid){   

   	$titles = substr($message, 6);
          
    $ret=mysqli_query($con,"select * from tblpdfdata where randomid ='$titles'");
		
		$cnt=1;
		while ($row=mysqli_fetch_array($ret)) {
		$docfileid = $row['notes'];
		$docfilename = $row['title'];
		$randomid = $row['randomid'];
		$cnt=$cnt+1;
		}
		
		$resultdata = array(
             'file_id'    =>     $docfileid,
             'file_name'    =>     $docfilename,
             'randomid'    =>     $randomid
        );

        $final_data = json_encode($resultdata, JSON_PRETTY_PRINT);
        $dataresult =  json_decode($final_data,true);


        $rdocfileid = $dataresult['file_id'];
        $rdocfilename = $dataresult['file_name'];
         $rrandomid = $dataresult['randomid'];
        
      

$getfilepath = json_decode(file_get_contents("https://api.telegram.org/bot".$tokencloud."/getfile?file_id=".$docfileid),true);
$getfilepath2 = $getfilepath["result"]["file_path"];
$resultflag = $getfilepath["ok"];
$downlink2 = "https://api.telegram.org/file/bot".$tokencloud."/".$getfilepath2;
file_put_contents($docfilename, file_get_contents($downlink2));  

			if ($rdocfilename === NULL){
            $replyMsg7 = "My Pdf Entry :\n===================\nSorry, No Result Found!\n===================";
        }
        else{
        	              
$replyMsg7 = "
My Pdf File :  ".$rrandomid."
===================
File Name :  ".$rdocfilename."
===================";
/*
$replyMsg7 = "
My Pdf Entry :  ".$rrandomid."
===================
File Name :  ".$rdocfilename."
File Size : ".$rdocfilesize."
File ID :  ".$rdocfileid."
Unique ID : ".$rdocfileuniqueid."
===================";
*/
            }
            $parameters7 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg7,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters7);
            
             	$parameters2 = array(
           	"chat_id" => $chatId,
           	"document" => new CURLFile(realpath($docfilename)), 
         //  	"document" => $rdocfileid,
			   "parseMode" => "html"
           	);
           	send("sendDocument", $parameters2);
           	unlink($docfilename);
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