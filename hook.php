<?php

require_once __DIR__ . '/vendor/handle.php';
require_once __DIR__ . '/vendor/send.php';

$get_update = file_get_contents('php://input');
$response = json_decode($get_update, true);
if(!$response) exit;

//$chat_id = $response['message']['chat']['id'];
//$text = $response['message']['text'];
//$data = $response['callback_query']['data'];
//$send = new Send();
//$send->message(TG_LINK, $chat_id, $get_update, null);

if(isset($response["callback_query"])){
    $handle = new Handle();
    $handle->callback($response);
}elseif(isset($response['message'])) {
    $handle = new Handle();
    $handle->message($response);
}else{
	echo "You don't mess with the Zohan!";
}
