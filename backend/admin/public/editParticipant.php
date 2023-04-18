<?php
require_once '../core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
$participant = new Participant();
$participantData = $participant->getUser($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt dalībnieku | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include ROOT_DIR . 'public/header.php' ?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <h1 class="mt-3">Profila datu pārvaldība</h1>
        <form class="w-75" action="../../includes/editParticipant.inc.php" method="POST">
            <div class="my-3 text-start">
                <input name="UserID" hidden value="<?=$participantData->UserID?>"/>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Vārds, uzvārds</strong></span>
                    <input name="FName" type="text" value="<?= $participantData->FName; ?>" class="form-control" placeholder="Visi vārdi, ja ir vairāki"/>
                    <input name="LName" type="text" value="<?= $participantData->LName; ?>" class="form-control" placeholder="Visi uzvārdi, ja ir vairāki"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Personas kods</strong></span>
                    <input name="PersonCode" type="text" value="<?= $participantData->PersonCode; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Dzimšanas datums</strong></span>
                    <input name="BirthDate" type="date" value="<?= $participantData->BirthDate; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Kontaktinformācija</strong></span>
                    <input name="Phone" type="tel" value="<?= $participantData->Phone; ?>" class="form-control"/>
                    <input name="Email" type="email" value="<?= $participantData->Email; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Parole</strong></span>
                    <input name="Password" type="tel" value="<?= $participantData->Password; ?>" class="form-control"/>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="Organiser" <?=$participantData->Organiser ? 'checked' : '';?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Organizators</label>
                </div>
                <button type="submit" name="submitParticipantEdit" class="btn btn-outline-success ms-auto">Saglabāt</button>
            </div>
        </form>
    </div>
</main>
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>