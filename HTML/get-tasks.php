<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    $date = $_GET['date'];
    $sql = "SELECT * from tasks
            WHERE user_id = {$_SESSION["user_id"]} AND due_date = '{$date}'";
    $result = $mysqli->query($sql);
    $tasks = $result->fetch_assoc();
    header('Content-Type: application/json');
    echo json_encode($tasks);
}
else {
    die('Please login to get started.');
}
?>