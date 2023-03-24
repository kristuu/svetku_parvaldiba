<?php

namespace backend\classes;

use Dbh;

class Login extends Dbh
{
    protected function getUser($email, $password)
    {
        $conn = self::getInstance()->getConnection();
        $stmt = $conn->prepare('SELECT Password FROM participants WHERE Email = ? OR Phone = ?;');

        if (!$stmt->execute(array($email, $email))) {
            $stmt = null;
            header("Location: ../../public/login.php?error=stmtfailed");
            exit();
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]["Password"]);

        if (count($passwordHashed) == 0) {
            $stmt = null;
            header("Location: ../../public/login.php?error=usernotfound");
            exit();
        }

        if ($checkPassword === false) {
            $stmt = null;
            header("Location: ../../public/login.php?error=wrongpassword");
            exit();
        } else {
            $conn = self::getInstance()->getConnection();
            $stmt = $conn->prepare('SELECT * FROM participants WHERE Email = ? OR Phone = ? AND Password = ?;');

            if (!$stmt->execute(array($email, $email, $passwordHashed[0]["Password"]))) {
                $stmt = null;
                header("Location: ../../public/login.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() === 0) {
                $stmt = null;
                header("Location: ../../public/login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchall(PDO::FETCH_ASSOC);


            session_start();
            $_SESSION["usersfname"] = $user[0]["FName"];
            $_SESSION["isLoggedIn"] = TRUE;
            if ($user[0]["Organiser"] === 1) {
                $_SESSION["Organiser"] = TRUE;
            } else {
                $_SESSION["Organiser"] = FALSE;
            }
        }

        $stmt = null;
    }
}