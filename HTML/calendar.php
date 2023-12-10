<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskQuest</title>
    <link rel="stylesheet" href="../CSS/calendar-styles.css">
    <link rel="stylesheet" href="../CSS/schedule-styles.css">
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="suggested-schedule">
            <h3>Suggested Schedule for Today</h3>
            <ul id="suggestedScheduleList">
                <li>Suggested Activity 1</li>
                <li>Suggested Activity 2</li>
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
                    <div class="task-name" id="task-name">Task Name</div>
                    <div class="description" id="description">Description</div>
                    <div class="due-time" id="due-time">Due Time</div>
                    <div class="type" id="type">Type</div>
                    <div class="priority" id="priority">Priority Level</div>
                    <div class="status" id="status">Current Status</div>
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
        }
        else {
            name.textContent = tasks['name'];
            description.textContent = tasks['description'];
            time.textContent = 'Due: ' + tasks['due_time'];
            type.textContent = 'Type: ' + tasks['type'];
            priority.textContent = 'Priority Level: ' + tasks['priority'];
            status.textContent = 'Status: ' + tasks['status'];
        }
    }

    generateCalendar(12, 2023);
    addEventListenersToDates(12, 2023);

</script>
</body>
</html>
