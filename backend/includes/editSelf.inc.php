<?php

require_once '../core/init.php';

if (isset($_POST["submitSelfEdit"])) {
    // Acquire the data
    $data = array(
        'FName' => $_POST["FName"],
        'LName' => $_POST["LName"],
        'BirthDate' => $_POST["BirthDate"],
        'Phone' => $_POST["Phone"],
        'Email' => $_POST["Email"]
    );

    $collectiveID = $_POST["MainCollectiveID"];

    // Update database query
    $participant = new Participant();
    $participCollectives = new ParticipCollectives();
    $participant->update($data);
    $participCollectives->updateParticipantsMainCollective($collectiveID);


    // Going back to front page
    header("Location: ../../public/index.php");

} else {
    echo "no post set";
}