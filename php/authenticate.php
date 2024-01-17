<?php
require "db_connection.php";

/**
 * Authenticate a user.
 *
 * This function checks if the username exists in the database and if the password is correct.
 * If the username does not exist or the password is incorrect, it adds an error message to the errors array.
 * If the username exists and the password is correct, it starts a session and sets the 'loggedin' session variable to TRUE.
 *
 * @param string $username The username of the user.
 * @param string $password The password of the user.
 * @return array Returns an array containing any error messages. If the array is empty, the user was authenticated successfully.
 */
function authenticateUser($username, $password) {
    global $conn;
    $errors = array();

    // Validate if all fields are filled
    if(empty($username) OR empty($password)) {
        array_push($errors, "All fields are required.");
    }

    // Validate if username exists
    $sql = "SELECT * FROM accounts WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 0) {
        array_push($errors, "Username does not exist.");
    }

    // Validate password length (min 8 characters)
    if(strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }

    // If no errors, check if password is correct
    if(count($errors) == 0) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            // If password is correct, start session and redirect to home.php
            session_start();
            $_SESSION['loggedin'] = TRUE;
        } else {
            array_push($errors, "Incorrect password.");
        }
    }

    return $errors;
}

if(isset($_POST['username'])) {
    $errors = authenticateUser($_POST['username'], $_POST['password']);
    if(empty($errors)) {
        header('Location: php/home.php');
    }
}

require "../index.php";