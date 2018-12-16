<?php
  $errors = "";
  $user_id = get_user_id_from_email($conn);

  if (isset($_POST['submit'])){
    $task = $_POST['task'];
    if (empty($task)) {
      $errors = "You must fill in the task";
    } else {
      $sql = "INSERT INTO ToDo (name, user_id_fk) VALUES ('$task', '$user_id')";
      if (mysqli_query($conn, $sql)){
          echo "Task created";
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }

      header('location: studybuddy.php');
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
    header('location: studybuddy.php');
  }

  // delete Task
  if (isset($_GET['del_todo'])){
    $id = $_GET['del_todo'];
    mysqli_query($conn, "DELETE FROM ToDo WHERE idToDo=$id");
    header('location: studybuddy.php');
  }

  $tasks = mysqli_query ($conn, "SELECT * FROM ToDo WHERE user_id_fk=$user_id"); // WHERE ID = ID

?>
