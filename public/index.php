<?php
require_once '../backend/core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participantID = $participant->getData()->ParticipantID;
$participCollectives = new ParticipCollectives();
$pCollectiveList = $participCollectives->getParticipantsCollectives($participantID);
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
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/offcanvas-navbar.css"/>
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/universal.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <div class="my-3 w-75 m-auto">
            <h1 class="text-center pb-5">Esi piekļuvis sistēmai kā <?=$participant->getData()->FName . ' ' . $participant->getData()->LName?></h1>
            <h3>Piesaistītie kolektīvi:</h3>
            <div class="container-fluid">
                <?php
                foreach ($pCollectiveList as $collective) {
                    // echo collective name and if it is main collective, then add "GALVENAIS" to it
                    echo "<div class='row justify-content-between align-items-center'>";
                    echo "<div class='col-8 col-lg-10'>{$collective->CollectiveName}" . ($collective->MainCollective ? " | <strong>GALVENAIS</strong>" : "") . "</div>";
                    echo $collective->Manager ? "<div class='col-4 col-lg-2'><button class='btn btn-outline-success w-100'>Pārvaldīt</button></div>" : "";
                    echo "<div class='col-12'><hr/></div>";
                }
                ?>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    (() => {
        'use strict'

        document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
            document.querySelector('.offcanvas-collapse').classList.toggle('open')
        })
    })()
</script>
</body>
</html>
