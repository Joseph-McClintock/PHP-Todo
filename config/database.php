<?php 
    session_start();
    define('DB_HOST', 'localhost');    
    define('DB_USER', 'joseph');    
    define('DB_PASS', '123456');    
    define('DB_NAME', 'todo');    

    //create connection 
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //check connection 
    if($conn->connect_error) {
        die('Connection Failed' . $conn->connect_error);
    }
?>