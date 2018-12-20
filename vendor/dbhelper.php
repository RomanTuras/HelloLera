<?php
 
/**
 * ### HelloLera Telegram Bot ###
 * A class file to connect to database
 */

class DbHelper {
    private $con; //link to mysqli connection

    function __construct() {
        $this->con = $this->connect();
    }

    function __destruct() {
        $this->con->close();
    }

    /**
     * Connecting to the database
     * @return mysqli cursor
     */
    function connect() {
        require_once __DIR__ . '/../config.php';
        $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        if (!$link) {
//            echo "Error: Unable to connect to MySQL." . PHP_EOL;
//            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        mysqli_set_charset($link, "utf8");
        return $link;
    }

    /**
     * Creating table for AlienTest
     */
    function createAlienTable(){
        $sql = "CREATE TABLE IF NOT EXISTS alien_table (
        chat_id int DEFAULT 0,
        username varchar(50),
        question int DEFAULT 0,
        alien int DEFAULT 0,
        human int DEFAULT 0,
        PRIMARY KEY (chat_id)
        );";
        $this->con->query($sql);
    }

    /**
     * Checking, is alien test started or not
     * @param $chat_id
     * @return int number of question, or -1 if column not found
     */
    function getQuestion($chat_id){
        if ($result = $this->con->query("SHOW TABLES LIKE 'alien_table'")) {
            if($result->num_rows == 1) { //if table 'alien_table' exists
                $sql = "SELECT question FROM alien_table WHERE chat_id='$chat_id'";
                $result = $this->con->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        return $row["question"];
                    }
                } else {
                    return -1; //chat_id not found
                }
            }
        } else {
            return -1; //table is not exists
        }
    }

    /**
     * Getting username
     * @param $chat_id
     * @return string `username` or `null` if chat exists, and `chat_not_found` - if chat not exists else
     */
    function getUserName($chat_id){
        $sql = "SELECT username FROM alien_table WHERE chat_id='$chat_id'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["username"];
            }
        } else {
            return 'chat_not_found'; //current chat not found
        }
    }

    /**
     * Getting alien score
     * @param $chat_id
     * @return int score or -1 when error
     */
    function getAlien($chat_id){
        $sql = "SELECT alien FROM alien_table WHERE chat_id='$chat_id'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["alien"];
            }
        } else return -1;
    }

    /**
     * Getting human score
     * @param $chat_id
     * @return int score or -1 when error
     */
    function getHuman($chat_id){
        $sql = "SELECT human FROM alien_table WHERE chat_id='$chat_id'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["human"];
            }
        } else return -1;
    }

    /**
     * Updating username
     * @param $chat_id
     * @param $username
     */
    function updateUserName($chat_id, $username){
        $sql = "UPDATE alien_table SET username='$username' WHERE chat_id='$chat_id'";
        $this->con->query($sql);
    }

    /**
     * Updating number of question
     * @param $chat_id
     * @param $number
     */
    function updateQuestion($chat_id, $number){
        $sql = "UPDATE alien_table SET question='$number' WHERE chat_id='$chat_id'";
        $this->con->query($sql);
    }

    /**
     * Updating alien score
     * @param $chat_id
     * @param $number
     */
    function updateAlien($chat_id, $number){
        $sql = "UPDATE alien_table SET alien='$number' WHERE chat_id='$chat_id'";
        $this->con->query($sql);
    }

    /**
     * Updating human score
     * @param $chat_id
     * @param $number
     */
    function updateHuman($chat_id, $number){
        $sql = "UPDATE alien_table SET human='$number' WHERE chat_id='$chat_id'";
        $this->con->query($sql);
    }

    /**
     * Inserting a new row with chat_id if not exists
     * @param $chat_id
     */
    function insertChatId($chat_id){
        $sql = "INSERT IGNORE INTO alien_table SET chat_id='$chat_id'";
        $this->con->query($sql);
    }
}