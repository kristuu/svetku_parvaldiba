<?php

class LoginContr extends Login
{
    private string $email;
    private string $password;

    public function __construct($email, $password)
    {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    public function loginUser()
    {
        $validate = new Validate();
        if ($validate->isEmpty($this->email) && $validate->isEmpty($this->password)) {
            header("Location: ../../public/login.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->email, $this->password);
    }


}