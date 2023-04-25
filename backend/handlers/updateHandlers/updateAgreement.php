<?php
require_once '../core/init.php';

$participant = new Participant();

if (isset($_POST['submitAgreement'])) {
    if($_POST['dataAgreement'] == 'on' && $_POST['rulesAgreement'] == 'on') {
        $participant->update(array(array('DataAgreement' => 1), array('RulesAgreement' => 1)));
        header("Location: " . PUBLIC_DIR . "/index.php");
        exit;
    } else {
        switch(true) {
            case ($_POST['dataAgreement'] === 'on' && $_POST['rulesAgreement'] !== 'on'):
                $participant->update(array(array('DataAgreement' => 1), array('RulesAgreement' => 0)));
                break;
            case ($_POST['dataAgreement'] !== 'on' && $_POST['rulesAgreement'] === 'on'):
                $participant->update(array(array('DataAgreement' => 0), array('RulesAgreement' => 1)));
                break;
        }
        header("Location: " . PUBLIC_DIR . "/agreement.php");
        exit;
    }
}