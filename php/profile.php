<?php

session_start();

require "non_login_redirect.php";
require "db_connection.php";

// Get the username from the URL parameter
$username = $_GET['username'];
$errors = array();

$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    array_push($errors, "User does not exist");
}

$isOwner = $username == $_SESSION['username'];

require "../views/profile.view.php";