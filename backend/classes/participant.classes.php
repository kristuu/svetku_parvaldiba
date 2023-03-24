<?php
include "dbh.classes.php";

class Participant extends Dbh
{
    public static function getAllUsers()
    {
        $conn = self::getInstance()->getConnection();
        $stmt = $conn->prepare('SELECT * FROM participants');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}

/*
foreach (Participant::getAllUsers() as $array) {
    foreach ($array as $key => $value) {
        echo $key . " => " . $value . "<br/>";
    }
}
*/