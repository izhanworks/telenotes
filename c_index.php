<?php

$update = json_decode(file_get_contents("php://input"), TRUE); 
$chatId = $update["message"]["chat"]["id"] ?? null ;
$userteleid = $update["message"]["from"]["id"] ?? null ;
$userName = $update["message"]["chat"]["first_name"] ?? null ;
$message = $update["message"]["text"] ?? null ; 
$token = "cloudbottoken"; 

$docfileid = $update["message"]["document"]["file_id"] ?? null ;
$docfileuniqueid = $update["message"]["document"]["file_unique_id"] ?? null ;
$docfilename = $update["message"]["document"]["file_name"] ?? null ;
$docfilesize = $update["message"]["document"]["file_size"] ?? null ;
$docmime = $update["message"]["document"]["mime_type"] ?? null ;
$videofileid = $update["message"]["video"]["file_id"] ?? null ;
$videofilename = $update["message"]["video"]["file_unique_id"] ?? null ;
$videofilename2 = $videofilename.".mp4";
$videofilesize = $update["message"]["video"]["file_size"] ?? null ;
$videomime = $update["message"]["video"]["mime_type"] ?? null ;


$imgfileid = null;
$imgfilesize = null;
$imgfileuniqueid = null;

if (!empty($update["message"]["photo"])) 
{
include('store_pics_query.php');
}

if ($docmime == "application/pdf")
{
include('stdocs_query.php');
}


if (!empty($update["message"]["document"])){
if (($docmime == "image/jpeg")||($docmime == "image/png"))
{
include('stdocpics_query.php');
}
}

if (($docmime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")||($docmime == "application/vnd.ms-excel"))
{
include('stdocs_query.php');
}

if (($docmime == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")||($docmime == "application/msword"))
{
include('stdocs_query.php');
}

if ($videomime == "video/mp4")
{
include('store_vid_query.php');
}

if(strpos($message, "/start") !== false) 
{  
include('c_start_query.php');
} 

if(strpos($message, "/luser") !== false) 
{  
include('c_luser_query.php');
} 

if(strpos($message, "/auser") !== false) 
{  
include('c_auser_query.php');
}

if(strpos($message, "/duser") !== false) 
{  
include('c_duser_query.php');
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

function sendErrorMessage($chatId, $message) {
    $parameters = array(
        "chat_id" => $chatId,
        "text" => $message,
        "parseMode" => "html"
    );
    send("sendMessage", $parameters);
}

?>