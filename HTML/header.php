<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<header>
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <style>
        body {
            font-family: 'Lexend';font-size: 22px;
        }
    </style>
    <nav>
        <div class="logo">
            <a href="../index.php"><img src="../Images/logo.png" alt="TaskIms Logo"></a>
        </div>
        <ul class="nav-links">
            <?php if (isset($user)): ?>
                <li style="color: white;">Points: <?php echo $user['points'] ?></li>
                <li style="color: white;">Level: <?php echo (intdiv($user['points'], 500) + 1)?></li>
            <?php endif; ?>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../HTML/calendar.php">Calendar</a></li>
            <?php if (isset($user)): ?>
                <li><a href="../HTML/logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="../HTML/login.php">Log In</a></li>
                <li><a href="../HTML/signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>