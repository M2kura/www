<?php

/**
 * Validate username.
 *
 * This function validates the username.
 * It checks if the username is empty, if it only contains lowercase letters, numbers, and allowed symbols,
 * and if it's already taken.
 *
 * @param mysqli $conn The database connection.
 * @param string $username The username of the user.
 * @return array Returns an array of error messages.
 */
function validateUsername($conn, $username) {
    $errors = array();

    // Check if the username is empty
    if (empty($username)) {
        array_push($errors, "Username is empty");
    }

    // Sanitize the username
    $username = htmlspecialchars($username);

    // Check if the username only contains lowercase letters, numbers, and allowed symbols
    if(!preg_match("/^[a-z0-9_-]{3,15}$/", $username)) {
        array_push($errors, "Username must have only lowercase letters, numbers and allowed symbols (.; _; -;).");
    }

    // Check if the username is already taken
    $sql = "SELECT * FROM accounts WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        array_push($errors, "Username is already taken");
    }

    return $errors;
}