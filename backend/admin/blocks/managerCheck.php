<?php
require_once '../../core/init.php';

$participant = new Participant();
$participCollectives = new ParticipCollectives();
$collectives = $participCollectives->getParticipantsCollectives($participant->getData()->ParticipantID);

$managerFound = false;

foreach ($collectives as $collective) {
    if ($collective->Manager) {
        $managerFound = true;
        break;
    }
}

if (!$managerFound) {
    header("Location: ". PUBLIC_DIR ."/index.php");
}