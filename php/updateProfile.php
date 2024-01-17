<?php
session_start();

require "db_connection.php";

// Purpose: hadle the update of the username in the database

$username = $_POST['username'];
$errors = array();

//check if the username is empty and store the error in the errors array
if (empty($username)) {
    array_push($errors, "Username is empty");
}

//sanitize the username
$username = htmlspecialchars($username);

if(!preg_match("/^[a-z0-9_-]{3,15}$/", $username)) {
    array_push($errors, "Username must have only lowercase letters, numbers and allowed symbols (.; _; -;).");
}

//check if the username is already taken
$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    array_push($errors, "Username is already taken");
}

//if any errors, show them at the same page
if (count($errors) > 0) {
    $_SESSION['errors'] = $errors;
    header("Location: edit_profile.php");
    exit();
}

//Update the username in the database
$sql = "UPDATE accounts SET username = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $_SESSION['id']);
$stmt->execute();

header("Location: profile.php");