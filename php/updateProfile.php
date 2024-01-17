<?php
session_start();

require "db_connection.php";

// Purpose: hadle the update of the username or/and the profile picture of logged in user

$username = $_POST['username'];

// Sanitize and validate the data as needed
if (empty($username)) {
    header("Location: ../profile.php?error=emptyfields");
    exit();
}
//sanitize the username with htmlspecialchar
$username = htmlspecialchars($username);

//validate the username
if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../profile.php?error=invalidusername");
    exit();
}

//Update the username in the database
$sql = "UPDATE accounts SET username = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $_SESSION['id']);
$stmt->execute();

header("Location: profile.php");