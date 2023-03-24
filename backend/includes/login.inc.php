<?php

if (isset($_POST["submit"])) {
    // Acquire the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate LoginContr class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($email, $password);

    // Running error handlers and user login
    $login->loginUser();

    // Going back to front page
    header("Location: ../../public/index.php?error=none");

} else {
    echo "no post set";
}