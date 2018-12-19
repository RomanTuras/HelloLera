<?php

//require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/handle.php';

$get_update = file_get_contents('php://input');
$response = json_decode($get_update, true);

if(isset($response["callback_query"])){
    $handle = new Handle();
    $handle->callback($response);
}elseif(isset($response['message'])) {
    $handle = new Handle();
    $handle->message($response);
}else{
	echo "You don't mess with the Zohan!";
}


// $parameter = '';
// $send = new Send();
//
// if(strcmp($text, 'image') == 0){
// 	$photo = 'https://cloth.in.ua/bot/123.jpeg';
// 	$caption = 'Вот тебе image!';
// 	$send->photo(TG_LINK, $chat_id, $caption, $photo);
//
// }elseif (strcmp($text, 'button') == 0) {
// 	$message = $text;
// 	$inline_button1 = array("text"=>"Да","callback_data"=>"1");
//     $inline_button2 = array("text"=>"Нет","callback_data"=>'0');
//     $inline_keyboard = [[$inline_button1, $inline_button2]];
//     $keyboard=array("keyboard"=>$inline_keyboard, "resize_keyboard"=>true);
// 	$send->message(TG_LINK, $chat_id, $text, $keyboard);
//
// }elseif (strcmp($text, 'hide') == 0) {
//     $keyboard=array("remove_keyboard"=>true);
// 	$send->message(TG_LINK, $chat_id, $text, $keyboard);
//
// }elseif (strcmp($text, 'response') == 0) {
//// 	$send->message(TG_LINK, $chat_id, 'resp = '.$data, null);
//
// }elseif (strcmp($text, 'myid') == 0) {
// 	$send->message(TG_LINK, $chat_id, 'ChatId: '.$chat_id, null);
//
// }else{
// 	$send->message(TG_LINK, $chat_id, $text, null);
// }
