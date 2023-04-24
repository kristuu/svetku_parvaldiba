<?php
require_once '../../core/init.php';
// include edit person variables
require_once(ROOT_DIR . 'backend/includes/restrictionPopovers.inc.php');
// include datatable scripts
require_once(ROOT_DIR . 'backend/includes/dataTables.inc.php');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participCollectives = new ParticipCollectives();
$collective = new Collective();

// Check if the user is an administrator
if (!$participant->getData()->Organiser) {
    header("Location: ". PUBLIC_DIR ."/index.php");
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
        <h6 class="border-bottom pb-2 mb-0 fw-bold">KOLEKTĪVA PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3 text-center">
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 font-default">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead class="font-title">
                            <th>
                                <th>ID</th>
                                <th>Nosaukums</th>
                                <th>Logo faila ceļš</th>
                                <th>Reģions</th>
                                <th>Kategorija</th>
                            </th>
                        </thead>
                        <tbody>
                            <?php
                                $x = 1;
                                foreach($collective->getAllCollectives() as $collective) {
                                    echo "<tr>";
                                    echo "<td>" . $x . "</td>";
                                    echo "<td>" . $collective->CollectiveID . "</td>";
                                    echo "<td>" . $collective->CollectiveName . "</td>";
                                    echo "<td>" . $collective->LogoPath . "</td>";
                                    echo "<td>" . $collective->RegionName . "</td>";
                                    echo "<td>" . $collective->CategoryName . "</td>";
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