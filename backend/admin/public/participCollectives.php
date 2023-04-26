<?php
require_once '../../core/init.php';
// include datatable scripts
require_once(ROOT_DIR . 'backend/includes/dataTables.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participCollectives = new ParticipCollectives();

// Check if the user is an administrator
if (!$participant->getData()->Organiser) {
    header("Location: ". ADMIN_DIR ."/index.php");
}
?>

<!DOCTYPE html>
<html lang="lv">
<?php include ROOT_DIR . '/backend/includes/head.inc.php'; ?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">DALĪBNIEKU SAISTĪJUMA AR KOLEKTĪVIEM PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3">
            <div class="card-body">
                <button class="btn btn-outline-dark w-100 font-title mb-3" href="#" onclick="location.href='addParticipCollective.php'">PIEVIENOT DALĪBNIEKA SAISTĪJUMU AR KOLEKTĪVU</button>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 font-default">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead class="font-title">
                        <th>ID</th>
                        <th>Dalībnieks</th>
                        <th>Kolektīvs</th>
                        <th>Galvenais?</th>
                        <th>Vadītājs?</th>
                        <th>Darbības</th>
                        </thead>
                        <tbody>
                        <?php
                        foreach($participCollectives->getAllParticipantsCollectives() as $object) {
                            echo "<tr>";
                            echo "<td>" . $object->ID . "</td>";
                            echo "<td>" . $object->FName . ' ' . $object->LName . "</td>";
                            echo "<td>" . $object->CollectiveName . "</td>";
                            echo "<td>" . $object->MainCollective . "</td>";
                            echo "<td>" . $object->Manager . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-warning me-3' onclick=\"location.href='editParticipCollective.php?id=" . $object->ID . "'\">Labot</button>";
                            echo "<a class='btn btn-danger' href='" . BACKEND_DIR . "/handlers/deleteHandlers/deleteParticipCollective.php?id=" . $object->ID . "'\">Dzēst</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<?php include ROOT_DIR . 'backend/admin/blocks/dataTableActivator.php'; ?>
</body>
</html>