<?php

require_once '../core/init.php';

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
        // Check if any field is empty, return the user
        if ($validate->isEmpty($value)) {
            header("Location: ". PUBLIC_DIR ."/about_me.php?error=emptyfields");
            exit();
        }
        // clean the input data
        $data[0][$key] = $validate->cleanInput($value);
        // fields that are immune to special character check
        $immuneFields = array("MainCollectiveID", "Email");
        // Check if any other field contains special characters, return the user
        if (!in_array($key, $immuneFields) && $validate->hasSpecialChar($value)) {
            header("Location: ". PUBLIC_DIR ."/about_me.php?error=unallowedchar");
            exit();
        }
        // Check the length of fields
        switch ($key) {
            case ("FName" || "LName"):
                if (!$validate->isLength($key, $value, 2, 30)) {
                    $validate->redirect("about_me", "length", $key);
                }
                break;
        }
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