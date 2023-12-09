<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task Scheduler</title>
  <link rel="stylesheet" href="../CSS/trial-styles.css">
  <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>

  <header>
    <?php include('header.php'); ?>
  </header>

  <main>
    <div class="task-list">
      <h2>Today's Tasks</h2>
      <ul id="tasks">
        <!-- Tasks added through JavaScript -->
      </ul>
      <form id="taskForm">
        <input type="text" id="taskInput" placeholder="Enter task...">
        <button type="submit">Add Task</button>
      </form>
    </div>
  </main>

  <script src="../JS/trial-code.js"></script>
</body>
</html>
