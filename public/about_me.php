<?php
require_once '../backend/core/init.php';
require_once(ROOT_DIR . 'backend/includes/editPerson.inc.php');
require_once(ROOT_DIR . 'backend/includes/restrictionPopovers.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participCollectives = new ParticipCollectives();

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
        <h6 class="border-bottom pb-2 mb-0 fw-bold">PROFILA DATU PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3 text-center">
            <form id="editForm" enctype="multipart/form-data" class="w-75 row g-3 mt-3 mx-auto needs-validation" action="<?=BACKEND_DIR?>/updateHandlers/updateSelf.php" method="POST" novalidate>
                <div class="col-12">
                    <div id="ProfilePhotoContainer" class="w-100">
                        <img <?= is_null($participant->getData()->ProfilePic) ? 'hidden' : ''; ?> id="ProfilePhoto" style="max-height: 200px;" src="<?= PARTICIPIMG_DIR . '/' . $participant->getData()->ProfilePic ?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">FOTO</span>
                        <input id="ProfilePic" name="ProfilePic" type="file" accept="image/*" value="<?= $participant->getData()->FName; ?>" class="form-control font-default"/>
                        <div class="invalid-feedback text-start">
                            Foto ir obligāts!
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">VĀRDS</span>
                        <input id="FName" name="FName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->FName; ?>" class="form-control font-default" placeholder="Visi vārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji vārdu pareizi! (piem., Jānis)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">UZVĀRDS</span>
                        <input id="LName" name="LName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->LName; ?>" class="form-control font-default" placeholder="Visi uzvārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start  font-default">
                            Pārliecinies, vai ievadīji uzvārdu pareizi! (piem., Bērziņš)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="PersonCode" class="input-group has-validation" data-bs-toggle="popover">
                        <span class="input-group-text font-title">PERSONAS KODS</span>
                        <input disabled type="text" tabindex="0" autocomplete="off" value="<?= $participant->getData()->PersonCode; ?>" class="form-control font-default"/>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">DZIMŠANAS DATI</span>
                        <input id="BirthDate" name="BirthDate" type="date" value="<?= $participant->getData()->BirthDate; ?>" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Neeksistējošs datums
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">TĀLRUNIS</span>
                        <input id="Phone" name="Phone" minlength="8" maxlength="8" data-bs-toggle="popover" type="tel" autocomplete="off" value="<?= $participant->getData()->Phone; ?>" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Pārliecinies, vai ievadīji telefona numuru pareizi! (piem., 21234567)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">E-PASTS</span>
                        <input id="Email" name="Email" minlength="5" maxlength="255" data-bs-toggle="popover" type="email" autocomplete="off" value="<?= $participant->getData()->Email; ?>" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Pārliecinies, vai ievadīji e-pastu pareizi! (piem., janis.berzins@gmail.com)
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="input-group has-validation">
                        <label class="input-group-text font-title" for="mainCollectiveInput">GALVENAIS KOLEKTĪVS</label>
                        <select class="form-select font-default" id="mainCollectiveInput" name="MainCollectiveID">
                            <?php
                            $collectives = $participCollectives->getParticipantsCollectives($participant->getData()->ParticipantID);
                            foreach ($collectives as $object) {
                                echo "<option class='font-default' value='$object->CollectiveID' ".($object->MainCollective ? 'selected' : '').">$object->CollectiveName</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" name="submitSelfEdit" class="btn btn-outline-success w-100  font-title">SAGLABĀT</button>
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
<?php include ROOT_DIR . 'backend/includes/editFormScripts.php'; ?>
</body>
</html>