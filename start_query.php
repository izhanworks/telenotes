<?php



if ($userteleid == "700873795"){
$replyMsg6 = "
List of Command !!!
=========================
/start
/lnote
/snote <SID>
/dnote <SID> #y
/anote #1 <title> #2 <notes>
/enote #1 <title> #2 <notes> @@ <SID>

/limgn
/simgn  <SID>
/dimgn <SID> #y
/aimgn  #1 <title> #2 <img link>
/eimgn #1 <title> #2 <img link> @@ <SID>
	
/lvidn
/svidn <SID>
/dvidn <SID> #y
/avidn #1 <file_name> #2 <file_id>

/lpdf
/spdf <SID>
	
/wsolat <location>
/crc32 <string>
/id
=========================";
   $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);
		
$data = http_build_query([
            "text" => "Created by MY908A80",
            "chat_id" => $update['message']['from']['id']
        ]);		

$keyboard = json_encode([
            "inline_keyboard" => [
                [
                    [
                        "text" => "• Contact Me •",
                        "url" => "t.me/iknerdmy"
                    ],
                    [
                        "text" => "General notes",
                        "url" => "t.me/ncrworkbot"
                    ]
                ]
            ]
        ]);

file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}"); 
		
		
		

}
else {
$replyMsg6 = "
List of Command !!!
=========================
/start
/lnote
/snote <SID>

/limgn
/simgn  <SID>
	
/lvidn
/svidn <SID>

/lpdf
/spdf <SID>
	
/wsolat <location>
/crc32 <string>
/id
=========================";
   $parameters6 = array(
        	"chat_id" => $chatId,
        	"text" => $replyMsg6,
        	"parseMode" => "html"
    		);
    		send("sendMessage", $parameters6);

}

         
		

		

/*		
		
$keyboard = array(
"inline_keyboard" => array(array(array(
"text" => "list note",
"callback_data" => "english",
"url" => "http://www.google.com"
)))
);
		
		       $parameters8 = array(
        	"chat_id" => $chatId,
        	"text" => $data,
        	"parseMode" => "markdown",
	        "reply_markup" => $keyboard
    		);
    		send("sendMessage", $parameters8);
		*/

		
		
		


?>