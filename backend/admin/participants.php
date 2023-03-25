<?php
require_once '../core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
if (!$_SESSION["Organiser"]) {
    header("Location: ../../public/index.php");
}
$participant = new Participant();
$participants = $participant->getAllUsers();
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani dati | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="hhttps://raw.githubusercontent.com/ColorlibHQ/AdminLTE/master/dist/css/adminlte.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../public/header.php'?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <h1 class="mt-3">Profila datu pārvaldība</h1>
        <form class="w-75" action="../includes/editSelf.inc.php" method="POST">
            <div class="my-3 text-start">
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Vārds, uzvārds</strong></span>
                    <input name="FName" type="text" value="<?= $participant->getData()->FName; ?>" class="form-control" placeholder="Visi vārdi, ja ir vairāki"/>
                    <input name="LName" type="text" value="<?= $participant->getData()->LName; ?>" class="form-control" placeholder="Visi uzvārdi, ja ir vairāki"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Personas kods</strong></span>
                    <input disabled type="text" value="<?= $participant->getData()->PersonCode; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Dzimšanas datums</strong></span>
                    <input name="BirthDate" type="date" value="<?= $participant->getData()->BirthDate; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="mainCollectiveInput" style="font-family: var(--font-title);"><strong>Galvenais kolektīvs</strong></label>
                    <select class="form-select" id="mainCollectiveInput" name="MainCollectiveID">
                        <?php
                        $collectives = $participCollectives->getParticipantsCollectives($_SESSION["user_id"]);
                        foreach ($collectives as $object) {
                            echo "<option value='$object->CollectiveID' ".($object->MainCollective ? 'selected' : '').">$object->CollectiveName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Kontaktinformācija</strong></span>
                    <input name="Phone" type="tel" value="<?= $participant->getData()->Phone; ?>" class="form-control"/>
                    <input name="Email" type="email" value="<?= $participant->getData()->Email; ?>" class="form-control"/>
                </div>
                <button type="submit" name="submitSelfEdit" class="btn btn-outline-success ms-auto">Saglabāt</button>
            </div>
        </form>
    </div>
</main>
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://raw.githubusercontent.com/ColorlibHQ/AdminLTE/master/dist/js/adminlte.min.js"></script>
</body>
</html>