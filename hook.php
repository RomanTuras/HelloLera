<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/send.php';

$get_update = file_get_contents('php://input');
$response = json_decode($get_update, true);

if(isset($response["callback_query"])){
	$callback_query = $response["callback_query"];
	$data = $response["callback_query"]["data"];
	$chat_id = $callback_query['message']['chat']['id'];
	$text = 'response';
}elseif ($response['message']) {
	$chat_id = $response['message']['chat']['id'];
	$text = $response['message']['text'];
}else{
	echo "You don't mess with the Zohan!";
}

// $parameter = '';
// $send = new Send();

// if(strcmp($text, 'image') == 0){
// 	$photo = 'https://cloth.in.ua/bot/123.jpeg';
// 	$caption = 'Вот тебе image!';
// 	$send->photo(TG_LINK, $chatid, $caption, $photo);

// }elseif (strcmp($text, 'button') == 0) {
// 	$message = $text;
// 	$inline_button1 = array("text"=>"Да","callback_data"=>"1");
//     $inline_button2 = array("text"=>"Нет","callback_data"=>'0');
//     $inline_keyboard = [[$inline_button1, $inline_button2]];
//     $keyboard=array("keyboard"=>$inline_keyboard, "resize_keyboard"=>true);
// 	$send->message(TG_LINK, $chatid, $text, $keyboard);

// }elseif (strcmp($text, 'hide') == 0) {
//     $keyboard=array("remove_keyboard"=>true);
// 	$send->message(TG_LINK, $chatid, $text, $keyboard);

// }elseif (strcmp($text, 'response') == 0) {
// 	$send->message(TG_LINK, $chatid, 'resp = '.$data, null);

// }elseif (strcmp($text, 'myid') == 0) {
// 	$send->message(TG_LINK, $chatid, 'ChatId: '.$chatid, null);

// }else{
// 	$send->message(TG_LINK, $chatid, $text, null);
// }
