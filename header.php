<header>
    <nav>
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="TaskQuest Logo"></a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="calendar.php">Calendar</a></li>
            <?php if (isset($user)): ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php else: ?>
                <li><a href="login.php">Log In</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>