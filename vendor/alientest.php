<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/resource/strings.php';
require_once __DIR__ . '/dbhelper.php';
require_once __DIR__ . '/send.php';
require_once __DIR__ . '/constants.php';

/**
 * Main class of the AlienTest
 */
class AlienTest{
    private $dbhelper;

    public function __destruct(){
        $this->dbhelper = new DbHelper();
    }

    function initAlienTest($chat_id){
        if(!$this->isTestStarted($chat_id)){
            $this->dbhelper->createAlienTable(); //creating table if not exists
            $this->dbhelper->insertChatId($chat_id); //inserting a new row with chat_id if not exists
            $username = $this->dbhelper->getUserName($chat_id);
            if($username == null) $this->sendWelcomeNoName($chat_id);
            else $this->sendWelcomeConfirmName($chat_id, $username);
        }
    }

    /**
     * Checking, is alien test started or not
     * @param $chat_id
     * @return bool
     */
    function isTestStarted($chat_id){
        $question = $this->dbhelper->getQuestion($chat_id);
        if($question == 0 or $question == -1) return false;
        else return true;
    }

    /**
     * Sending welcome message at beginning test, if user have no name
     * @param $chat_id
     */
    function sendWelcomeNoName($chat_id){
        $send = new Send();
        $send->message(TG_LINK, $chat_id,WELCOME_MSG, null);
        $send->message(TG_LINK, $chat_id,INPUT_YOUR_NAME, null);
    }

    function sendWelcomeConfirmName($chat_id, $username){
        $send = new Send();
        $send->message(TG_LINK, $chat_id,WELCOME_MSG, null);
        $yes_btn = array("text"=>"Да","callback_data"=>CONFIRM_NAME);
        $no_btn = array("text"=>"Нет","callback_data"=>NOT_CONFIRM_NAME);
        $inline_keyboard = [[$yes_btn, $no_btn]];
        $keyboard=array("keyboard"=>$inline_keyboard, "resize_keyboard"=>true);
        $msg = ARE_YOUR_NAME.$username.'?';
        $send->message(TG_LINK, $chat_id,$msg, $keyboard);
    }

    function beginTest(){

    }
}