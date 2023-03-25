<?php
require_once '../backend/core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
$user = new Participant();
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pārvaldības sistēma | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <div class="div-logo m-auto">
            <img class="logo-gars img-fluid" src="../resources/img/logo-rinda.svg"/>
            <img class="logo-iss img-fluid" src="../resources/img/logo-kompakts.svg"/>
        </div>
        <div class="my-3 w-75 text-start">
            <h1 style="font-family: var(--font-default);">Esi piekļuvis sistēmai kā <?=$user->getData()->FName . ' ' . $user->getData()->LName?></h1>
            <h3>Piesaistītie kolektīvi:</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><?= ?></li>
            </ul>
        </div>
    </div>
</main>
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
