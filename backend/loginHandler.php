<?php

require_once 'core/init.php';

if (isset($_SESSION["user_id"])) {
    header("Location: " . PUBLIC_DIR . "public/index.php");
}

if (isset($_POST["submit"])) {
    // Acquire the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate LoginContr class
    include "classes/Dbh.php";
    include "classes/Login.php";
    include "controllers/login-contr.classes.php";
    $login = new LoginContr($email, $password);

    // Running error handlers and user login
    $login->loginUser();

    // Going back to front page
    header("Location: ../../public/index.php");

} else {
    echo "no post set";
}