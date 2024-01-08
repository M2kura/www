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

        // Check if a file was uploaded
        if (isset($_FILES["profilePicture"]) && $_FILES["profilePicture"]["error"] == 0) {
            $targetDir = "./uploads/";
            $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);

            // Check if the file is an image
            $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
            if ($check !== false) {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
                    // File upload successful
                    $message .= " Profile picture uploaded successfully!";
                } else {
                    // File upload failed
                    $message .= " Sorry, there was an error uploading your profile picture.";
                }
            } else {
                // File is not an image
                $message .= " File is not an image.";
            }
        } else {
            // No file was uploaded
            $message .= " No file was uploaded.";
        }
    } else {
        $message =  "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

require "../views/register.view.php";