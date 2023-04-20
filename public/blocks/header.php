<?php
// Get backtrace information
$backtrace = debug_backtrace();

// Extract information about the requiring file
$filename = $backtrace[0]['file'];
$caller = basename($backtrace[0]['file']);

$today = new DateTimeImmutable();
$festival = new DateTimeImmutable('2023-07-01');
$daysLeft = $today->diff($festival);

$participant = new Participant();
?>

<head>
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/universal.css"/>
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/offcanvas-navbar.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Navigation bar">
        <div class="container-fluid">
            <a class="navbar-brand ms-1 me-2" href="<?=PUBLIC_DIR?>/index.php"><img src="<?=RESOURCES_DIR?>/img/logo-simbols.svg" style="background-color: white; border-radius: 10px;" height="32px"></a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $caller === 'index.php' ? 'active' : ''; ?>" aria-current="page" href="<?=PUBLIC_DIR?>/index.php">SĀKUMS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $caller === 'about_me.php' ? 'active' : ''; ?>" aria-current="page" href="<?=PUBLIC_DIR?>/about_me.php">MANI DATI</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">PALĪDZĪBA</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="#">BUJ</a>
                                <a class="dropdown-item" href="<?=PUBLIC_DIR?>/agreement.php">DATU IZMANTOŠANA</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if ($participant->getData()->Organiser):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?= str_contains($filename, 'admin') ? 'active' : ''; ?>" href="<?=ADMIN_DIR?>/public/index.php" aria-current="page"><strong>ADMIN</strong></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <img src="<?=RESOURCES_DIR?>/img/account.svg" height="32px">
                <span class="text-white ms-lg-2"
                      style="font-family: 'Work Sans'"><strong><?= mb_strtoupper($participant->getData()->FName . " " . $participant->getData()->LName); ?></strong>
                <?php
                if ($participant->getData()->Organiser):
                    echo " | SVĒTKU ORGANIZATORS";
                else:
                    echo " | SVĒTKU DALĪBNIEKS";
                endif;
                ?>
            </span>
                <a href="<?=BACKEND_DIR?>/includes/logout.inc.php" class="ms-lg-4">
                    <img class="align-self-start" src="<?=RESOURCES_DIR?>/img/sign_out.svg" height="32px">
                </a>
            </div>
        </div>
    </nav>
    <div class="nav-scroller bg-dzervenu-sartais shadow-sm">
        <nav class="nav">
                <div class="lh-sm w-100 text-center m-auto">
                    <img class="logo-gars img-fluid" style="max-height: 100px" src="<?=RESOURCES_DIR?>/img/gaiss/logo-rinda.png"/>
                    <img class="logo-iss img-fluid" src="<?=RESOURCES_DIR?>/img/gaiss/logo-kompakts.png"/>
            </div>
        </nav>
    </div>
    <div class="nav-scroller bg-white shadow-sm">
        <nav class="nav">
            <div class="lh-sm w-100 py-2 d-flex align-items-center justify-content-center">
                <span class="d-block text-dzervenu-sartais font-title"><strong>LĪDZ SVĒTKIEM ATLIKUŠO DIENU SKAITS: </strong><?=$daysLeft->format('%a')?></span>
            </div>
        </nav>
    </div>
</header>
<script>
    (() => {
        'use strict'

        document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
            document.querySelector('.offcanvas-collapse').classList.toggle('open')
        })
    })()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>