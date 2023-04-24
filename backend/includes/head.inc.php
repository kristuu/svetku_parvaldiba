<?php
// Get backtrace information
$backtrace = debug_backtrace();

// Extract information about the requiring file
$filename = $backtrace[0]['file'];
$caller = basename($backtrace[0]['file']);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        switch ($caller) {
            case 'login.php':
                echo 'Autorizācija ';
                break;
            case 'index.php':
                echo 'Sākums ';
                break;
            case 'agreement.php':
                echo 'Lietošanas noteikumi ';
                break;
            case 'about_me':
                echo 'Mani dati ';
                break;
            case 'categories.php':
                echo 'Kategorijas ';
                break;
            case 'collectives.php':
                echo 'Kolektīvi ';
                break;
            case 'participants.php':
                echo 'Dalībnieki ';
                break;
            case 'participCollectives.php':
                echo 'Dalībnieku saistījums ar kolektīviem ';
                break;
            case 'regions.php':
                echo 'Reģioni ';
                break;
            case 'editParticipant.php':
                echo 'Dalībnieka rediģēšana ';
                break;
        }
        ?>
        <?= str_contains($filename, 'admin') ? '| ADMIN ' : ''; ?> | XXVII Vispārējie latviešu Dziesmu un XVII Deju svētki</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/universal.css"/>
    <link rel="stylesheet" href="<?=RESOURCES_DIR?>/css/offcanvas-navbar.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" integrity="sha512-cyzxRvewl+FOKTtpBzYjW6x6IAYUCZy3sGP40hn+DQkqeluGRCax7qztK2ImL64SA+C7kVWdLI6wvdlStawhyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>