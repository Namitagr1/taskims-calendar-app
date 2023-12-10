<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskQuest</title>
    <link rel="stylesheet" href="../CSS/calendar-styles.css">
</head>
<body>

<div class="calendar">
    <h2 class="calendar-header">December 2023</h2>
    <div class="calendar-labels">
        <div class="calendar-day">Su</div>
        <div class="calendar-day">Mo</div>
        <div class="calendar-day">Tu</div>
        <div class="calendar-day">We</div>
        <div class="calendar-day">Th</div>
        <div class="calendar-day">Fr</div>
        <div class="calendar-day">Sa</div>
    </div>
    <div class="calendar-grid" id="calendarGrid"></div>
    <div class="task-input">
        <label for="taskName">Task Name:</label>
        <input type="text" id="taskName" placeholder="Enter task name">

        <label for="taskDate">Task Date:</label>
        <input type="date" id="taskDate">

        <button onclick="addTask()">Add Task</button>
    </div>
</div>

<script>
    function generateCalendar(year, month) {
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
                    output += `<div class="calendar-day">${date}</div>`;
                    date++;
                }
            }
        }

        calendarGrid.innerHTML = output;
    }

    function addTask() {
        const taskName = document.getElementById('taskName').value;
        const taskDate = document.getElementById('taskDate').value;

        if (taskName && taskDate) {
            alert(`Task: ${taskName}\nDate: ${taskDate}`);
        } else {
            alert('Please enter both task name and date!');
        }
    }

    generateCalendar(2023, 11);

</script>
</body>
</html>
