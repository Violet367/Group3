<?php
  function query_wrapper($conn, $sql, $snackbar = FALSE){
    if(mysqli_query($conn, $sql)){
        echo "Query Succeeded: $sql";
    } else{
        echo "ERROR: Was not able to execute $sql." . mysqli_error($conn);
    }
  }

  function get_user_id_from_email($conn){
    $email = $_SESSION['login_user'];
    $sql = "SELECT user_id FROM Accounts WHERE email='$email'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    return $row['user_id'];
  }


?>
