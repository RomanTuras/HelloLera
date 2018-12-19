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

    function createAlienTable(){
        $sql = "CREATE TABLE IF NOT EXISTS alien_table (
        id int NOT NULL AUTO_INCREMENT,
        chat_id int DEFAULT 0,
        username varchar(50),
        question int DEFAULT 0,
        alien int DEFAULT 0,
        human int DEFAULT 0,
        PRIMARY KEY (id)
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
                $sql = "SELECT question FROM alien_table WHERE chat_id=".$chat_id;
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
        $sql = "SELECT username FROM alien_table WHERE chat_id=".$chat_id;
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
     * Inserting a new row with chat_id if not exists
     * @param $chat_id
     */
    function insertChatId($chat_id){
        $sql = "INSERT IGNORE INTO alien_table SET chat_id=".$chat_id;
        $this->con->query($sql);
    }
}