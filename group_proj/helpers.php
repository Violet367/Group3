<?php


  function query_wrapper($conn, $sql, $snackbar = FALSE){
    if(mysqli_query($conn, $sql)){
        echo "Query Succeeded";
    } else{
        echo "ERROR: Could not able to execute $sql." . mysqli_error($conn);
    }
  }


?>
