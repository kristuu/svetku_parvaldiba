<?php

require_once '../core/init.php';

if (isset($_POST["submitParticipantEdit"])) {
    // Acquire the data
    $data = array(
        'FName' => $_POST["FName"],
        'LName' => $_POST["LName"],
        'PersonCode' => $_POST["PersonCode"],
        'BirthDate' => $_POST["BirthDate"],
        'Phone' => $_POST["Phone"],
        'Email' => $_POST["Email"],
        'Organiser' => isset($_POST["Organiser"])
    );

    $participantID = $_POST["ParticipantID"];

    // Update database query
    $participant = new Participant();
    $participant->update($data, $participantID);


    // Going back to front page
    header("Location: ../admin/participants.php");

} else {
    echo "no post set";
}
