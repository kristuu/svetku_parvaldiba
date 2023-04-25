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
$region = new Region();
$regions = $region->getAllRegions();

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
        <h6 class="border-bottom pb-2 mb-0 fw-bold">REĢIONU PĀRVALDĪBAS PANELIS</h6>
        <div class="my-3">
            <div class="card-body">
                <button class="btn btn-outline-dark w-100 font-title mb-3" href="#" onclick="location.href='addRegion.php'">PIEVIENOT REĢIONU</button>
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 font-default">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                        <thead class="font-title">
                        <th>ID</th>
                        <th>Nosaukums</th>
                        <th>Darbības</th>
                        </thead>
                        <tbody>
                        <?php
                        foreach($regions as $regionx) {
                            echo "<tr>";
                            echo "<td>" . $regionx->RegionID . "</td>";
                            echo "<td>" . $regionx->RegionName . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-warning me-3' onclick=\"location.href='editRegion.php?id=" . $regionx->RegionID . "'\">Labot</button>";
                            echo "<a class='btn btn-danger' href='" . BACKEND_DIR . "/handlers/deleteHandlers/deleteRegion.php?id=" . $regionx->RegionID . "'\">Dzēst</a>";
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