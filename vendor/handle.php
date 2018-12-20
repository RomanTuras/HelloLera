<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/alientest.php';
require_once __DIR__ . '/send.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/resource/strings.php';

class Handle{
    private $alienTest;

    public function __construct() {
        $this->alienTest = new AlienTest();
    }
    public function __destruct() {}

    /**
     * Handling a message
     * @param array $response object represents a message from Telegram
     */
    function message($response){

        $chat_id = $response['message']['chat']['id'];
        $text = $response['message']['text'];

        switch ($text){
            case "/alientest":
                $username = $response['message']['from']['first_name'].' '.$response['message']['from']['last_name'];
                $this->alienTest->initAlienTest($chat_id, $username);
                break;
            default:
//                $send = new Send();
//                $send->message(TG_LINK, $chat_id, $text, null);
        }
    }

    /**
     * Handling a callback
     * @param array $response object represents a message from Telegram
     */
    function callback($response){
        $callback_query = $response["callback_query"];
        $data = $response["callback_query"]["data"];
        $chat_id = $callback_query['message']['chat']['id'];
//        $send = new Send();
//        $send->message(TG_LINK, $chat_id, $chat_id, null);
//        switch ($data){
//            case CONFIRM_NAME:
//                $this->alienTest->runTest($chat_id);
//                break;
//            case NOT_CONFIRM_NAME:
//                $this->alienTest->inputUsername($chat_id);
//                break;
//        }

    }

}