<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskQuest</title>
  <link rel="icon" type="image/x-icon" href="../Images/logo.png">
  <link rel="stylesheet" href="../CSS/trial-styles.css">
  <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>

  <header>
    <?php include('header.php'); ?>
  </header>

  <main>
  <?php if (isset($user)): ?>
    <div class="task-list">
      <h2>Task Creator</h2>
      <ul id="tasks">
      </ul>
      <form method="post" action="process-task.php" id="taskForm">
        <input type="text" name="name" placeholder="Enter task name...">
        <input type="text" name="description" placeholder="Enter task description...">
        <input type="date" name="date" placeholder="Enter due date...">
        <input type="time" name="time" placeholder="Enter due time...">
        <input type="text" name="type" placeholder="Enter task type...">
        <input type="text" name="priority" placeholder="Choose priority level...">
        <input type="text" name="status" placeholder="Enter current status...">
        <button type="submit">Add Task</button>
      </form>
    </div>
  </main>

  <?php else: ?>
    <h2>Please <a href="login.php">login</a> to get started.</h2>
    <?php endif; ?>
</body>
</html>