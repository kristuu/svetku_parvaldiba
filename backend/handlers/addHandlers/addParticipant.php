<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST)) {
    // Acquire the data
    $data = array(array(
        'FName' => $_POST["FName"],
        'LName' => $_POST["LName"],
        'PersonCode' => $_POST["PersonCode"],
        'BirthDate' => $_POST["BirthDate"],
        'Phone' => $_POST["Phone"],
        'Email' => $_POST["Email"],
        'Password' => $_POST["Password"],
        'Choreograph' => isset($_POST["Choreograph"]),
        'Organiser' => isset($_POST["Organiser"])
    ));

    foreach ($data[0] as $key => $value) {
        // General validation

        $validate = new Validate();

        // fields that are immune to special character check
        $immuneFields = array("Email", "Password", "Choreograph", "Organiser");

        // Check if any other field contains special characters, return the user
        if (!in_array($key, $immuneFields)) {
            $validate->isEmpty($fields[$key], $value);
            $data[0][$key] = $validate->cleanInput($value);
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
            case ($key == "Password"):
                $validate->isPassword($value);
        }
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/addParticipant.php?errors=" . $errorsString, true, 303);
        exit;
    }

    $data[0]["Password"] = password_hash($_POST["Password"], PASSWORD_DEFAULT);

    // Update database query
    $participant = new Participant();
    $participant->createUser($data);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/participants.php");

}


