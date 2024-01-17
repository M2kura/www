<!-- script for updating profile picture -->
<?php

//use the code for uploading profile picture
require "uploadProfilePicture.php";

//update data in the database, protect from SQL injection\
$stmt = $conn->prepare("UPDATE accounts SET profile_pic=? WHERE username=?");
$stmt->bind_param("ss", $fileDestination, $username);
$stmt->execute();
$stmt->close();
$conn->close();