<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TaskQuest</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
</head>
<body>
    <header>
        <br>
        <a href = "index.php"><img src="images/logo.png" height="8%" width = "8%" alt = "TaskQuest Logo"></a>
        <a href="index.php">Home</a>
        <a href="calendar.php">Calendar</a>
        <a href="login.php">Login</a>
        <a href="signup.php">Sign Up</a>
        <div>
            <button><i></i>
            <i></i></button>
            <div>
                <?php if (isset($user)): ?>
                    <a href="logout.php">Log Out</a>
                <?php else: ?>
                    <a href="login.php">Log In</a>
                <?php endif; ?>
                <a href="signup.php">Sign Up</a>
            </div>
        </div>
        <br><br>
    </header>
</body>
</html>
