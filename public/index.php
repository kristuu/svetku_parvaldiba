<?php
include '../backend/auth-check.php';
include '../backend/classes/participant.classes.php';
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pārvaldības sistēma | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/universal.css"/>
    <link href="../node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="p-3 text-bg-dark">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="align-self-start">
                    <img src="../resources/img/account.svg" height="32px">
                    <span class="align-self-start align-middle"
                          style="font-family: 'Work Sans'"><strong><?= $_SESSION["usersfname"] ?></strong>
                        <?php
                        if ($_SESSION["Organiser"]) {
                            echo " | Svētku organizators";
                        } else {
                            echo " | Svētku dalībnieks";
                        }
                        ?>
                    </span>
                </div>
                <img src="../resources/img/logo-simbols.svg" height="32px">
                <div class="d-flex flex-wrap align-items-center justify-content-center">
                    <a href="../backend/includes/logout.inc.php">
                        <img class="align-self-start" src="../resources/img/sign_out.svg" height="32px">
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<section id="main-menu" class="d-flex flex-column justify-content-center">
    <nav class="btn-toolbar" role="toolbar">
        <div class="btn-group me-2" role="group">
            <button type="button" class="btn btn-success btn">Sākums</button>
        </div>
        <div class="btn-group me-2" role="group">
            <button type="button" class="btn btn-light">Mani dati</button>
            <button type="button" class="btn btn-light">Mani kolektīvi</button>
        </div>
        <div class="btn-group me-2" role="group">
            <button type="button" class="btn btn-secondary">Piekrišana</button>
            <button type="button" class="btn btn-secondary">Biežāk uzdotie jautājumi</button>
        </div>
    </nav>
    <div class="menu-background mt-2">
        <?= print_r(Dbh::getInstance()->get("participants")->_results); ?>
    </div>
</section>
</body>
</html>
