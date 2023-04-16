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
        if ($validate->isEmpty($value)) {
            header("Location: ". PUBLIC_DIR ."/about_me.php?error=emptyfields");
            exit();
        }
        $data[0][$key] = $validate->cleanInput($value);
        $immuneFields = array("MainCollectiveID", "Email");
        if (!in_array($key, $immuneFields) && $validate->hasSpecialChar($value)) {
            header("Location: ". PUBLIC_DIR ."/about_me.php?error=unallowedchar");
            exit();
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