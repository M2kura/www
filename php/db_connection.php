<?php 

// Connect to the MySQL database
$servername = "localhost";
$username = "teterheo";
$password = "webove aplikace";
$dbname = "teterheo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}