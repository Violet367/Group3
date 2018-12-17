<?php
  include 'config.php';
  include 'helpers.php';
  $errors = "";
  $user_id = $_SESSION['user_id'];

  // save class
  if (isset($_POST['submit'])){
    $class_name = $_POST['class_name'];
    if (empty($class_name)) {
      $errors = "Your class must have a name!";
      $_SESSION['errors'] = $errors;
      echo $errors;
    } else {
      $sql = "INSERT INTO Notes (class_name, contents, user_id_fk) VALUES ('$class_name', '','$user_id')";
      if (mysqli_query($conn, $sql)){
          echo "Class created";
      } else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
    }
    header('location: studybuddy.php');
  }
  // delete class
  if (isset($_GET['del_class'])){
    $class_name = $_GET['del_class'];
    $sql = "DELETE FROM Notes WHERE class_name='$class_name' AND user_id_fk='$user_id'";
    echo $sql;
    if (mysqli_query($conn, $sql)){
        echo "Class deleted";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    header('location: studybuddy.php');
  }

  $classes = mysqli_query ($conn, "SELECT * FROM Notes WHERE user_id_fk=$user_id");

?>
