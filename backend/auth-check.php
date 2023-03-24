<?php
session_start();
if (!($_SESSION["isLoggedIn"])) {
    header("Location: ../public/login.php");
    exit();
}