<?php
session_start();

require "db_connection.php";
require "validateUsername.php";

// Purpose: handle the update of the username in the database

if(isset($_POST['username'])) {
    $username = $_POST['username'];

    $errors = validateUsername($conn, $username);

    if(count($errors) == 0) {
        $sql = "UPDATE accounts SET username = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $username, $_SESSION['id']);
        $stmt->execute();
        $_SESSION['username'] = $username;
        // Redirect to profile page with url id or show success message
        header("Location: profile.php?id=".$_SESSION['id']);
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        // Redirect back to profile edit page or show errors
        header("Location: edit_profile.php");
        exit();
    }
}