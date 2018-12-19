<?php
/**
 * Main class of the AlienTest
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/resource/strings.php';
require_once __DIR__ . '/dbhelper.php';
require_once __DIR__ . '/send.php';

class AlienTest{

    /**
     * Checking, is alien test started or not
     * @param $chat_id
     * @return bool
     */
    function isTestStarted($chat_id){
        $dbhelper = new DbHelper();
        $con = $dbhelper->connect();
        if ($result = $con->query("SHOW TABLES LIKE 'alien_table'")) {
            if($result->num_rows == 1) { //if table 'alien_table' exists
                $sql = "SELECT question FROM alien_table WHERE chat_id=".$chat_id;
                $result = $con->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row["question"] == 0) return false; //Test not started, question = 0
                        else return true; //Test started
                    }
                } else {
                    return false; //Test not started, required chat_id not found
                }
            }
        } else {
            return false; //Test not started, table is not exists
        }
    }

    /**
     * Creating 'alien_table' in mysql database, if not exists
     */
    function prepareTest(){
        $dbhelper = new DbHelper();
        $con = $dbhelper->connect();
        $dbhelper->createAlienTable($con);
    }

    /**
     * Sending welcome message at beginning test
     * @param $chat_id
     */
    function sendWelcome($chat_id){
        $send = new Send();
        $send->message(TG_LINK, $chat_id,WELCOME_MSG, null);
    }

    function beginTest(){

    }
}