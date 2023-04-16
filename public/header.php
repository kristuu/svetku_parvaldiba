<?php
$user = new Participant();
?>

<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark rounded" style="margin-top: 20px;" data-bs-theme="dark" aria-label="Navigation bar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="<?=IMG_DIR?>/logo-simbols.svg" style="background-color: white; border-radius: 10px;" height="32px"></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar" style>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Sākums</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="about_me.php">Mani dati</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Palīdzība</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#">Biežāk uzdotie jautājumi</a>
                                    <a class="dropdown-item" href="#">Datu izmantošana</a>
                                </li>
                            </ul>
                        </li>
                        <?php if ($user->getData()->Organiser):
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Pārvaldība</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="../backend/admin/collectives.php">Kolektīvi</a>
                                        <a class="dropdown-item" href="../backend/admin/participants.php">Dalībnieki</a>
                                        <a class="dropdown-item" href="../backend/admin/categories.php">Kategorijas</a>
                                        <a class="dropdown-item" href="../backend/admin/participCollectives.php">Dalībnieku saistījums ar kolektīviem</a>
                                        <a class="dropdown-item" href="../backend/admin/regions.php">Reģioni</a>
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
                    <a href="../backend/includes/logout.inc.php" class="ms-lg-4">
                        <img class="align-self-start" src="<?=IMG_DIR?>/sign_out.svg" height="32px">
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>