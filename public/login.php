<?php
require_once '../backend/core/init.php';

if(isset($_SESSION["user_id"])) {
    header("Location: ". PUBLIC_DIR ."/index.php");
}

if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case "emptyinput":
            $errorMessage = "Lūdzu, aizpildiet visus laukus!";
            break;
        case "wrongpassword":
            $errorMessage =  "Nepareizs e-pasts vai parole!";
            break;
        case "usernotfound":
            $errorMessage = "Lietotājs nav atrasts!";
            break;
        default:
            $errorMessage = "Neatpazīta kļūda!";
    }
}

if(isset($errorMessage)) {
    $errorHolder = "<p class='error'>KĻŪDA » " . $errorMessage ?? "</p>";
} else {
    $errorHolder = "";
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizācija | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/universal.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<body style="padding: 0;">
<header>
    <div class="p-3 text-bg-dark">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <span class="align-self-start"><strong>AUTORIZĀCIJA</strong></span>
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <span>SEKO MUMS: | A | B | C |</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="div-logo text-center">
    <img class="logo-gars img-fluid mx-auto" src="../resources/img/logo-rinda.svg"/>
    <img class="logo-iss img-fluid mx-auto" src="../resources/img/logo-kompakts.svg"/>
</div>
<div id="login-section" class="container-fluid">
    <div class="login-div m-auto">
        <form action="../backend/loginHandler.php" method="POST">
            <div id="login-block" class="d-flex flex-column align-items-center">
                <img class="login-symbol" src="../resources/img/logo-simbols.svg">
                <div class="div-input d-flex flex-column">
                    <input name="email" type="tel" required>
                    <label for="email">E-pasts</label>
                </div>
                <div class="div-input d-flex flex-column">
                    <input name="password" type="password"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,24}$" required>
                    <label for="password">Parole</label>
                    <?=$errorHolder?>
                    <p>* Šī ir iepriekšēji reģistrētu personu autorizācijas sistēma.<br>Ja esi svētku dalībnieks, taču
                        neesi saņēmis piekļuves datus, sazinies ar sava mākslas kolektīva vadītāju.</p>
                </div>
                <div class="div-btm d-flex justify-content-between">
                    <div class="div-forgotpass mt-auto mb-auto">
                        <a href="#" tabindex="0" class="btn" role="button" data-bs-toggle="popover"
                           data-bs-trigger="focus"
                           data-bs-content="Ja esi aizmirsis paroli, pēc iespējas ātrāk informē mākslas kolektīva vadītāju">Aizmirsu
                            paroli</a>
                    </div>
                    <div class="div-buttons">
                        <button class="btn btn-outline-success" type="submit" name="submit"
                                style="border-radius: 30px; --bs-btn-padding-x: 2rem">
                            IEIET
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
</body>
</html>
