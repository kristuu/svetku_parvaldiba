<?php
require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editFields.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$rehearsalsClass = new Rehearsals();
$thisRehearsal = $rehearsalsClass->findRehearsal($_GET['id']);
$dancesClass = new Dances();
$allDances = $dancesClass->getAllDances();
$allChoreographs = $participant->getAllChoreographs();

// Check if the user is an administrator
if (!$participant->findUser()->Organiser) {
    header("Location: ". PUBLIC_DIR ."/index.php");
}

if (isset($_GET['errors'])) {
    $errors = urldecode($_GET['errors']);
    parse_str($errors, $errorsArray);
}
?>

<!DOCTYPE html>
<html lang="lv">
<?php include ROOT_DIR . '/backend/includes/head.inc.php'; ?>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php' ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">MĒĢINĀJUMA PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3 text-center">
            <form class="w-75 row g-3 mt-3 mx-auto needs-validation" action="<?=BACKEND_DIR?>/handlers/updateHandlers/updateRehearsal.php" method="POST" novalidate>
                <input hidden name="RehearsalID" value="<?=$thisRehearsal->RehearsalID?>"/>
                <div class="col-lg-12">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">APRAKSTS</span>
                        <textarea id="RehearsalDesc" name="RehearsalDesc" minlength="1" maxlength="65535" type="text" autocomplete="off" class="form-control font-default" placeholder="Mēģinājuma apraksts"><?=$thisRehearsal->RehearsalDesc?></textarea>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji nosaukumu pareizi! (min garums 1, max garums 65535)
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">SĀKUMA LAIKS</span>
                        <input id="StartTime" name="StartTime" type="datetime-local" autocomplete="off" value='<?=$thisRehearsal->StartTime?>' class="form-control font-default" placeholder="Sākuma laiks">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">BEIGU LAIKS</span>
                        <input id="EndTime" name="EndTime" type="datetime-local" autocomplete="off" value='<?=$thisRehearsal->EndTime?>' class="form-control font-default" placeholder="Beigu laiks">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group has-validation">
                        <label class="input-group-text font-title" for="DanceID">DEJA</label>
                        <select class="form-select font-default" id="DanceID" name="DanceID">
                            <?php
                            echo "<option></option>";
                            foreach ($allDances as $dance) {
                                echo "<option class='font-default' value='$dance->DanceID' " . ($dance->DanceID === $thisRehearsal->DanceID ? "selected" : "") . ">$dance->DanceName</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group has-validation">
                        <label class="input-group-text font-title" for="ChoreographID">HOREOGRĀFS</label>
                        <select class="form-select font-default" id="ChoreographID" name="ChoreographID">
                            <?php
                            echo "<option></option>";
                            foreach ($allChoreographs as $choreograph) {
                                echo "<option class='font-default' value='$choreograph->ParticipantID' " . ($choreograph->ParticipantID === $thisRehearsal->ChoreographID ? "selected" : "") . ">$choreograph->FName $choreograph->LName - $choreograph->PersonCode</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button type="submit" name="submitEdit" class="btn btn-outline-success w-100 font-title">SAGLABĀT</button>
                </div>
                <div class="col-lg-12 text-start">
                    <?php
                    if (isset($errorsArray)) {
                        echo "<p class='error font-title'>KĻŪDAS:</p>";
                        foreach ($errorsArray as $error) {
                            echo "<p class='error ps-3 font-title'>• $error</p>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php include ROOT_DIR . 'backend/includes/editFormScripts.php'; ?>
</body>
</html>