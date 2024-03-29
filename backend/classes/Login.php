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
        $data = $this->_DB->get('participants', array(array('Email', '=', $email)));
        $passwordHashed = $data->getResults()[0]->Password;

        $checkPassword = password_verify($password, $passwordHashed);

        if (is_null($passwordHashed)) {
            header("Location: /svetku_parvaldiba/public/login.php?error=usernotfound");
            exit();
        }
        if (!$checkPassword) {
            header("Location: /svetku_parvaldiba/public/login.php?error=wrongpassword");
            exit();
        } else {
            $this->_DB->get('participants', array(array('Email', '=', $email), array('Password', '=', $passwordHashed)));

            if ($this->_DB->getCount() === 0) {
                header("Location: /svetku_parvaldiba/public/login.php?error=usernotfound");
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