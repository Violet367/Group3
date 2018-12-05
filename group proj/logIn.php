<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$database = "StudyBuddy";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

$email = $_POST["emailu"];
$password1 = $_POST["pss"];


if(mysqli_query($conn, $sql)){
    echo "Your Logging in!";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

 ?>
