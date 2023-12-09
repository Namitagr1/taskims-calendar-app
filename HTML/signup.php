<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

if (isset($user)) {
    echo '<script>alert("Warning: opening up the signup page will automatically log you out!");</script>';
}

session_destroy();
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <title>TaskQuest</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/signup-style.css">
    <link rel="icon" type="image/x-icon" href="../images/logo.png">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
</head>
<body>
    <?php include('header.php'); ?>
    <div id="starting-text">
        
        <br><h1>Signup</h1><br>
        <form action="process-signup.php" method="post" id="signup" novalidate>
            <div>
                <label for="name" style="position: relative; right: 20px;">Name </label>
                <input type="text" id="name" name="name" style="width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 20px;">
            </div>
            <br>
            <div>
                <label for="email" style="position: relative; right: 18px;">Email </label>
                <input type="email" id="email" name="email" style="width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 18px;">
            </div>
            <br>
            <div>
                <label for="password" style="position: relative; right: 32px;">Password </label>
                <input type="password" id="password" name="password" style="width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 32px;">
            </div>
            <br>
            <div>
                <label for="password_confirmation" style="position: relative; right: 62.5px;">Confirm Password </label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 62.5px;">
            </div>
            <br>
            <button style="font-family: system-ui; font-size: 120%; padding: 5px 20px 8px 20px; position: relative;">Sign up</button>
            <br><br><p>Already have an account? <a href="login.php" style="text-decoration:none">Log In</a></p>
        </form>
    </div>
</body>
</html>