<?php
require_once '../../core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$categorytypes = new Categorytypes();

// Check if the user is an administrator
if (!$participant->findUser()->Organiser) {
    header("Location: ". PUBLIC_DIR ."/index.php");
}

$categorytypes->deleteType($_GET["id"]);
header("Location: ". ADMIN_DIR ."/public/categorytypes.php");

?>