<?php 

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
                //delete old profile picture if it exists, no matter what extension it has
                $oldProfilePicture = glob("../uploads/".$username."/profilePicture.*");
                if($oldProfilePicture) {
                    unlink($oldProfilePicture[0]);
                }
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