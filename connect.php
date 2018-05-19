<?php
// mysql://b1315ba814fd74:8ad632a5@us-cdbr-iron-east-04.cleardb.net/heroku_a72478552300702?reconnect=true
function getDBConnection() {
    //C9 db info
    $host = "us-cdbr-iron-east-04.cleardb.net";
    $db = "heroku_a72478552300702";
    $user = "b1315ba814fd74";
    $pass = "8ad632a5";
    $charset ="utf8mb4";
    
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    return $pdo; 
}

?>