<!--starting group project
-->

<?php
  include 'config.php';

  if (isset($_POST['submit'])){
    $task = $_POST['task'];

    $sql = "INSERT INTO ToDo (name) VALUES ('$task')";

    // Check the $task is not empty otherwise alert the user
    if (mysqli_query($conn, $sql)){
        echo "Task created";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    // Refresh the page

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
<body>
<div id="myDIV" class="header">
  <h2>To Do List</h2>
  <form method="POST" action="todoList.php">
    <input type="text" id="myInput" name="task" placeholder="Enter a task...">
    <button type="submit" onclick="newElement()" name= "submit" class="addBtn">Add</button>
  </form>
</div>

<ul id="myUL">
  <li>
    echo DB[name]
    <span class="close">&times;</span>
  </li>

</ul>

</body>
</html>
