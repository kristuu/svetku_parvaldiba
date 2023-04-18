<?php
require_once '../backend/core/init.php';
require_once(ROOT_DIR . 'backend/includes/editPerson.inc.php');

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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mani dati | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/universal.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php' ?>
<main class="container w-50">
    <div class="container row g-3 m-auto">
        <div class="col-12 bg-white rounded pt-3 pb-4 d-flex flex-column align-items-center text-center">
            <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
            <h1 class="w-75 mt-3">PROFILA DATU PĀRVALDĪBAS PANELIS</h1>
            <form class="w-75 row g-3 mt-3 needs-validation" action="<?=BACKEND_DIR?>/includes/editSelf.inc.php" method="POST" novalidate>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" style="font-family: var(--font-title);">VĀRDS</span>
                        <input id="FName" name="FName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->FName; ?>" class="form-control" placeholder="Visi vārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji vārdu pareizi! (piem., Jānis)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" style="font-family: var(--font-title);">UZVĀRDS</span>
                        <input id="LName" name="LName" minlength="2" maxlength="30" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->LName; ?>" class="form-control" placeholder="Visi uzvārdi, ja ir vairāki" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji uzvārdu pareizi! (piem., Bērziņš)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="PersonCode" class="input-group has-validation" data-bs-toggle="popover">
                        <span class="input-group-text" style="font-family: var(--font-title);">PERSONAS KODS</span>
                        <input disabled type="text" tabindex="0" autocomplete="off" value="<?= $participant->getData()->PersonCode; ?>" class="form-control"/>
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" style="font-family: var(--font-title);">DZIMŠANAS DATI</span>
                        <input id="BirthDate" name="BirthDate" type="date" value="<?= $participant->getData()->BirthDate; ?>" class="form-control" required/>
                        <div class="invalid-feedback text-start">
                            Neeksistējošs datums
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" style="font-family: var(--font-title);">TĀLRUNIS</span>
                        <input id="Phone" name="Phone" minlength="8" maxlength="8" data-bs-toggle="popover" type="tel" autocomplete="off" value="<?= $participant->getData()->Phone; ?>" class="form-control" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji telefona numuru pareizi! (piem., 21234567)
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group has-validation">
                        <span class="input-group-text" style="font-family: var(--font-title);">E-PASTS</span>
                        <input id="Email" name="Email" minlength="5" maxlength="255" data-bs-toggle="popover" type="email" autocomplete="off" value="<?= $participant->getData()->Email; ?>" class="form-control" required/>
                        <div class="invalid-feedback text-start">
                            Pārliecinies, vai ievadīji e-pastu pareizi! (piem., janis.berzins@gmail.com)
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="input-group has-validation">
                        <label class="input-group-text" for="mainCollectiveInput" style="font-family: var(--font-title);">GALVENAIS KOLEKTĪVS</label>
                        <select class="form-select" id="mainCollectiveInput" name="MainCollectiveID">
                            <?php
                            $collectives = $participCollectives->getParticipantsCollectives($participant->getData()->ParticipantID);
                            foreach ($collectives as $object) {
                                echo "<option value='$object->CollectiveID' ".($object->MainCollective ? 'selected' : '').">$object->CollectiveName</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" name="submitSelfEdit" class="btn btn-outline-success w-100">Saglabāt</button>
                </div>
                <div class="col-lg-12 text-start">
                    <?php
                    if (isset($errorsArray)) {
                        echo "<p class='error'>KĻŪDAS:</p>";
                        foreach ($errorsArray as $error) {
                            echo "<p class='error ps-3'>• $error</p>";
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    const popovers = <?=json_encode($restrictionPopovers)?>;
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    popoverTriggerList.forEach((inputField) => {
        if (inputField.id !== "PersonCode") {
            inputField.setAttribute("data-bs-trigger", popovers["TriggerType"]);
        } else {
            inputField.setAttribute("data-bs-trigger", "hover focus");
        }
        inputField.setAttribute("data-bs-title", popovers["Title"]);
        inputField.setAttribute("data-bs-content", popovers[inputField.id]);
        inputField.setAttribute("data-bs-html", "true");
    });
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<script>
    // disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<script>
    function addInputGroupClass() {
        const screenWidth = window.innerWidth;
        const inputGroups = document.querySelectorAll('.input-group');
        const buttons = document.querySelectorAll('.btn');

        if (screenWidth < 1200) {
            inputGroups.forEach((inputGroup) => {
                inputGroup.classList.add('input-group-sm');
            });
            buttons.forEach((button) => {
                button.classList.add('btn-sm');
            });
        } else {
            inputGroups.forEach((inputGroup) => {
                inputGroup.classList.remove('input-group-sm');
            });
            buttons.forEach((button) => {
                button.classList.remove('btn-sm');
            });
        }
    }

    window.addEventListener('resize', addInputGroupClass);

    // Call addInputGroupClass on page load to apply the class initially
    addInputGroupClass();
</script>
</body>
</html>