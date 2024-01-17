<?php

session_start();

require "non_login_redirect.php";
require "db_connection.php";

$userId = $_GET['id'];
$errors = array();

$sql = "SELECT * FROM accounts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    array_push($errors, "User does not exist");
}

$isOwner = $userId == $_SESSION['id'];

require "../views/profile.view.php";