<?php
/**
 * Main entry point for webhook
 */

require_once __DIR__ . '/vendor/handle.php';
require_once __DIR__ . '/vendor/send.php';

$get_update = file_get_contents('php://input');
$response = json_decode($get_update, true);
if(!$response) exit;

if(isset($response["callback_query"])){
    $handle = new Handle();
    $handle->callback($response);
}elseif(isset($response['message'])) {
    $handle = new Handle();
    $handle->message($response);
}else{
	echo "You don't mess with the Zohan!";
}
