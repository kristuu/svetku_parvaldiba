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
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/universal.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">Tavi kolektīvi:</h6>
        <?php foreach($pCollectiveList as $collective):
            $cParticipants = $participCollectives->getCollectiveParticipants($collective->CollectiveID);
        ?>
        <div class="d-flex text-body-secondary pt-3">
            <img class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" role="img"/>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark"><?=$collective->CollectiveName?></strong>
                        <?=($collective->Manager) ? '<a href="#">Pārvaldīt</a>' : ''?>
                    </div>
                    <span class="d-block">
                        Kolektīva vadītājs:
                        <?php foreach($cParticipants as $cParticipant):
                            if ($cParticipant->Manager):
                                echo $cParticipant->FName . ' ' . $cParticipant->LName;
                            endif;
                        endforeach; ?>
                    </span>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
