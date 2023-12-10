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

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "DELETE FROM tasks WHERE id = {$_POST['task-id']}";
    
    $result = $mysqli->query($sql);
    if ($_POST['priority'] === "Low") {
        $sql = "UPDATE user SET points = points + 50 WHERE id = {$_SESSION["user_id"]}";
    }
    elseif ($_POST['priority'] === "Medium") {
        $sql = "UPDATE user SET points = points + 100 WHERE id = {$_SESSION["user_id"]}";
    }
    else {
        $sql = "UPDATE user SET points = points + 150 WHERE id = {$_SESSION["user_id"]}";
    }
    $result = $mysqli->query($sql);
    header('calendar.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskIms</title>
    <link rel="stylesheet" href="../CSS/calendar-styles.css">
    <link rel="stylesheet" href="../CSS/schedule-styles.css">
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
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
    <div class="container">
        <div class="suggested-schedule">
            <?php
                if (isset($_SESSION["user_id"])) {
                    $mysqli = require __DIR__ . "/database.php";
                    $sql = "SELECT name FROM tasks
                            WHERE user_id = {$_SESSION["user_id"]}
                            ORDER BY due_date, priority";    
                    $result = $mysqli->query($sql);
                    $task_list = [];
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $task_list[] = $row['name'];
                        }
                    }
                    $json_tasks = json_encode($task_list);
                }
            ?>
            <h3>Suggested Schedule for Today</h3>
            <ul id="suggestedScheduleList">
                <?php if (isset($user)): ?>
                    <li id = "schedule-list-1"></li>
                    <li id = "schedule-list-2"></li>
                    <li id = "schedule-list-3"></li>
                    <li id = "schedule-list-4"></li>
                    <li id = "schedule-list-5"></li>
                    <li id = "schedule-list-6"></li>
                    <li id = "schedule-list-7"></li>
                    <li id = "schedule-list-8"></li>
                    <script>
                        function createSchedule(task_list) {
                            const workHoursStart = 9; // Work hours start at 9 AM
                            const workHoursEnd = 17; // Work hours end at 5 PM

                            let currentHour = workHoursStart;
                            let schedule = [];

                            for (let i = 0; i < task_list.length; i++) {
                                const task = task_list[i];
                                const taskDuration = Math.floor(Math.random() * 3) + 1; // Random task duration between 1-3 hours
                                const taskEndHour = currentHour + taskDuration;

                                if (taskEndHour <= workHoursEnd) {
                                schedule.push(`${currentHour}:00 - ${taskEndHour}:00: ${task}`);
                                currentHour = taskEndHour;
                                if (currentHour < workHoursEnd) {
                                    schedule.push(`${currentHour}:00 - ${currentHour+1}:00: Break`);
                                    currentHour += 1; // Adding 30 minutes for the break
                                }
                                } else {
                                break; // If the task can't fit in the remaining work hours, stop scheduling
                                }
                            }

                            return schedule;
                        }
                        var task_list = JSON.parse('<?php echo $json_tasks; ?>');
                        const schedule = createSchedule(task_list);
                        const schedule_list_1 = document.getElementById('schedule-list-1');
                        const schedule_list_2 = document.getElementById('schedule-list-2');
                        const schedule_list_3 = document.getElementById('schedule-list-3');
                        const schedule_list_4 = document.getElementById('schedule-list-4');
                        const schedule_list_5 = document.getElementById('schedule-list-5');
                        const schedule_list_6 = document.getElementById('schedule-list-6');
                        const schedule_list_7 = document.getElementById('schedule-list-7');
                        const schedule_list_8 = document.getElementById('schedule-list-8');
                        const schedule_list = [schedule_list_1, schedule_list_2, schedule_list_3, schedule_list_4, schedule_list_5, schedule_list_6, schedule_list_7, schedule_list_8]
                        for (let i = 0; i < schedule.length; ++i) {
                            schedule_list[i].textContent = schedule[i];
                        }
                        if (schedule.length === 0) {
                            schedule_list_1.textContent = 'You have no tasks scheduled. Take a break today!';
                        }
                    </script>
                <?php else: ?>
                    <li>Log in to get schedule suggestions.</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="calendar">
            <h2 class="calendar-header">December 2023</h2>
            <div class="calendar-labels">
                <div class="calendar-label">Su</div>
                <div class="calendar-label">Mo</div>
                <div class="calendar-label">Tu</div>
                <div class="calendar-label">We</div>
                <div class="calendar-label">Th</div>
                <div class="calendar-label">Fr</div>
                <div class="calendar-label">Sa</div>
            </div>
            <div class="calendar-grid" id="calendarGrid"></div>
            <div class="task-input">
                <a href="add-task.php"><button class = "task-adder">Add Task</button></a>
            </div>
        </div>

        <div class="tasks-due">
            <h3 id = "date-lister">Tasks Due</h3>
            <ul id="tasksDueList">
                <li>
                    <form method="post">
                        <div class="task-name" id="task-name">Task Name</div>
                        <div class="description" id="description">Description</div>
                        <div class="due-time" id="due-time">Due Time</div>
                        <div class="type" id="type">Type</div>
                        <div class="priority" id="priority">Priority Level</div>
                        <div class="status" id="status">Current Status</div>
                        <input type="hidden" name="task-id" id="task-id">
                        <input type="hidden" name="priority" id="priority-level">
                        <div class="remove" id="remove"></div>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <script>
    function generateCalendar(month, year) {
        month = month - 1;
        const calendarGrid = document.getElementById('calendarGrid');
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDay = new Date(year, month, 1).getDay();

        let date = 1;
        let output = '';

        for (let i = 0; i < 6; i++) {
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    output += '<div class="calendar-day"></div>';
                } else if (date > daysInMonth) {
                    break;
                } else {
                    output += `<div class="calendar-day" id="date-${date}">${date}</div>`;
                    date++;
                }
            }
        }

        calendarGrid.innerHTML = output;
    }

    function addEventListenersToDates(month, year) {
        const dates = document.querySelectorAll('.calendar-day');

        dates.forEach((dateElement) => {
            dateElement.addEventListener('click', function() {
                const date = year.toString() + '-' + month.toString() + '-' + this.textContent;
                showTasksForDate(date);
            });
        });
    }

    function showTasksForDate(date) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                const tasks = JSON.parse(this.responseText);
                displayTasks(date, tasks);
            }
        };

        xhr.open('GET', `get-tasks.php?date=${date}`, true);
        xhr.send();
    }

    function displayTasks(date, tasks) {
        const date_print = document.getElementById('date-lister');
        date_print.textContent = 'Tasks Due ' + date;
        const name = document.getElementById('task-name');
        const description = document.getElementById('description');
        const time = document.getElementById('due-time');
        const type = document.getElementById('type');
        const priority = document.getElementById('priority');
        const status = document.getElementById('status');
        if (tasks === null) {
            name.textContent = 'No Tasks Due';
            description.textContent = '';
            time.textContent = '';
            type.textContent = '';
            priority.textContent = '';
            status.textContent = '';
            const removeButton = document.getElementById('remove');
            const button = document.createElement('div');
            button.textContent = '';
            button.id = 'remove';
            button.class = 'remove';
            removeButton.parentNode.replaceChild(button, removeButton);
        }
        else {
            const task_id = document.getElementById('task-id');
            task_id.value = tasks['id'];
            const priority_level = document.getElementById('priority-level');
            priority_level.value = tasks['priority'];
            name.textContent = tasks['name'];
            description.textContent = tasks['description'];
            time.textContent = 'Due: ' + tasks['due_time'];
            type.textContent = 'Type: ' + tasks['type'];
            priority.textContent = 'Priority Level: ' + tasks['priority'];
            status.textContent = 'Status: ' + tasks['status'];

            const removeButton = document.getElementById('remove');
            const button = document.createElement('button');
            button.textContent = 'Task Finished?';
            button.id = 'remove';
            button.class = 'remove';
            button.type = 'submit';
            removeButton.parentNode.replaceChild(button, removeButton);
        }
    }

    generateCalendar(12, 2023);
    addEventListenersToDates(12, 2023);

</script>
</body>
</html>