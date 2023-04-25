<?php

require_once '../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editPerson.inc.php');

if (isset($_POST["submitSelfEdit"])) {
    // Create Validation object
    $validate = new Validate();

    // Acquire the data
    $data = array(array(
        'FName' => $_POST["FName"],
        'LName' => $_POST["LName"],
        'BirthDate' => $_POST["BirthDate"],
        'Phone' => $_POST["Phone"],
        'Email' => $_POST["Email"]
    ));

    foreach ($data[0] as $key => $value) {
        // General validation

        $validate->isEmpty($fields[$key], $value);
        $data[0][$key] = $validate->cleanInput($value);

        // fields that are immune to special character check
        $immuneFields = array("MainCollectiveID", "Email");

        // Check if any other field contains special characters, return the user
        if (!in_array($key, $immuneFields)) {
            $validate->hasNoSpecialChar($fields[$key], $value);
        }

        // Additional validation for specific fields based on type
        switch (true) {
            case ($key == "FName" || $key == "LName"):
                $validate->isLength($fields[$key], $value, 2, 30);
                $validate->hasNoNumbers($fields[$key], $value);
                break;
            case ($key == "Phone"):
                $validate->isLength($fields[$key], $value, 8, 8);
                break;
            case ($key == "Email"):
                $validate->isLength($fields[$key], $value, 5, 255);
                $validate->hasNoNumbers($fields[$key], $value);
                break;
        }
    }

    if (isset($_FILES["ProfilePic"]) && $_FILES["ProfilePic"]["error"] == 0) {
        $file_name = $_FILES["ProfilePic"]["type"];
        $validate->isImage($file_name);
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . PUBLIC_DIR . "/about_me.php?errors=" . $errorsString, true, 303);
        exit;
    }

    $collectiveID = $_POST["MainCollectiveID"];
    $profilePic = '';


    if (isset($_FILES["ProfilePic"]) && $_FILES["ProfilePic"]["error"] == 0) {
        $participant = new Participant();

        if (!empty($participant->getData()->ProfilePic)) {
            $oldProfilePic = ROOT_DIR . "resources/img/participantPics/" . $participant->getData()->ProfilePic;
            unlink($oldProfilePic);
        }

        $target_dir = ROOT_DIR . "resources/img/participantPics/";
        $file_name = basename($_FILES["ProfilePic"]["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $unique_name = updateSelf . phptime() . uniqid(rand());
        $target_file = $target_dir . $unique_name . '.' . $file_type;

        if (in_array($file_type, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff'))) {
            // Load the uploaded image based on the file extension
            switch ($file_type) {
                case 'jpg':
                case 'jpeg':
                    $uploadedImage = imagecreatefromjpeg($_FILES["ProfilePic"]['tmp_name']);
                    break;
                case 'png':
                    $uploadedImage = imagecreatefrompng($_FILES["ProfilePic"]['tmp_name']);
                    break;
                case 'gif':
                    $uploadedImage = imagecreatefromgif($_FILES["ProfilePic"]['tmp_name']);
                    break;
                case 'bmp':
                    $uploadedImage = imagecreatefrombmp($_FILES["ProfilePic"]['tmp_name']); // Requires a separate function for BMP images
                    break;
                case 'webp':
                    $uploadedImage = imagecreatefromwebp($_FILES["ProfilePic"]['tmp_name']);
                    break;
            }

            // Get the original dimensions of the uploaded image
            $originalWidth = imagesx($uploadedImage);
            $originalHeight = imagesy($uploadedImage);

            // Calculate the new dimensions for the 2:3 aspect ratio
            $newWidth = $originalHeight * 2 / 3;
            $newHeight = $originalHeight;

            // Calculate the x-coordinate for cropping
            $cropX = ($originalWidth - $newWidth) / 2;

            // Create a new image with the new dimensions
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

            // Copy and resize the original image to the new image with cropping
            imagecopyresampled($newImage, $uploadedImage, 0, 0, $cropX, 0, $newWidth, $newHeight, $newWidth, $newHeight);

            // Create a new filename for the converted JPEG image
            $newFilename = 'new_filename.jpg'; // Replace 'new_filename' with the desired name for the converted image

            if (imagejpeg($newImage, $target_file)) {
                $profilePic = $unique_name . '.' . $file_type;
                $data[0]["ProfilePic"] = $profilePic;
                // Free up memory by destroying the image resources
                imagedestroy($uploadedImage);
                imagedestroy($newImage);
            } else {
                die('Profile picture upload failed');
            }
        }

        // Update database query
        $participant = new Participant();
        $participCollectives = new ParticipCollectives();
        $participant->update($data);
        $participCollectives->updateParticipantsMainCollective($collectiveID);


        // Going back to front page
        header("Location: " . PUBLIC_DIR . "/index.php");

    } else {
        header("Location: " . PUBLIC_DIR . "/about_me.php");
    }
}