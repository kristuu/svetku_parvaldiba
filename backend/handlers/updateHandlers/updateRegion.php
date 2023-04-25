<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'RegionName' => $_POST["RegionName"],
    ));

    $validate = new Validate();

    foreach ($data[0] as $key => $value) {
        $validate->isEmpty($fields[$key], $value);
        $data[0][$key] = $validate->cleanInput($value);
        $validate->isLength($fields[$key], $value, 1, 30);
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/editCategory.php?id=" . $_POST["CategoryID"] . "  &errors=" . $errorsString, true, 303);
        exit;
    }

    // Update database query
    $region = new Region();
    $region->updateRegion($data, $_POST["RegionID"]);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/regions.php");

}


