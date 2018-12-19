<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/alientest.php';
require_once __DIR__ . '/send.php';
require_once __DIR__ . '/resource/strings.php';

class Handle{

    public function __construct() {}
    public function __destruct() {}

    /**
     * Handling a message
     * @param array $response object represents a message from Telegram
     */
    function message(array $response){
        $alien_test = new AlienTest();
        $chat_id = $response['message']['chat']['id'];
        $text = $response['message']['text'];
        switch ($text){
            case "/alientest":
                $alien_test->initAlienTest($chat_id);
                break;
            default:
//                $send = new Send();
//                $send->message(TG_LINK, $chat_id, WELCOME_MSG, null);
        }
    }

    /**
     * Handling a callback
     * @param array $response object represents a message from Telegram
     */
    function callback(array $response){
        $callback_query = $response["callback_query"];
        $data = $response["callback_query"]["data"];
        $chat_id = $callback_query['message']['chat']['id'];
        $text = 'response';
    }

}