<?php

require "db_connection.php";

$errors = array();

if(isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //password hashing
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    //validate if all fields are filled
    if(empty($username) OR empty($email) OR empty($password) OR empty($cpassword)) {
        array_push($errors, "All fields are required.");
    }

    //validate if username exists and have only lowercase letters, numbers and allowed symbols (. _ -)
    $sql = "SELECT * FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        array_push($errors, "Username already exists.");
    }
    if(!preg_match("/^[a-z0-9_-]{3,15}$/", $username)) {
        array_push($errors, "Username must have only lowercase letters, numbers and allowed symbols (.; _; -;).");
    }

    //validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is invalid.");
    }

    //validate password length (min 8 characters)
    if(strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }

    //validate if email already exists
    $sql = "SELECT * FROM accounts WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        array_push($errors, "Email already exists.");
    }
    

    //if no errors, insert data into database and upload the profile pic using $fileDestination. Make sure there can't be any SQL injection
    if(count($errors) == 0) {
        // Set default profile picture
        $fileDestination = "../uploads/default/defaultProfilePic.png";
        //check if profile picture was uploaded, if yes, validate it
        if(isset($_FILES['profilePicture'])) {
            $file = $_FILES['profilePicture'];
            $fileName = $_FILES['profilePicture']['name'];
            $fileTmpName = $_FILES['profilePicture']['tmp_name'];
            $fileSize = $_FILES['profilePicture']['size'];
            $fileError = $_FILES['profilePicture']['error'];
            $fileType = $_FILES['profilePicture']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            //validate if file is allowed
            if(in_array($fileActualExt, $allowed)) {
                //validate if there was no error while uploading
                if($fileError === 0) {
                    //validate if file size is not too big
                    if($fileSize < 2500000) {
                        //create file name profilePicture.extension
                        $fileNameNew = "profilePicture.".$fileActualExt;
                        //create file destination folder if it doesn't exist
                        if(!file_exists("../uploads/".$username)) {
                            mkdir("../uploads/".$username, 0777, true);
                        }
                        //set file destination (../uploads/{username}/profilePicture.extension)
                        $fileDestination = "../uploads/".$username."/".$fileNameNew;
                        //upload file to the destination
                        move_uploaded_file($fileTmpName, $fileDestination);
                    } else {
                        array_push($errors, "Your file is too big. It must be less than 2.5MB.");
                    }
                } else {
                    array_push($errors, "There was an error uploading your file.");
                }
            } else {
                array_push($errors, "You cannot upload files of this type.");
            }
        } 

        //insert data into database, protect from SQL injection
        $stmt = $conn->prepare("INSERT INTO accounts (username, password, email, profile_pic) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashPassword, $email, $fileDestination);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        //set success message
        $message = "Success! Redirecting to login page...";

        //redirect to the login page with countdown timer and success message
        header("refresh:3;url=../index.php");
        echo "<p class='success'>$message</p>";
        exit();
    }
}

require "../views/register.view.php";