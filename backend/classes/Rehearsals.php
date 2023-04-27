<?php

class Rehearsals
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findRehearsal($danceID = null) {
        if($danceID) {
            $field = 'RehearsalID';
            $data = $this->_DB->get('rehearsals', array(array($field, '=', $danceID)), array(array('LEFT', 'dances', 'rehearsals.DanceID', 'dances.DanceID'), array('LEFT', 'participants', 'rehearsals.ChoreographID', 'participants.ParticipantID')));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllRehearsals() {
        $data = $this->_DB->get('rehearsals', array(), array(array('LEFT', 'dances', 'rehearsals.DanceID', 'dances.DanceID'), array('LEFT', 'participants', 'rehearsals.ChoreographID', 'participants.ParticipantID')));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createRehearsal(array $fields) {
        if ($this->_DB->insert('rehearsals', $fields)) {
            return TRUE;
        } else {
            die('Error creating rehearsal.');
        }
    }

    public function updateRehearsal(array $data, int $id) {
        if ($id) {
            $this->_DB->update('rehearsals', $data, array(array('RehearsalID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating rehearsal.');
        }
    }

    public function deleteRehearsal(int $id) {
        if ($id) {
            $this->_DB->delete('rehearsals', array(array('RehearsalID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting rehearsal.');
        }
    }

}