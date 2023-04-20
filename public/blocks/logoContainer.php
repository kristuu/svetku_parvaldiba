<?php
// Pre-defined page headings
require_once ROOT_DIR . 'backend/includes/pageNames.php';

// Get backtrace information
$backtrace = debug_backtrace();

// Extract information about the requiring file
$filename = $backtrace[0]['file'];
$caller = basename($backtrace[0]['file']);
?>

<div class="col my-3 py-2 rounded shadow-sm section-div <?= str_contains($backtrace[0]['file'], 'admin') ? 'bg-ozollapu-zalais' : 'bg-smilsu-brunais'; ?>">
        <div class="lh-sm w-100 d-flex align-items-center justify-content-center">
            <h5 class="text-linu-gaisais m-0">
                <?=$pageNames[$caller]; ?>
            </h5>
        </div>
</div>