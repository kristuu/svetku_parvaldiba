<?php
$user = new Participant();
?>

<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-dark rounded" data-bs-theme="dark" aria-label="Navigation bar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../resources/img/logo-simbols.svg" style="background-color: white; border-radius: 10px;" height="32px"></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbar" style>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Sākums</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Mani dati</a>
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
                                        <a class="dropdown-item" href="#">Kolektīvi</a>
                                        <a class="dropdown-item" href="#">Ēdināšanas vietas</a>
                                        <a class="dropdown-item" href="#">Dislokācijas vietas</a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <img src="../resources/img/account.svg" height="32px">
                    <span class="text-white ms-lg-2"
                          style="font-family: 'Work Sans'"><strong><?= $user->getData()->FName . " " . $user->getData()->LName; ?></strong>
                        <?php
                        if ($_SESSION["Organiser"]):
                            echo " | Svētku organizators";
                        else:
                            echo " | Svētku dalībnieks";
                        endif;
                        ?>
                    </span>
                    <a href="../backend/includes/logout.inc.php" class="ms-lg-4">
                        <img class="align-self-start" src="../resources/img/sign_out.svg" height="32px">
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>