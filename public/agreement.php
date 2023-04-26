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
<?php include ROOT_DIR . 'backend/includes/head.inc.php'; ?>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php' ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">Drošas un patīkamas svētku norises nodrošināšanas nolūkos mums ir nepieciešama Tava piekrišana:</h6>
        <div class="w-75 mx-auto">
            <form class="needs-validation row mt-3 mb-4 gy-4 ms-auto me-auto" method="POST" action="<?=BACKEND_DIR?>/handlers/updateHandlers/updateAgreement.php" novalidate>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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
</body>
</html>
