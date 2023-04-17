<?php
// popover content for about_me fields
$restrictionPopovers = array(
    "TriggerType" => "focus",
    "Title" => "Lauka ierobežojumi",
    "FName" => "<strong>Garums:</strong> 2-30 simbolu<br><strong>Rakstzīmes:</strong> latīņu, latviešu alfabēta burti",
    "LName" => "<strong>Garums:</strong> 2-30 simbolu<br><strong>Rakstzīmes:</strong> latīņu, latviešu alfabēta burti",
    "PersonCode" => "<strong>Mainīt nav iespējams!</strong><br>Sazinies ar kolektīva vadītāju vai administratoru.",
    "Phone" => "<strong>Telefona numurs</strong><br><br><strong>Garums:</strong> 8 simboli<br><strong>Rakstzīmes:</strong> cipari",
    "Email" => "<strong>E-pasta adrese</strong>"
);

// error handler
$fields = array(
    "FName" => "Vārds",
    "LName" => "Uzvārds",
    "PersonCode" => "Personas kods",
    "BirthDate" => "Dzimšanas datums",
    "Phone" => "Telefona numurs",
    "Email" => "E-pasta adrese"
);

if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case "emptyfields":
            $errorMessage = "Lūdzu, aizpildi visus laukus!";
            break;
        case "unallowedchar":
            $errorMessage = "Pārliecinies, ka ievades laukos nav neatļautu rakstzīmju!";
            break;
        case "length":
            $errorMessage = "Lauks \"" . $fields[$_GET["field"]] . "\" neatbilst garumam!";
            break;
    }
}

if(isset($errorMessage)) {
    $errorHolder = "<p class='error'>KĻŪDA » " . $errorMessage ?? "</p>";
} else {
    $errorHolder = "";
}