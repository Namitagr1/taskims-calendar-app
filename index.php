<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/html/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskIms</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
</head>
<body>
    <header>
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <style>
        body {
            font-family: 'Lexend';font-size: 22px;
        }
    </style>
        <nav>
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="TaskIms Logo"></a>
            </div>
            <ul class="nav-links">
                <?php if (isset($user)): ?>
                    <li style="color: white;">Points: <?php echo $user['points'] ?></li>
                    <li style="color: white;">Level: <?php echo (intdiv($user['points'], 500) + 1)?></li>
                <?php endif; ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="HTML/calendar.php">Calendar</a></li>
                <?php if (isset($user)): ?>
                    <li><a href="HTML/logout.php">Log Out</a></li>
                <?php else: ?>
                    <li><a href="HTML/login.php">Log In</a></li>
                    <li><a href="HTML/signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section class="starting-text">
            <?php if (isset($user)): ?> 
            <h1>Welcome to TaskIms, <?= htmlspecialchars(explode(" ", $user["name"])[0]) ?>!</h1>
            <?php else: ?>
            <h1>Welcome to TaskIms, Guest!</h1>
            <?php endif; ?>
            <p>The gamified way to keep your tasks in order, powered by an <span style="color: blue;">intelligent algorithm</span> to create suggested schedules.</p>
            <br><br><a href="HTML/calendar.php"><img src="Images/get-started.png" alt="Get Started"></a>
        </section>
    </main>
</body>
</html>