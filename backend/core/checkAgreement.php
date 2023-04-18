<?php
$participant = new Participant();

if(!$participant->getData()->RulesAgreement || !$participant->getData()->DataAgreement) {
    header("Location: " . PUBLIC_DIR . "/agreement.php");
}