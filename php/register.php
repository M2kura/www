<?php

// Connect to the MySQL database
$servername = "localhost";
$username = "teterheo";
$password = "webove aplikace";
$dbname = "teterheo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the registration form submission
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Encode the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
    $sql = "INSERT INTO accounts (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

require "../views/register.view.php";