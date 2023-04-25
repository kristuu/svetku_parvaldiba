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
$participants = $participant->getAllParticipants();

// Check if the user is an administrator
if (!$participant->findUser()->Organiser) {
    header("Location: ". ADMIN_DIR ."/public/index.php");
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
        <h6 class="border-bottom pb-2 mb-0 fw-bold">DALĪBNIEKU PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3">
            <div class="card-body">
                <button class="btn btn-outline-dark w-100 font-title mb-3" href="#" onclick="location.href='addParticipant.php'">PIEVIENOT DALĪBNIEKU</button>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 font-default">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead class="font-title">
                            <th>
                                <th>ID</th>
                                <th>Personas kods</th>
                                <th>Vārds</th>
                                <th>Uzvārds</th>
                                <th>Foto</th>
                                <th>Tel. nr.</th>
                                <th>E-pasts</th>
                                <th>Parole</th>
                                <th>Dzimšanas dati</th>
                                <th>Organizators</th>
                                <th>Darbības</th>
                            </th>
                        </thead>
                        <tbody>
                        <?php
                        $x = 1;
                        foreach($participants as $participantx) {
                            echo "<tr>";
                            echo "<td>" . $x . "</td>";
                            echo "<td>" . $participantx->ParticipantID . "</td>";
                            echo "<td>" . $participantx->PersonCode . "</td>";
                            echo "<td>" . $participantx->FName . "</td>";
                            echo "<td>" . $participantx->LName . "</td>";
                            echo "<td><img style=\"max-height: 200px;\" src=\"" . PARTICIPIMG_DIR . '/' .  $participantx->ProfilePic . "\"></td>";
                            echo "<td>" . $participantx->Phone . "</td>";
                            echo "<td>" . $participantx->Email . "</td>";
                            echo "<td>" . $participantx->Password . "</td>";
                            echo "<td>" . $participantx->BirthDate . "</td>";
                            echo "<td>" . $participantx->Organiser . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-warning me-3' onclick=\"location.href='editParticipant.php?id=" . $participantx->ParticipantID . "'\">Labot</button>";
                            echo "<a " . ($participantx->ParticipantID === $participant->findUser()->ParticipantID ? 'disabled' : '') . " class='btn btn-danger' href='" . BACKEND_DIR . "/handlers/deleteHandlers/deleteParticipant.php?id=" . $participantx->ParticipantID . "'\">Dzēst</a>";
                            echo "</td>";
                            echo "</tr>";
                            $x++;
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