<?php
require_once '../backend/core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$participant = new Participant();
$rulesAgreement = $participant->getData()->RulesAgreement;
$dataAgreement = $participant->getData()->DataAgreement;
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piekrišana | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <div class="div-logo m-auto">
            <img class="logo-gars img-fluid" src="../resources/img/logo-rinda.svg"/>
            <img class="logo-iss img-fluid" src="../resources/img/logo-kompakts.svg"/>
        </div>
        <div class="my-3 w-75 text-start">
            <h1 class="text-center">Drošas un patīkamas svētku norises nodrošināšanas nolūkos mums ir nepieciešama Tava piekrišana!</h1>
            <form class="needs-validation row mt-5 mb-4 gy-4 ms-auto me-auto" method="POST" action="<?=BACKEND_DIR?>/includes/updateAgreement.inc.php" novalidate>
                <div class="form-check">
                    <h3 class="mb-3">Apliecinājums par kārtības noteikumiem</h3>
                    <input type="checkbox" class="form-check-input" name="rulesAgreement" id="rulesAgreement" <?=$rulesAgreement ? 'checked' : '';?> required>
                    <label class="form-check-label" style="font-family: var(--font-default);" for="rulesAgreement">Esmu iepazinies (-usies) ar <a href="#" target="_blank">kārtības noteikumiem</a> un piekrītu tiem</label>
                    <div class="invalid-feedback" style="font-family: var(--font-default);">Nepieciešams piekrist kārtības noteikumiem</div>
                </div>
                <div class="form-check">
                    <h3 class="mb-3">Apliecinājums par personas datu uzglabāšanu un lietošanu</h3>
                    <input type="checkbox" class="form-check-input" name="dataAgreement" id="dataAgreement" <?=$dataAgreement ? 'checked' : '';?> required>
                    <label class="form-check-label" style="font-family: var(--font-default);" for="dataAgreement">Esmu iepazinies (-usies) ar <a href="#" target="_blank">datu apstrādes noteikumiem</a> un piekrītu tiem</label>
                    <div class="invalid-feedback" style="font-family: var(--font-default);">Nepieciešams piekrist datu apstrādes noteikumiem</div>
                </div>
                <div class="col-1">
                    <button name="submitAgreement" class="btn btn-outline-success" type="submit">Saglabāt</button>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="<?=ORIGIN_DIR?>/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
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
</body>
</html>
