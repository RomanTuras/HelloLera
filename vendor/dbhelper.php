<?php
 
/**
 * ### HelloLera Telegram Bot ###
 * A class file to connect to database
 */
class DbHelper {

    // constructor
    function __construct() {}
 
    // destructor
    function __destruct() {}

    /**
     * Connecting to the database
     * @return mysqli cursor
     */
    function connect() {
        require_once __DIR__ . 'config.php';
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

    function createTable($conn){
        
    }
}