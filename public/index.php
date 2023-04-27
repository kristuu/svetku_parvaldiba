<?php
require_once '../backend/core/init.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// check if the user has agreed to the rules and data processing, if not, redirect them to agreement page
require_once ROOT_DIR . 'backend/core/checkAgreement.php';

$participant = new Participant();
$participantID = $participant->getData()->ParticipantID;
$collectiveClass = new Collective();
$participCollectives = new ParticipCollectives();
$pCollectiveList = $participCollectives->getParticipantsCollectives($participantID);
$colrehClass = new CollectivesRehearsals();
?>

<!DOCTYPE html>
<html lang="lv">
<?php include ROOT_DIR . 'backend/includes/head.inc.php'; ?>
<body>
<?php include ROOT_DIR . 'public/blocks/header.php'; ?>
<main class="container">
    <?php include ROOT_DIR . 'public/blocks/logoContainer.php'; ?>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">Tavi kolektīvi:</h6>
        <?php
        foreach($pCollectiveList as $collective):
            $cParticipants = $participCollectives->getCollectiveParticipants($collective->CollectiveID);
        ?>
        <div class="d-flex text-body-secondary pt-3">
            <img class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" src="<?= COLLECTIVELOGOS_DIR . '/' . $collective->LogoPath; ?>" role="img"/>
                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark"><?=$collective->CollectiveName . ($collective->MainCollective ? ' | GALVENAIS' : ''); ?></strong>
                        <?=($collective->Manager) ? '<a href="#">Pārvaldīt</a>' : ''?>
                    </div>
                    <span class="d-block">
                        Kolektīva vadītājs:
                        <?php foreach($cParticipants as $cParticipant):
                            if ($cParticipant->Manager):
                                echo $cParticipant->FName . ' ' . $cParticipant->LName;
                            endif;
                        endforeach; ?>
                    </span>
                </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="my-3 p-3 rounded shadow-sm section-div">
        <h6 class="border-bottom pb-2 mb-0 fw-bold">Mēģinājumi:</h6>
        <?php
        foreach($pCollectiveList as $collective):
            $cRehearsals = $collectiveClass->getCollectivesRehearsals($collective->CollectiveID);
            // sort rehearsals by start time in ascending order
            if(!is_string($cRehearsals)) {
                usort($cRehearsals, function ($a, $b) {
                    return strtotime($a->StartTime) - strtotime($b->StartTime);
                });
            }?>
            <h6 class="border-bottom pb-2 mt-3 mb-2 fw-normal"><?=$collective->CollectiveName . ' (' . $collective->CategoryName . ')'?></h6>
            <div class="row g-3">
            <?php
            if(!is_string($cRehearsals)) {
                foreach($cRehearsals as $rehearsal):
                    $startTime = new DateTime($rehearsal->StartTime);
                    $endTime = new DateTime($rehearsal->EndTime);
                    if ($rehearsal->EndTime >= date('Y-m-d H:i:s')):?>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body bg-smilsu-brunais text-linu-gaisais">
                                <?php if(!empty($rehearsal->RehearsalDesc)): ?>
                                    <h6 class="card-title fw-bold"><?=($rehearsal->RehearsalDesc ?? '')?></h6>
                                <?php endif; ?>
                                <?php if(!empty($rehearsal->DanceName)): ?>
                                    <h6 class="card-title fw-bold"><?=($rehearsal->DanceName ?? '')?></h6>
                                <?php endif; ?>
                            </div>
                            <ul class="list-group list-group-flush"></ul>
                            <div class="card-body bg-linu-gaisais text-oglu-melnais">
                                <h6 class="card-title">SĀKUMS</h6>
                                <p class="card-text"><?=$startTime->format('d. M » G.i')?></p>
                            </div>

                            <div class="card-body bg-linu-gaisais text-oglu-melnais">
                                <h6 class="card-title">BEIGAS</h6>
                                <p class="card-text"><?=$endTime->format('d. M » G.i')?></p>
                            </div>
                            <ul class="list-group list-group-flush"></ul>
                            <div class="card-body bg-dzervenu-sartais text-linu-gaisais">
                                <h6 class="card-title fw-bold">HOREOGRĀFS</h6>
                                <p class="card-text"><?=$rehearsal->FName . ' ' . $rehearsal->LName?></p>
                            </div>
                        </div>
                    </div>
                <?php endif;
                endforeach;
            } else {
                echo '<div class="col-md-12"><p class="text-center">Kolektīvam nav ieplānotu mēģinājumu</p></div>';
            } ?>
            </div>
        <?php
        endforeach; ?>
    </div>
</main>
</body>

</html>
