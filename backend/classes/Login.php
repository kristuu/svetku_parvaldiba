<?php

class Login
{
    private Dbh $_DB;

    public function __construct()
    {
        $this->_DB = Dbh::getInstance();
    }
    protected function getUser($email, $password)
    {
        $data = $this->_DB->get('participants', array('Email', '=', $email));

        $passwordHashed = $data->getResults()[0]->Password;

        $checkPassword = password_verify($password, $passwordHashed);

        if (is_null($passwordHashed)) {
            header("Location: ../../public/login.php?error=usernotfound");
            exit();
        }
        if (!$checkPassword) {
            header("Location: ../../public/login.php?error=wrongpassword");
            exit();
        } else {
            $this->_DB->get('participants', array('Email' => $email, 'Password' => $passwordHashed));

            if ($this->_DB->getCount() === 0) {
                header("Location: ../../public/login.php?error=usernotfound");
                exit();
            }

            $user = $this->_DB->getResults();


            session_start();
            $_SESSION["user_id"] = $user[0]->ParticipantID;
            if ($user[0]->Organiser === 1) {
                $_SESSION["Organiser"] = TRUE;
            } else {
                $_SESSION["Organiser"] = FALSE;
            }
        }
    }
}