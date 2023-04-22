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
            default:
        }
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: ". PUBLIC_DIR ."/about_me.php?errors=".$errorsString, true, 303);
        exit;
    }

    $collectiveID = $_POST["MainCollectiveID"];

    // Update database query
    $participant = new Participant();
    $participCollectives = new ParticipCollectives();
    $participant->update($data);
    $participCollectives->updateParticipantsMainCollective($collectiveID);


    // Going back to front page
    header("Location: ". PUBLIC_DIR ."/index.php");

} else {
    header("Location: ". PUBLIC_DIR ."/about_me.php");
}