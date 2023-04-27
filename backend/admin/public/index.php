<?php
require_once '../../core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participantID = $participant->getData()->ParticipantID;

// Check if the user is an administrator
if (!$participant->getData()->Organiser) {
    header("Location: ". PUBLIC_DIR ."/index.php");
}

$participCollectives = new ParticipCollectives();
$pCollectiveList = $participCollectives->getParticipantsCollectives($participantID);
?>

<!DOCTYPE html>
<html lang="lv">
<?php include ROOT_DIR . '/backend/includes/head.inc.php'; ?>
<head>
    <style>
        .card {
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .btn {
            align-self: end;
            margin-top: auto !important;
        }
    </style>
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">Pārvaldība:</h6>
        <div class="row g-3 mx-auto mt-auto">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kolektīvi</h5>
                        <p class="card-text">Sistēmā ievadītie kolektīvi</p>
                        <a href="collectives.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dalībnieki</h5>
                        <p class="card-text">Sistēmā ievadītie dalībnieki</p>
                        <a href="participants.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategorijas</h5>
                        <p class="card-text">Kolektīviem atbilstošās kategorijas</p>
                        <a href="categories.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tipi</h5>
                        <p class="card-text">Kategorijas iedalošie tipi</p>
                        <a href="categorytypes.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reģioni</h5>
                        <p class="card-text">Kolektīviem atbilstošie reģioni</p>
                        <a href="regions.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dalībnieki - Kolektīvi</h5>
                        <p class="card-text">Dalībnieku saistījums ar kolektīviem</p>
                        <a href="participCollectives.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dejas</h5>
                        <p class="card-text">Eksistējošās & mēģinājumiem piesaistāmās dejas</p>
                        <a href="dances.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mēģinājumi</h5>
                        <p class="card-text">Eksistējošie mēģinājumi</p>
                        <a href="rehearsals.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kolektīvu kategorijas - mēģinājumi</h5>
                        <p class="card-text">Kolektīvu (pēc to kategorijām) saistījums ar mēģinājumiem</p>
                        <a href="collectivesRehearsals.php" class="btn btn-outline-success font-title">PĀRVALDĪT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

</html>
