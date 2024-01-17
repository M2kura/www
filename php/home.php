<?php

session_start();

require "db_connection.php";

require "non_login_redirect.php";

//Fetch all users from the database
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