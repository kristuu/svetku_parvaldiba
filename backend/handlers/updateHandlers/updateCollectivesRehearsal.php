<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'RehearsalID' => $_POST["RehearsalID"],
        'CategoryID' => $_POST["CategoryID"]
    ));

    // Update database query
    $colrehClass = new CollectivesRehearsals();
    $colrehClass->updateConnection($data, $_POST["colrehID"]);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/collectivesRehearsals.php");

}


