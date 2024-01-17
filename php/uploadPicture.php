<?php
session_start();
require "db_connection.php";
require "non_login_redirect.php";

//script should take the file and text from the form and upload it to the
//local directory attached to the user.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $file = $_FILES["picture"];
        
        // Get the file name and extension
        $fileName = $file["name"];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
        // Generate a unique file name
        $uniqueFileName = uniqid() . "." . $fileExtension;
        
        // Move the uploaded file to the desired directory
        $uploadDirectory = "/path/to/upload/directory/";
        $destination = $uploadDirectory . $uniqueFileName;
        
        if (move_uploaded_file($file["tmp_name"], $destination)) {
            // File uploaded successfully
            // Perform any additional operations here
            
            // Redirect to a success page
            header("Location: success.php");
            exit;
        } else {
            // Error occurred while uploading the file
            echo "Error uploading file.";
        }
    } else {
        // No file was uploaded
        echo "No file uploaded.";
    }
}
