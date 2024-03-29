<?php

class Participant
{
    private Dbh $_DB;
    private $_data;
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
            return TRUE;
        } else {
            die('Error creating user.');
        }
    }

    public function findUser($user = null) {
        if (!$user) {
            $user = $_SESSION["user_id"];
        }
        if ($user) {
            $field = 'ParticipantID';
            $data = $this->_DB->get('participants', array(array($field, '=', $user)));

            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllParticipants() {
        $data = $this->_DB->get('participants');
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        }
        return 'No participants in table.';
    }

    public function getAllChoreographs() {
        $data = $this->_DB->get('participants', array(array('Choreograph', '=', 1)));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        }
        return 'No choreographs in table.';
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
        if (!$id) {
            $participant = new Participant();
            $participantId = $participant->getData()->ParticipantID;
            $id = $participantId;
        }

        $this->_DB->update('participants', $data, array(array('ParticipantID', '=', $id)));
    }

    public function deleteUser(int $id) {
        $this->_DB->delete('participants', array(array('ParticipantID', '=', $id)));
    }
}

/*
foreach (Participant::getAllUsers() as $array) {
    foreach ($array as $key => $value) {
        echo $key . " => " . $value . "<br/>";
    }
}
*/