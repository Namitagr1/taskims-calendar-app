<?php

session_start();

session_destroy();
?>
<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: ../index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>TaskQuest</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/signup-style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/logo.png">
</head>
<body>
    <?php include('header.php'); ?>
    <div id="starting-text">
        <br><h1>Login</h1><br>
        
        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
            <br><br>
        <?php endif; ?>
        
        <form method="post">
            <label for="email" style="position: relative; right: 15px;">Email </label>
            <input type="email" name="email" id="email" style = "width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 15px;"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            <br><br>
            <label for="password" style="position: relative; right: 36px;">Password </label>
            <input type="password" name="password" id="password" style = "width: 200px; height: 40px; border: none; border-radius: 8px; background: #d0d2d6; position: relative; right: 36px;">
            <br><br>
            <button style="font-family: system-ui; font-size: 120%; padding: 5px 20px 8px 20px; position: relative;">Log in</button>
            <br><br><p>Don't have an account? <a href="signup.php" style="text-decoration: none">Sign Up</a></p>
        </form>
    </div>
</body>
</html>