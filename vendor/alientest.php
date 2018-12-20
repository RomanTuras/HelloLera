<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/resource/strings.php';
require_once __DIR__ . '/resource/questionnaire.php';
require_once __DIR__ . '/dbhelper.php';
require_once __DIR__ . '/send.php';
require_once __DIR__ . '/constants.php';

/**
 * Main class of the AlienTest
 */
class AlienTest{
    private $dbhelper;
    private $send;
    private $questionnaire;

    public function __construct(){
        $this->dbhelper = new DbHelper();
        $this->send = new Send();
        $this->questionnaire = new Questionnaire();
    }

    /**
     * Initialized AlienTest: creating a table, adding chat_id and username, clearing score, let question = 1
     * @param $chat_id
     * @param $username
     */
    function initAlienTest($chat_id, $username){
        if(!$this->isTestStarted($chat_id)){
            $this->dbhelper->createAlienTable(); //creating table if not exists
            $this->dbhelper->insertChatId($chat_id); //inserting a new row with chat_id if not exists
            $this->dbhelper->updateAlien($chat_id, 0);
            $this->dbhelper->updateHuman($chat_id, 0);
            $this->dbhelper->updateQuestion($chat_id, 1);
            $this->dbhelper->updateUserName($chat_id, $username);
            $this->send->message(TG_LINK, $chat_id,WELCOME_MSG, null);
            $this->runTest($chat_id);
        }
    }

    /**
     * Main test
     * @param $chat_id
     */
    function runTest($chat_id){
        $question = $this->dbhelper->getQuestion($chat_id);
        $username = $this->dbhelper->getUserName($chat_id);
        $alien = $this->dbhelper->getAlien($chat_id);
        $human = $this->dbhelper->getHuman($chat_id);

        if($question < 25){
//            $msg = SO.$username;
//            $this->send->message(TG_LINK, $chat_id,$msg, null);
            $msg = $this->getCurrentQuestionPhrase($question);
            $this->send->message(TG_LINK, $chat_id,$msg, null);
            $yes_btn = array("text"=>"Да","callback_data"=>CONFIRM_NAME);
            $no_btn = array("text"=>"Нет","callback_data"=>NOT_CONFIRM_NAME);
            $inline_keyboard = [[$yes_btn, $no_btn]];
            $keyboard=array("keyboard"=>$inline_keyboard, "resize_keyboard"=>true);
            $msg = $this->questionnaire->getQuestion($question);
            $this->send->message(TG_LINK, $chat_id,$msg, $keyboard);
        }
    }

    function storeAnswer($chat_id, $answer, $human, $alien){

    }

    /**
     * Building current question phrase
     * @param $question
     * @return string
     */
    function getCurrentQuestionPhrase($question){
        return TASK.$question.FROM.'25:';
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

}