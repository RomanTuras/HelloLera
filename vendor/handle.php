<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/alientest.php';
require_once __DIR__ . '/send.php';
require_once __DIR__ . '/resource/strings.php';

/**
 * Class Handle
 * handling incoming messages
 */
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
        $command = $response['message']['entities'][0]['type'];

        if(isset($command) and $command = 'bot_command'){ //processing a bot commands here
            switch (strtolower($text)) {
                case "/alientest":
                    $username = $response['message']['from']['first_name'] . ' ' . $response['message']['from']['last_name'];
                    $this->alienTest->initAlienTest($chat_id, $username);
                    break;
                case "/help":
                    $send = new Send();
                    $send->message(TG_LINK, $chat_id, HELP, null);
                    break;
            }
        }else{ //processing text
            switch ($text){
                case "Да":
                    if($this->alienTest->isTestStarted($chat_id)){
                        $this->alienTest->storeAnswer($chat_id, YES);
                    }
                    break;
                case "Нет":
                    if($this->alienTest->isTestStarted($chat_id)){
                        $this->alienTest->storeAnswer($chat_id, NO);
                    }
                    break;
                default:
//                    $send = new Send();
//                    $yes_btn = array("text"=>"Yes");
//                    $no_btn = array("text"=>"No");
//                    $inline_keyboard = [[$yes_btn, $no_btn]];
//                    $keyboard=array("remove_keyboard"=>true);
//                    $send->message(TG_LINK, $chat_id, $command, null);
            }
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
    }
}