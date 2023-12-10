<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

$sql = "INSERT INTO tasks (user_id, name, description, due_date, due_time, type, priority, status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("isssssss",
                  $user['id'],
                  $_POST["name"],
                  $_POST["description"],
                  $_POST['date'],
                  $_POST['time'],
                  $_POST['type'],
                  $_POST['priority'],
                  $_POST['status']);
                  
if ($stmt->execute()) {

    header("Location: calendar.php");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Email Already Taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>