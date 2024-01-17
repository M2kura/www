<?php

/**
 * Log out a user.
 *
 * This function ends the current session and redirects the user to the login page.
 */
function logoutUser() {
    session_start();
    session_destroy();
    header('Location: ../index.php');
    exit();
}

logoutUser();