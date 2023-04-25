<?php

// error handler
$fields = array(
    "FName" => "Vārds",
    "LName" => "Uzvārds",
    "PersonCode" => "Personas kods",
    "BirthDate" => "Dzimšanas datums",
    "Phone" => "Telefona numurs",
    "Email" => "E-pasta adrese",
    "Password" => "Parole",
    "Organiser" => "Organizators"
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