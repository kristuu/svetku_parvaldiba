<?php
require_once '../core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}
if (!$_SESSION["Organiser"]) {
    header("Location: ../../public/index.php");
}
$participant = new Participant();
$participants = $participant->getAllUsers();
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
    <link rel="stylesheet" href="../../../resources/css/universal.css"/>
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="hhttps://raw.githubusercontent.com/ColorlibHQ/AdminLTE/master/dist/css/adminlte.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../public/header.php' ?>
<main class="container">
    <div class="w-100 bg-white rounded mt-lg-4 mt-2 d-flex flex-column align-items-center text-center">
        <h1 class="mt-3">ADMIN » Dalībnieku pārvaldība</h1>
        <form class="w-75" action="../../includes/editSelf.inc.php" method="POST">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>UserID</th>
                                    <th>PersonCode</th>
                                    <th>FName</th>
                                    <th>LName</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>BirthDate</th>
                                    <th>Organiser</th>
                                    <th>Darbība</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($participants as $object):?>
                                    <tr>
                                        <td><?= $object->UserID ?></td>
                                        <td><?= $object->PersonCode ?></td>
                                        <td><?= $object->FName ?></td>
                                        <td><?= $object->LName ?></td>
                                        <td><?= $object->Phone ?></td>
                                        <td><?= $object->Email ?></td>
                                        <td><?= $object->Password ?></td>
                                        <td><?= $object->BirthDate ?></td>
                                        <td><?= $object->Organiser ? 'TRUE' : 'FALSE' ?></td>
                                        <td><a type="button" role="button" class="btn btn-block btn-warning" href="editParticipant.php?id=<?= $object->UserID ?>">Rediģēt</a></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
</main>
<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://raw.githubusercontent.com/ColorlibHQ/AdminLTE/master/dist/js/adminlte.min.js"></script>
</body>
</html>