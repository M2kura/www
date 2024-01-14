<?php
// This page must contain user profile picture and name. Below this there's a space with the form that have a user friendly interface where user can upload couple of photos and arange them around this space. Later, at the home page of the website there will be a lost of all pages like that and other user will be able to go checl other people pages.
session_start();

// If the user is not logged in redirect to the login page...
require "non_login_redirect.php";

// Connect to the db with db_connection.php
require "db_connection.php";

// Get the user data from the database
$sql = "SELECT * FROM accounts WHERE id = " . $_SESSION["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$userData = $result->fetch_assoc();
} else {
	$message = "Error: " . $sql . "<br>" . $conn->error;
}

require "../views/profile.view.php";