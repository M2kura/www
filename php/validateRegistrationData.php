<?php

/**
 * Validate registration data.
 *
 * This function validates the registration data (username, email, password, confirm password).
 * It checks if the username only contains lowercase letters, numbers, and allowed symbols,
 * if the email is valid, if the password is at least 8 characters long, and if the email already exists in the database.
 *
 * @param mysqli $conn The database connection.
 * @param string $username The username of the user.
 * @param string $email The email of the user.
 * @param string $password The password of the user.
 * @param string $cpassword The confirm password of the user.
 * @return array Returns an array of error messages.
 */
function validateRegistrationData($conn, $username, $email, $password, $cpassword) {
    $errors = array();

    // Validate username
    if(!preg_match("/^[a-z0-9_-]{3,15}$/", $username)) {
        array_push($errors, "Username must have only lowercase letters, numbers and allowed symbols (.; _; -;).");
    }

    // Validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is invalid.");
    }

    // Validate password length (min 8 characters)
    if(strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }

    // Validate if email already exists
    $sql = "SELECT * FROM accounts WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        array_push($errors, "Email already exists.");
    }

    return $errors;
}