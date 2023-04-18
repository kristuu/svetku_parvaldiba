<?php
require_once '../backend/core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participCollectives = new ParticipCollectives();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container row g-3 m-auto">
    <div class="col-12 bg-white rounded d-flex flex-column align-items-center text-center">
        <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
        <div class="my-3 w-75 text-start">
            <h1 style="font-family: var(--font-default);">Esi piekļuvis sistēmai kā <?=$participant->getData()->FName . ' ' . $participant->getData()->LName?></h1>
            <h3>Piesaistītie kolektīvi:</h3>
            <ul class="list-group list-group-flush" style="font-family: var(--font-default);">
                <?php
                $collectives = $participCollectives->getParticipantsCollectives($participant->getData()->ParticipantID);
                foreach ($collectives as $collective) {
                    // echo collective name and if it is main collective, then add "GALVENAIS" to it
                    echo "<li class='list-group-item'>{$collective->CollectiveName}" . ($collective->MainCollective ? " | <strong>GALVENAIS</strong>" : "") . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
