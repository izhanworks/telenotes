<?php



/*
			$message_id2 = ($message_id+1);
		   $url = 'https://api.telegram.org/bot'.$token.'/deleteMessage?chat_id='.$chatId.'&message_id='.$message_id; 
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
  curl_setopt($ch, CURLOPT_USERAGENT, 'IKnotesMy/1.0 (http://www.mysite.com/)'); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json")); 
  $result = curl_exec($ch); 
  $datadelete = json_decode($result, TRUE); 
	
  $url2 = 'https://api.telegram.org/bot'.$token.'/deleteMessage?chat_id='.$chatId.'&message_id='.$message_id2; 
  $ch2 = curl_init(); 
  curl_setopt($ch2, CURLOPT_URL, $url2); 
  curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE); 
  curl_setopt($ch2, CURLOPT_USERAGENT, 'IKnotesMy/1.0 (http://www.mysite.com/)'); 
  curl_setopt($ch2, CURLOPT_HTTPHEADER, array("Accept: application/json")); 
  $result2 = curl_exec($ch2); 
  $datadelete2 = json_decode($result2, TRUE);
  
*/



sleep(10);
for ($i = 0; $i < $totalmsg; $i++) {
    $currentMessageId = $message_id + $i;
    
    $url = 'https://api.telegram.org/bot'.$token.'/deleteMessage?chat_id='.$chatId.'&message_id='.$currentMessageId; 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    curl_setopt($ch, CURLOPT_USERAGENT, 'IKnotesMy/1.0 (http://www.mysite.com/)'); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json")); 
    $result = curl_exec($ch); 
   // $datadelete = json_decode($result, TRUE);
    
    // You can use $datadelete for further processing if needed.
}




  ?>