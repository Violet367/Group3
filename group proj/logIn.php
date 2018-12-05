<?php

include 'config.php';

$email = $_POST["emailu"];
$password1 = $_POST["pss"];


if(mysqli_query($conn, $sql)){
    echo "Your Logging in!";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

 ?>
