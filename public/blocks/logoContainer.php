<?php
$today = new DateTimeImmutable();
$festival = new DateTimeImmutable('2023-07-01');
$daysLeft = $today->diff($festival);
?>

<div class="col text-center p-3 my-3 rounded shadow-sm" id="logoContainer">
    <hr class="my-0 opacity-100"/>
    <img class="logo-gars img-fluid" src="<?=RESOURCES_DIR?>/img/logo-rinda.svg"/>
    <img class="logo-iss img-fluid" src="<?=RESOURCES_DIR?>/img/logo-kompakts.svg"/>
    <hr class="my-0 opacity-100"/>
</div>
<div class="col my-3 p-3 rounded shadow-sm section-div bg-smilsu-brunais">
    <div class="d-flex">
        <img width="38px" height="38px" class="me-2" src="<?=RESOURCES_DIR?>/img/gaiss/logo-simbols.png"/>
        <div class="lh-sm w-100 d-flex align-items-center">
            <span class="d-block text-linu-gaisais font-title"><strong>LĪDZ SVĒTKIEM ATLIKUŠO DIENU SKAITS: </strong><?=$daysLeft->format('%a')?></span>

        </div>
    </div>
</div>