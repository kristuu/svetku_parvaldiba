<?php

use backend\classes\Login;

class LoginContr extends Login
{
    private string $email;
    private string $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        if (!($this->emptyInput())) {
            header("Location: ../../public/login.php?error=emptyinput");
        }

        $this->getUser($this->email, $this->password);
    }

    private function emptyInput()
    {
        if (empty($this->email) || empty($this->password)) {
            return false;
        } else {
            return true;
        }
    }


}