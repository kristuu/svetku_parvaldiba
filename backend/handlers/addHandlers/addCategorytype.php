<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST)) {
    // Acquire the data
    $data = array(array(
        'TypeName' => $_POST["TypeName"],
    ));

    $validate = new Validate();

    $validate = new Validate();

    foreach ($data[0] as $key => $value) {
        // General validation

        $validate->isEmpty($fields[$key], $value);
        $data[0][$key] = $validate->cleanInput($value);

        // Additional validation for specific fields based on type
        switch ($key) {
            case "TypeName":
                $validate->isLength($fields[$key], $value, 1, 255);
                break;
        }
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/addCategorytype.php?errors=" . $errorsString, true, 303);
        exit;
    }

    // Update database query
    $categorytypes = new Categorytypes();
    $categorytypes->createType($data);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/categorytypes.php");


}


