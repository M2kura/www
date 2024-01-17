<?php 

/**
 * Establish a connection to the database.
 *
 * This function creates a new mysqli object and tries to connect
 * to the database using the provided server name, username, password, and database name.
 * If the connection fails, the script will stop execution and display an error message.
 *
 * @return mysqli Returns a mysqli object representing the connection to the database on success,
 * and terminates the script on failure.
 */
function connectToDatabase() {
    $servername = "localhost";
    $username = "teterheo";
    $password = "webove aplikace";
    $dbname = "teterheo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

$conn = connectToDatabase();
