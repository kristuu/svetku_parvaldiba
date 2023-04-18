<?php
$user = new Participant();
?>

<header>
    <div class="container row g-3 m-auto">
        <nav class="navbar navbar-expand-lg bg-dark rounded col-12" style="margin-top: 20px;" data-bs-theme="dark" aria-label="Navigation bar">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=PUBLIC_DIR?>/index.php"><img src="<?=IMG_DIR?>/logo-simbols.svg" style="background-color: white; border-radius: 10px;" height="32px"></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar" style>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=PUBLIC_DIR?>/index.php">Sākums</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?=PUBLIC_DIR?>/about_me.php">Mani dati</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false">Palīdzība</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">BUJ</a>
                                    <a class="dropdown-item" href="<?=PUBLIC_DIR?>/agreement.php">Datu izmantošana</a>
                                </li>
                            </ul>
                        </li>
                        <?php if ($user->getData()->Organiser):
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false"><strong>ADMIN</strong></a>
                                <ul class="dropdown-menu">
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
                    <img src="<?=IMG_DIR?>/account.svg" height="32px">
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
                    <a href="../../backend/includes/logout.inc.php" class="ms-lg-4">
                        <img class="align-self-start" src="<?=IMG_DIR?>/sign_out.svg" height="32px">
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>