<?php
//error_reporting(E_ERROR);
$hostname = "ecs.fullerton.edu";
$database = "cs431s35";
$username = "cs431s35";
$password = "xeivaiqu";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>
