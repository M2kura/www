<?php

session_start();

require "non_login_redirect.php";
require "db_connection.php";

// Get the id from the URL, or use the logged-in user's id if no id is specified in the URL
$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];

$sql = "SELECT * FROM accounts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    $message = "User not found";
}

$isOwner = $id == $_SESSION['id'];
//script for updating profile picture]

require "../views/profile.view.php";