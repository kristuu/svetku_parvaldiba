<?php

class Participant
{
    private Dbh $_DB;
    private $_data;
    private $_queryData;
    private bool $_isLoggedIn = false;

    public function __construct($user = null) {
        $this->_DB = Dbh::getInstance();

        if (!$user) {
            if (isset($_SESSION["user_id"])) {
                $user = $_SESSION["user_id"];

                if ($this->findUser($user)) {
                    $this->_isLoggedIn = true;
                }
            }
        } else {
            $this->findUser($user);
        }
    }

    public function createUser(array $fields) {
        if ($this->_DB->insert('participants', $fields)) {
            throw new \mysql_xdevapi\Exception('There was a problem creating an account.');
        }
    }

    public function findUser($user = null) {
        if ($user) {
            $field = 'UserID';
            $data = $this->_DB->get('participants', array($field => $user));

            if ($data->count()) {
                $this->_data = $data->_results[0];
                return TRUE;
            }
        }
        return FALSE;
    }

    public function exists() {
        return !empty($this->_data);
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }

    public function getData() {
        return $this->_data;
    }

    public function update(array $data, int $id = null) {
        if (!$id && isset($_SESSION["user_id"])) {
            $id = $_SESSION["user_id"];
        }

        $this->_DB->update('participants', $data, array('UserID' => $id));
    }
}

/*
foreach (Participant::getAllUsers() as $array) {
    foreach ($array as $key => $value) {
        echo $key . " => " . $value . "<br/>";
    }
}
*/