<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskIms</title>
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
        <input type="text" name="name" class="prompts" placeholder="Enter task name...">
        <input type="text" name="description" class="prompts" placeholder="Enter task description...">
        <input type="date" name="date" class="prompts" placeholder="Enter due date...">
        <input type="time" name="time" class="prompts" placeholder="Enter due time...">
        <input type="text" name="type" class="prompts" placeholder="Enter task type...">
        <input type="text" name="priority" class="prompts" placeholder="Choose priority level...">
        <input type="text" name="status" class="prompts" placeholder="Enter current status...">
        <button type="submit" class="prompts">Add Task</button>
      </form>
    </div>
  </main>

  <?php else: ?>
    <h2>Please <a href="login.php">login</a> to get started.</h2>
    <?php endif; ?>
</body>
</html>