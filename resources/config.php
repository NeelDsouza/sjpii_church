<?php
session_start();

defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER","root");
defined("DB_PASS") ? null : define("DB_PASS", "");
defined("DB_NAME") ? null : define("DB_NAME",  "sjpii_church");

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("FRONTEND") ? null : define("FRONTEND", __DIR__ . DS . "frontend");
defined("JSON") ? null : define("JSON", __DIR__ . DS . "json");
defined("TEMPLATES") ? null : define("TEMPLATES", __DIR__ . DS . "templates");
defined("UPLOADS") ? null : define("UPLOADS", __DIR__ . DS . "uploads");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if ($connection === false) {
//     echo "Connect Error";
//     die("Connection failed: " . mysqli_connect_error());
// } 
// echo "Connected successfully";

function set_message($msg){
    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}   
    
// function display_message() {
//     if(isset($_SESSION['message'])) {
//         echo $_SESSION['message'];
//     }
//     unset($_SESSION['message']);
// }
    
function redirect($location){
    return exit(header("Location: $location"));
}

function query($sql) {
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result){
    global $connection;
    if(!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

function escape_string($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){
    return mysqli_fetch_array($result);
}

function last_id($table_name){
    $last_id = confirm("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'sjpii_church' AND TABLE_NAME = '{$table_name}'");
    return $last_id;
}
?>