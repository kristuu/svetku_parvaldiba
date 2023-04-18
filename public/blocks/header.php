<?php
// Get backtrace information
$backtrace = debug_backtrace();

// Extract information about the requiring file
$caller = basename($backtrace[0]['file']);

$user = new Participant();
?>

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
                        <a class="nav-link <?= $caller === 'index.php' ? 'active' : ''; ?>" aria-current="page" href="<?=PUBLIC_DIR?>/index.php">Sākums</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $caller === 'about_me.php' ? 'active' : ''; ?>" aria-current="page" href="<?=PUBLIC_DIR?>/about_me.php">Mani dati</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Palīdzība</a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="#">BUJ</a>
                                <a class="dropdown-item" href="<?=PUBLIC_DIR?>/agreement.php">Datu izmantošana</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if ($user->getData()->Organiser):
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><strong>ADMIN</strong></a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a class="dropdown-item" href="../../backend/admin/public/collectives.php">Kolektīvi</a>
                                    <a class="dropdown-item" href="../../backend/admin/public/participants.php">Dalībnieki</a>
                                    <a class="dropdown-item" href="../../backend/admin/public/categories.php">Kategorijas</a>
                                    <a class="dropdown-item" href="../../backend/admin/public/participCollectives.php">Dalībnieku saistījums ar kolektīviem</a>
                                    <a class="dropdown-item" href="../../backend/admin/public/regions.php">Reģioni</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <img src="<?=RESOURCES_DIR?>/img/account.svg" height="32px">
                <span class="text-white ms-lg-2"
                      style="font-family: 'Work Sans'"><strong><?= $user->getData()->FName . " " . $user->getData()->LName; ?></strong>
                <?php
                if ($user->getData()->Organiser):
                    echo " | Svētku organizators";
                else:
                    echo " | Svētku dalībnieks";
                endif;
                ?>
            </span>
                <a href="<?=BACKEND_DIR?>/includes/logout.inc.php" class="ms-lg-4">
                    <img class="align-self-start" src="<?=RESOURCES_DIR?>/img/sign_out.svg" height="32px">
                </a>
            </div>
        </div>
    </nav>
</header>