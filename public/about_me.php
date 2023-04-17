<?php
require_once '../backend/core/init.php';
require_once(ROOT_DIR . 'backend/includes/edit_person.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$participant = new Participant();
$participCollectives = new ParticipCollectives();
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
    <link rel="stylesheet" href="../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <h1 class="mt-3">Profila datu pārvaldība</h1>
        <form class="w-75" action="../backend/includes/editSelf.inc.php" method="POST">
            <div class="my-3 text-start">
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Vārds, uzvārds</strong></span>
                    <input id="FName" name="FName" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->FName; ?>" class="form-control" placeholder="Visi vārdi, ja ir vairāki"/>
                    <input id="LName" name="LName" data-bs-toggle="popover" type="text" autocomplete="off" value="<?= $participant->getData()->LName; ?>" class="form-control" placeholder="Visi uzvārdi, ja ir vairāki"/>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Personas kods</strong></span>
                    <span id="PersonCode" data-bs-toggle="popover" tabindex="0" class="form-control">
                        <input disabled type="text" autocomplete="off" value="<?= $participant->getData()->PersonCode; ?>" class="form-control"/>
                    </span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Dzimšanas datums</strong></span>
                    <input id="BirthDate" name="BirthDate" type="date" value="<?= $participant->getData()->BirthDate; ?>" class="form-control"/>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="mainCollectiveInput" style="font-family: var(--font-title);"><strong>Galvenais kolektīvs</strong></label>
                    <select class="form-select" id="mainCollectiveInput" name="MainCollectiveID">
                        <?php
                        $collectives = $participCollectives->getParticipantsCollectives($participant->getData()->ParticipantID);
                        foreach ($collectives as $object) {
                            echo "<option value='$object->CollectiveID' ".($object->MainCollective ? 'selected' : '').">$object->CollectiveName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-family: var(--font-title);"><strong>Kontaktinformācija</strong></span>
                    <input id="Phone" name="Phone" data-bs-toggle="popover" type="tel" autocomplete="off" value="<?= $participant->getData()->Phone; ?>" class="form-control"/>
                    <input id="Email" name="Email" data-bs-toggle="popover" type="email" autocomplete="off" value="<?= $participant->getData()->Email; ?>" class="form-control"/>
                </div>
                <button type="submit" name="submitSelfEdit" class="btn btn-outline-success ms-auto">Saglabāt</button>
            </div>
            <?=$errorHolder?><br>
        </form>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>