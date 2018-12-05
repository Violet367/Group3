<?php

include 'config.php';


$email = $_POST["email"];
$password1 = $_POST["psw"];

$sql = "INSERT INTO Accounts (email, password) VALUES
('$email', '$password1')";

if(mysqli_query($conn, $sql)){
    echo "Account created";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

header("location: frontpage.html");
?>
