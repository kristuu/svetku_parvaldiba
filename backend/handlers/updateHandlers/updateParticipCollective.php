<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'ParticipantID' => $_POST["ParticipantID"],
        'CollectiveID' => $_POST["CollectiveID"],
        'Manager' => isset($_POST["Manager"]),
    ));

    // Update database query
    $participCollectives = new ParticipCollectives();
    $participCollectives->updateParticipCollective($data, $_POST["ID"]);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/participCollectives.php");


}


