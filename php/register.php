<?php
require "db_connection.php";
require "validateRegistrationData.php";
require "uploadProfilePicture.php";

if(isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $errors = validateRegistrationData($conn, $username, $email, $password, $cpassword);

    if(count($errors) == 0) {
        $fileDestination = "../uploads/default/defaultProfilePic.png";
        if(isset($_FILES['profile_pic'])) {
            $uploadResult = uploadProfilePicture($_FILES['profile_pic'], $username);
            if(strpos($uploadResult, ', ') === false) { // No errors occurred during file upload
                $fileDestination = $uploadResult;
            } else {
                // Handle file upload errors
                $errors = explode(', ', $uploadResult);
                // Display errors to the user
            }
        }

        if(count($errors) == 0) {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO accounts (username, password, email, profile_pic) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashPassword, $email, $fileDestination);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            $message = "Success! Redirecting to login page...";
            header("refresh:3;url=../index.php");
            echo "<p class='success'>$message</p>";
            exit();
        }
    }
}

$errors = isset($errors) ? $errors : [];
require "../views/register.view.php";