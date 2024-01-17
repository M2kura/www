<?php

session_start();

require "db_connection.php";

require "non_login_redirect.php";

/**
 * Fetch all users from the database.
 *
 * This function retrieves all users from the 'accounts' table in the database.
 * It fetches the 'username' and 'profile_pic' fields for each user.
 * The results are returned as an array of associative arrays, each representing a user.
 *
 * @param mysqli $conn The mysqli object representing the database connection.
 * @return array Returns an array of associative arrays, each representing a user.
 */
function getAllUsers($conn) {
    $sql = "SELECT username, profile_pic FROM accounts";
    $result = mysqli_query($conn, $sql);

    $users = [];
    while($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    return $users;
}

$users = getAllUsers($conn);

require "../views/home.view.php";