<?php

/**
 * Send different data through API Telegram
 */

class Send{
	
	function __construct(){}
	function __destruct(){}

	/**
	 * Sending message
	 * @param  string $link         link to API Telegram + token
	 * @param  int $chat_id      Unique identifier for the target chat or username of the target channel (in the format @channelusername)
	 * @param  string $text         some text to be sending
	 * @param  object $reply_markup [optional] Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
	 */
	function message($link, $chat_id, $text, $reply_markup){
		$parameter = array(
			'chat_id' => $chat_id, 
			'text' => $text,
			'reply_markup' => $reply_markup == null ? '' : json_encode($reply_markup)
			);

		$request_url = $link.'/sendMessage?'.http_build_query($parameter); 
		file_get_contents($request_url);
	}

	/**
	 * Sending photo
	 * @param  string $link    link to API Telegram + token
	 * @param  int $chat_id Unique identifier for the target chat or username of the target channel (in the format @channelusername)
	 * @param  string $caption [optional] Photo caption (may also be used when resending photos by file_id), 0-1024 characters
	 * @param  string $photo   URL of the photo to be send
	 */
	function photo($link, $chat_id, $caption, $photo){
		$parameter = array(
			'chat_id' => $chat_id, 
			'caption' => $caption,
			'photo' => $photo
		);
		$request_url = $link.'/sendPhoto?'.http_build_query($parameter);
		file_get_contents($request_url);
	}
}