<?php
require_once '../../core/init.php';
require_once(ROOT_DIR . 'backend/includes/editPerson.inc.php');
require_once(ROOT_DIR . 'backend/includes/restrictionPopovers.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();

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
        <h6 class="border-bottom pb-2 mb-0 fw-bold">JAUNA DALĪBNIEKA PIEVIENOŠANAS PANELIS</h6>
        <div class="my-3 text-center">
            <form class="w-75 row g-3 mt-3 mx-auto needs-validation" action="<?=BACKEND_DIR?>/handlers/addHandlers/addParticipant.php" method="POST" novalidate>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">VĀRDS</span>
                        <input id="FName" name="FName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="" class="form-control font-default" placeholder="Visi vārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji vārdu pareizi! (piem., Jānis)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">UZVĀRDS</span>
                        <input id="LName" name="LName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="" class="form-control font-default" placeholder="Visi uzvārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start  font-default">
                            Pārliecinies, vai ievadīji uzvārdu pareizi! (piem., Bērziņš)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">PERSONAS KODS</span>
                        <input id="PersonCode" name="PersonCode" type="text" placeholder="11019145678" data-bs-toggle="popover" tabindex="0" autocomplete="off" value="" class="form-control font-default"/>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">DZIMŠANAS DATI</span>
                        <input id="BirthDate" name="BirthDate" type="date" value="" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Neeksistējošs datums
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">TĀLRUNIS</span>
                        <input id="Phone" name="Phone" minlength="8" maxlength="8" placeholder="23456789" data-bs-toggle="popover" type="tel" autocomplete="off" value="" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Pārliecinies, vai ievadīji telefona numuru pareizi! (piem., 21234567)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">E-PASTS</span>
                        <input id="Email" name="Email" minlength="5" maxlength="255" placeholder="janis@inbox.lv" data-bs-toggle="popover" type="email" autocomplete="off" value="" class="form-control font-default" required/>
                        <div class="invalid-feedback text-start font-default">
                            Pārliecinies, vai ievadīji e-pastu pareizi! (piem., janis.berzins@gmail.com)
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="input-group has-validation">
                        <span class="input-group-text font-title">PAROLE</span>
                        <input id="Password" name="Password" minlength="8" maxlength="24" data-bs-toggle="popover" type="password" autocomplete="new-password" class="form-control font-default" required/>
                    </div>
                </div>
                <div class="col-lg-4 font-title">
                    <input name="Organiser" type="checkbox" class="btn-check" id="organiser-check" autocomplete="off">
                    <label class="btn btn-outline-danger w-100" for="organiser-check">ORGANIZATORS</label>
                </div>
                <div class="col-lg-12">
                    <button type="submit" name="submitAdd" class="btn btn-outline-success w-100  font-title">SAGLABĀT</button>
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