<?php
//connect to database
require "php/db_connection.php";

//if already logged in, redirect to home.php
if(isset($_SESSION['loggedin'])) {
    header('Location: php/home.php');
}
$errors = array();
//check if the form was sunmitted
if(isset($_POST['username'])) {
    //get data from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    //validate if all fields are filled
    if(empty($username) OR empty($password)) {
        array_push($errors, "All fields are required.");
    }
    //validate if username exists
    $sql = "SELECT * FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows == 0) {
        array_push($errors, "Username does not exist.");
    }
    //validate password length (min 8 characters)
    if(strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long.");
    }
    //if no errors, check if password is correct
    if(count($errors) == 0) {
        $sql = "SELECT * FROM accounts WHERE username='$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            //if password is correct, start session and redirect to home.php
            session_start();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            header('Location: php/home.php');
            exit();
        } else {
            array_push($errors, "Password is incorrect.");
        }
    }
}

require "views/index.view.php";