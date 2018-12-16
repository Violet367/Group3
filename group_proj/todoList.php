<?php
  include 'config.php';
  session_start();
  $errors = "";

  if (isset($_POST['submit'])){
    $task = $_POST['task'];
    if (empty($task)) {
      $errors = "You must fill in the task";
    } else {
      $sql = "INSERT INTO ToDo (name) VALUES ('$task')";
      if (mysqli_query($conn, $sql)){
          echo "Task created";
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }

      header('location: todoList.php');
    }
  }

  //$_SESSION['completed_tasks'] = array();
  // set completed tasks if not set yet
  if (!isset($_SESSION['completed_tasks'])){
    $_SESSION['completed_tasks'] = array();
  }

  // mark task as completed
  if (isset($_GET['mark_task_completed'])) {
    $id = $_GET['mark_task_completed'];
    if (!isset($_SESSION['completed_tasks']["$id"])){
      $_SESSION['completed_tasks']["$id"] = TRUE;
    } else {
      $_SESSION['completed_tasks']["$id"] = !$_SESSION['completed_tasks']["$id"];
    }
    header('location: todoList.php');
  }

  // delete Task
  if (isset($_GET['del_todo'])){
    $id = $_GET['del_todo'];
    mysqli_query($conn, "DELETE FROM ToDo WHERE idToDo=$id");
    header('location: todoList.php');
  }

  $tasks = mysqli_query ($conn, "SELECT * FROM ToDo");

?>

<!DOCTYPE html>
<html>
<head>
  <title> Study Buddy </title>
  <link rel="stylesheet" href="todolist.css">
</head>
<body style="position:relative;margin:0;padding:0;">

<div style="position: absolute;">

</div>

<div id="myDIV" class="header">
  <h2>To Do List</h2>
  <form method="POST" action="todoList.php">
    <?php if (isset($errors) || $errors != "") { ?>
      <p style="color:white;"><?php echo "$errors"; ?></p>
    <?php } ?>
    <input type="text" id="myInput" name="task" placeholder="Enter a task...">
    <button type="submit" name= "submit" class="addBtn">Add</button>
  </form>
</div>

<ul id="myUL">
  <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>

    <?php
      $key_exists = array_key_exists($row['idToDo'], $_SESSION['completed_tasks']);
      $task_checked = FALSE;
      if ($key_exists){
        $task_checked = $_SESSION['completed_tasks'][$row['idToDo']];
      }
    ?>

    <li class="<?php echo ($task_checked ? "checked" : ""); ?>">
      <a href="todoList.php?mark_task_completed=<?php echo $row['idToDo']; ?>" style="text-decoration:none;color:#333;">
        <div>
          <span style="margin-right: 10px;"><?php echo $i; ?></span>
          <?php echo $row['name']; ?>
        </div>
      </a>
      <a href="todoList.php?del_todo=<?php echo $row['idToDo']; ?>" class="close">&times;</a>
    </li>

  <?php $i++; } ?>

</ul>

</body>
</html>
