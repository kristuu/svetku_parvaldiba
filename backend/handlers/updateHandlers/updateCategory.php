<?php

require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (isset($_POST["submitEdit"])) {
    // Acquire the data
    $data = array(array(
        'CategoryName' => $_POST["CategoryName"],
        'TypeID' => $_POST["TypeID"],
    ));

    $validate = new Validate();

    foreach ($data[0] as $key => $value) {
        if ($key !== "TypeID") {
            // General validation

            $validate->isEmpty($fields[$key], $value);
            $data[0][$key] = $validate->cleanInput($value);
        }

        // Additional validation for specific fields based on type
        switch (true) {
            case ($key == "CategoryName"):
                $validate->isLength($fields[$key], $value, 1, 30);
                break;
        }
    }

    if ($validate->getErrors()) {
        $errorsString = urlencode(http_build_query($validate->getErrors()));
        header("Location: " . ADMIN_DIR . "/public/editCategory.php?id=" . $_POST["CategoryID"] . "  &errors=" . $errorsString, true, 303);
        exit;
    }

    // Update database query
    $category = new Category();
    $category->updateCategory($data, $_POST["CategoryID"]);


    // Going back to front page
    header("Location: " . ADMIN_DIR . "/public/categories.php");

}


