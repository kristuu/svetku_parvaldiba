<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'CollectiveName' => $_POST["CollectiveName"],
        'RegionID' => $_POST["RegionID"],
        'CategoryID' => $_POST["CategoryID"],
    ));

    $validate = new Validate();

    foreach ($data[0] as $key => $value) {
        // General validation
        switch (true) {
            case ($key == "CollectiveName"):
                $validate->isEmpty($fields[$key], $value);
                $validate->isLength($fields[$key], $value, 1, 255);
                break;
        }
    }

    if (isset($_FILES["LogoPath"]) && $_FILES["LogoPath"]["error"] == 0) {
        $file_name = $_FILES["LogoPath"]["type"];
        $validate->isImage($file_name);
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/editParticipant.php?id=" . $_POST["ParticipantID"] . "  &errors=" . $errorsString, true, 303);
        exit;
    }

    $collectiveID = $_POST["CollectiveID"];
    $collectiveLogo = '';

    if (isset($_FILES["LogoPath"]) && $_FILES["LogoPath"]["error"] == 0) {
        $collectiveClass = new Collective();
        $collective = $collectiveClass->findCollective($collectiveID);

        if (!empty($collective->LogoPath)) {
            $oldLogo = ROOT_DIR . "resources/img/collectiveLogos/" . $collective->LogoPath;
            unlink($oldLogo);
        }

        $target_dir = ROOT_DIR . "resources/img/collectiveLogos/";
        $file_name = basename($_FILES["LogoPath"]["name"]);
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $unique_name = time() . uniqid(rand());
        $target_file = $target_dir . $unique_name . '.' . $file_type;

        if (in_array($file_type, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff'))) {
            // Load the uploaded image based on the file extension
            switch ($file_type) {
                case 'jpg':
                case 'jpeg':
                    $uploadedImage = imagecreatefromjpeg($_FILES["LogoPath"]['tmp_name']);
                    break;
                case 'png':
                    $uploadedImage = imagecreatefrompng($_FILES["LogoPath"]['tmp_name']);
                    break;
                case 'gif':
                    $uploadedImage = imagecreatefromgif($_FILES["LogoPath"]['tmp_name']);
                    break;
                case 'bmp':
                    $uploadedImage = imagecreatefrombmp($_FILES["LogoPath"]['tmp_name']); // Requires a separate function for BMP images
                    break;
                case 'webp':
                    $uploadedImage = imagecreatefromwebp($_FILES["LogoPath"]['tmp_name']);
                    break;
            }

            // Get the original dimensions of the uploaded image
            $originalWidth = imagesx($uploadedImage);
            $originalHeight = imagesy($uploadedImage);

            // Calculate the new dimensions for the 2:3 aspect ratio
            $newWidth = $originalHeight * 1;
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
                $data[0]["LogoPath"] = $profilePic;
                // Free up memory by destroying the image resources
                imagedestroy($uploadedImage);
                imagedestroy($newImage);
            } else {
                die('Collective logo upload failed');
            }
        }
    }

    // Update database query
    $collectiveClass = new Collective();
    $collective = $collectiveClass->updateCollective($data, $collectiveID);


    // Going back to front page
    $participant = new Participant();
    $participCollectives = new ParticipCollectives();
    $managerCheck = $participCollectives->checkManager($participant->findUser()->ParticipantID, $collectiveID);

    // Check if the user is an administrator
    if ($participant->findUser()->Organiser) {
        header("Location: " . ADMIN_DIR . "/public/collectives.php");
    } elseif ($managerCheck) {
        header("Location: " . PUBLIC_DIR . "/index.php");
    }
}


