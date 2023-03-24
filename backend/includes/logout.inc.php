<?php
session_start();
session_unset();
session_destroy();

// Going back to the login page
header("Location: ../../public/login.php");