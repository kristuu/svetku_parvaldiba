<?php

require_once '../core/init.php';

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'ParticipantID' => $_POST["ParticipantID"],
        'FName' => $_POST["FName"],
        'LName' => $_POST["LName"],
        'PersonCode' => $_POST["PersonCode"],
        'BirthDate' => $_POST["BirthDate"],
        'Phone' => $_POST["Phone"],
        'Email' => $_POST["Email"],
        'Organiser' => isset($_POST["Organiser"])
    ));

    // Update database query
    $participant = new Participant();
    $participant->update($data, $participantID);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/participants.php");

}


