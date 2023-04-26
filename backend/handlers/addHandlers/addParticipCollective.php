<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST)) {
    // Acquire the data
    $data = array(array(
        'ParticipantID' => $_POST["ParticipantID"],
        'CollectiveID' => $_POST["CollectiveID"],
        'Manager' => isset($_POST["Manager"]),
    ));

    // Update database query
    $participCollectives = new ParticipCollectives();
    $participCollectives->createParticipCollective($data);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/participCollectives.php");


}


