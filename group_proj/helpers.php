<?php
  if(session_id() == '' || !isset($_SESSION)) {
    session_start(); // start sessions if it hasn't been started
  }

  if(!function_exists('query_wrapper')){
    function query_wrapper($conn, $sql, $snackbar = FALSE){
      if(mysqli_query($conn, $sql)){
          echo "Query Succeeded: $sql";
      } else{
          echo "ERROR: Was not able to execute $sql." . mysqli_error($conn);
      }
    }
  }

  if(!function_exists('get_user_id_from_email')){
    function get_user_id_from_email($conn){
      $email = $_SESSION['login_user'];
      $sql = "SELECT user_id FROM Accounts WHERE email='$email'";
      $query = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($query);
      return $row['user_id'];
    }
  }

  $_SESSION['user_id'] = get_user_id_from_email($conn);


?>
