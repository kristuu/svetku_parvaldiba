<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'DanceName' => $_POST["DanceName"],
    ));

    $validate = new Validate();

    foreach ($data[0] as $key => $value) {
        // General validation

        $validate->isEmpty($fields[$key], $value);
        $data[0][$key] = $validate->cleanInput($value);

        // Additional validation for specific fields based on type
        switch ($key) {
            case "DanceName":
                $validate->isLength($fields[$key], $value, 1, 255);
                break;
        }
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/editDance.php?id=" . $_POST["DanceID"] . "  &errors=" . $errorsString, true, 303);
        exit;
    }

    // Update database query
    $dancesClass = new Dances();
    $dancesClass->updateDance($data, $_POST["DanceID"]);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/dances.php");

}


