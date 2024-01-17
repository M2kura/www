<?php

/**
 * Upload a profile picture.
 *
 * This function uploads a profile picture for a user.
 * It checks if the file is an allowed type (jpg, jpeg, png), if there was no error while uploading,
 * and if the file size is not too big.
 * It then creates a new file name, creates the file destination folder if it doesn't exist,
 * deletes the old profile picture if it exists, and uploads the file to the destination.
 *
 * @param array $file The uploaded file.
 * @param string $username The username of the user.
 * @return string Returns the destination of the uploaded file.
 */
function uploadProfilePicture($file, $username) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');
    $errors = array();

    if(in_array($fileActualExt, $allowed)) {
        if($fileError === 0) {
            if($fileSize < 2500000) {
                $fileNameNew = "profilePicture.".$fileActualExt;
                if(!file_exists("../uploads/".$username)) {
                    mkdir("../uploads/".$username, 0777, true);
                }
                $fileDestination = "../uploads/".$username."/".$fileNameNew;
                $oldProfilePicture = glob("../uploads/".$username."/profilePicture.*");
                if($oldProfilePicture) {
                    unlink($oldProfilePicture[0]);
                }
                move_uploaded_file($fileTmpName, $fileDestination);
                return $fileDestination;
            } else {
                array_push($errors, "Your file is too big. It must be less than 2.5MB.");
            }
        } else {
            array_push($errors, "There was an error uploading your file.");
        }
    } else {
        array_push($errors, "You cannot upload files of this type.");
    }

    return implode(', ', $errors);
}