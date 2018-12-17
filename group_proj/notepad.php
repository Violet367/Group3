<?php
  include 'config.php';
  include 'helpers.php';
  $errors = "";
  $user_id = $_SESSION['user_id'];

  // save notes
  if (isset($_POST['submit'])){
    $class_name = $_POST['class_name'];
    $contents = $_POST['contents'];
    if (empty($class_name)) {
      $errors = "Need to select a class to save notes";
      $_SESSION['errors'] = $errors;
      echo $errors;
    } else if (empty($contents)) {
      $errors = "Notes can't be empty";
      $_SESSION['errors'] = $errors;
    } else {
      $sql = "UPDATE Notes SET contents='$contents' WHERE class_name='$class_name' AND user_id_fk='$user_id'";
      if (mysqli_query($conn, $sql)){
        echo "Notes Saved";
        $_SESSION['errors'] = "<span style='color:#14e06f;'>Notes Saved Successfully</span>";
        $_SESSION['current_notes'] = "$contents";
      } else{
        $errors = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        echo $errors;
        $_SESSION['errors'] = $errors;
      }
    }
    header('location: studybuddy.php');
  }

  // change current class
  if (isset($_GET['change_current_class'])){
    $class_name = $_GET['change_current_class'];
    echo $class_name;
    $_SESSION['current_class'] = $class_name;

    $sql = "SELECT contents FROM Notes WHERE class_name='$class_name' AND user_id_fk='$user_id'";
    $query_results = mysqli_query($conn, $sql);
    $_SESSION['current_notes'] = mysqli_fetch_array($query_results)['contents'];

    $_SESSION['errors'] = "<span style='color:#14e06f;'>Current Class Is Now $class_name</span>";
    header('location: studybuddy.php');
  }

?>
