<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST)) {
    // Acquire the data
    $data = array(array(
        'RehearsalID' => $_POST["RehearsalID"],
        'CategoryID' => $_POST["CategoryID"]
    ));

    // Update database query
    $colrehClass = new CollectivesRehearsals();
    $colrehClass->createConnection($data);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/collectivesRehearsals.php");


}


