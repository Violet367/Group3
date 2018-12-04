<?php

  $email = $_POST["email"];
  $password1 = $_POST["psw"];

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

$sql = "INSERT INTO Accounts (email, password) VALUES
('$email', '$password1')";

if(mysqli_query($conn, $sql)){
    echo "Account created";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

 ?>
