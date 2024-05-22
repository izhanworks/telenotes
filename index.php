<?php

$update = json_decode(file_get_contents("php://input"), TRUE); 
$chatId = $update["message"]["chat"]["id"]; 
$userteleid = $update["message"]["from"]["id"];
$userName = $update["message"]["chat"]["first_name"]; 
$message = $update["message"]["text"]; 
$message_id =  $update["message"]["message_id"]; 
$token = "6898763873:AAG13uJDPfynJfBKsiM2oYZ9VAtiHnoYgMk";
$tokenold = "6336372203:AAFrkzSNZ_eHUjfhaoz2Mi3jOVpgSEoSBoI"; 
$docfileid = $update["message"]["document"]["file_id"];
$docfileuniqueid = $update["message"]["document"]["file_unique_id"];
$docfilename = $update["message"]["document"]["file_name"];
$docfilesize = $update["message"]["document"]["file_size"];
$docmime = $update["message"]["document"]["mime_type"];
$videofileid = $update["message"]["video"]["file_id"];
$videofilename = $update["message"]["video"]["file_unique_id"];
$videofilename2 = $videofilename.".mp4";
$videofilesize = $update["message"]["video"]["file_size"];
$videomime = $update["message"]["video"]["mime_type"];
$picscaption = $update["message"]["caption"];

$imgfileid = null;
$imgfilesize = null;

foreach ($update["message"]["photo"] as $photo)
{
	$imgfileid = $photo["file_id"];
	$imgfilesize = $photo["file_size"];
}

$botAPI = "https://api.telegram.org/bot" . $token;
		if (isset($update['callback_query'])) { 
		// Reply with callback_query data 
		$data = http_build_query(
		[ 'text' => $update['callback_query']['data'], 
		'chat_id' => $update['callback_query']['from']['id'] ]); 
		file_get_contents($botAPI . "/sendMessage?{$data}");
		
		 }


if(strpos($message, "/start") !== false) 
{  
include('start_query.php');
//$totalmsg = 2;
//include('del_msg.php');
} 

if(strpos($message, "/lpdf") !== false) 
{  
//include('lpdf_query.php');
include('lpdfdata_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/apdf") !== false) 
{  
//include('lpdf_query.php');
include('apdfdata_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/find") !== false) 
{  
include('search_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/dpdf") !== false) 
{  
//include('dpdf_query.php');
include('dpdfdata_query.php');
$totalmsg = 3;
include('del_msg.php');

} 

if(strpos($message, "/epdf") !== false) 
{  
include('epdfdata_query.php');
$totalmsg = 3;
include('del_msg.php');

} 

if(strpos($message, "/spdf") !== false) 
{  
//include('spdf_query.php');
include('searchpdf_query.php');
} 

if(strpos($message, "/lnote") !== false) 
{  
include('lnote_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/anote") !== false) 
{  
include('anote_query.php');
} 

if(strpos($message, "/dnote") !== false) 
{  
include('dnote_query.php');
} 

if(strpos($message, "/enote") !== false) 
{  
include('enote_query.php');
} 

if(strpos($message, "/snote") !== false) 
{  
include('snote_query.php');
} 

if(strpos($message, "/limgn") !== false) 
{  
include('limgn_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/aimgn") !== false) 
{  
include('aimgn_query.php');
} 

if(strpos($message, "/dimgn") !== false) 
{  
include('dimgn_query.php');
} 

if(strpos($message, "/eimgn") !== false) 
{  
include('eimgn_query.php');
} 

if(strpos($message, "/simgn") !== false) 
{  
include('simgn_query.php');
} 

if(strpos($message, "/luser") !== false) 
{  
include('luser_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/auser") !== false) 
{  
include('auser_query.php');
} 

if(strpos($message, "/duser") !== false) 
{  
include('duser_query.php');
} 

if(strpos($message, "/lsreq") !== false) 
{  
include('lsreq_query.php');
} 

if(strpos($message, "/asreq") !== false) 
{  
include('asreq_query.php');
} 

if(strpos($message, "/dsreq") !== false) 
{  
include('dsreq_query.php');
} 

if(strpos($message, "/ssreq") !== false) 
{  
include('ssreq_query.php');
} 

if(strpos($message, "/avidn") !== false) 
{  
include('avidn_query.php');
} 

if(strpos($message, "/svidn") !== false) 
{  
include('svidn_query.php');
} 

if(strpos($message, "/lvidn") !== false) 
{  
include('lvidn_query.php');
$totalmsg = 2;
include('del_msg.php');
} 

if(strpos($message, "/dvidn") !== false) 
{  
include('dvidn_query.php');
} 

if(strpos($message, "/id") !== false) 
{  
include('id_query.php');
$totalmsg = 3;   
include('del_msg.php');
} 

if(strpos($message, "/testvid") !== false) 
{  
include('sendvid.php');
} 

if(strpos($message, "/spics") !== false) 
{  
include('spics_query.php');
} 

if(strpos($message, "/sikpdf") !== false) 
{  
include('sikpdf_query.php');
} 

if(strpos($message, "/crc32") !== false) 
{  
include('crc32_query.php');
} 

if(strpos($message, "/wsolat") !== false) 
{  
  $location = substr($message, 8);
  $location = trim($location);
  $location = str_replace(" ","%20", $location);
  $location = trim($location);
  include('wsolat_query.php');
  $totalmsg = 2;
  include('del_msg.php');
} 

if(strpos($message, "/testdel") !== false) 
{  
	
$replyMsg6 = "
=========================
message id = ".$message_id."
message id2 = ".$message_id2."
chat id = ".$chatId."
=========================";
    $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
        $totalmsg = 2;   
		include('del_msg.php');
     

} 

function send($method, $data){
    global $token;
    $url = "https://api.telegram.org/bot$token/$method";

    if(!$curld = curl_init()){
        exit;
    }
    curl_setopt($curld, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    return $output;
}

function secure_random_string($length) {
    $random_string = '';
    for($i = 0; $i < $length; $i++) {
        $number = random_int(0, 36);
        $character = base_convert($number, 10, 36);
        $random_string .= $character;
    }
    return $random_string;
}



?>