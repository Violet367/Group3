<?php

$servername = "localhost";
$username = "root";
$password = "In\$tE77-Dh1sch001";/*"mysql";*/
$database = "StudyBuddy";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/*echo "Connected successfully";*/
if(session_id() == '' || !isset($_SESSION)) {
  session_start(); // start sessions if it hasn't been started
}
?>
