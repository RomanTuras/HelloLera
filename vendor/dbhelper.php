<?php
 
/**
 * ### HelloLera Telegram Bot ###
 * A class file to connect to database
 */

class DbHelper {

    function __construct() {}
    function __destruct() {}

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

    function createAlienTable($con){
        $sql = "CREATE TABLE IF NOT EXISTS alien_table (
        id int NOT NULL AUTO_INCREMENT,
        chat_id int DEFAULT 0,
        username varchar(50),
        question int DEFAULT 0,
        alien int DEFAULT 0,
        human int DEFAULT 0,
        PRIMARY KEY (id)
        );";
        $con->query($sql);
    }
}