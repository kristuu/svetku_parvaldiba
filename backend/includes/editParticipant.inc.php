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

    $userID = $_POST["UserID"];

    // Update database query
    $participant = new Participant();
    $participant->update($data, $userID);


    // Going back to front page
    header("Location: ../admin/participants.php");

} else {
    echo "no post set";
}
