<?php

class ParticipCollectives
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findParticipantsCollectives($participantID = null) {
        if($participantID) {
            $field = 'participants.ParticipantID';
            $data = $this->_DB->get('participcollectives', array(array($field, '=', $participantID)), array(array("INNER", "collectives", "participcollectives.CollectiveID", "collectives.CollectiveID"), array("INNER", "participants", "participcollectives.ParticipantID", "participants.ParticipantID")));
            if ($data->getCount()) {
                $this->_data = $data->getResults();
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getParticipantsCollectives($participantID = null) {
        if ($this->findParticipantsCollectives($participantID)) {
            return $this->_data;
        } else {
            return 'None found.';
        }
    }


    public function findCollectiveParticipants($collectiveID = null) {
        if($collectiveID) {
            $field = 'collectives.CollectiveID';
            $data = $this->_DB->get('participcollectives', array(array($field, '=', $collectiveID)), array(array("INNER", "collectives", "participcollectives.CollectiveID", "collectives.CollectiveID"), array("INNER", "participants", "participcollectives.ParticipantID", "participants.ParticipantID")));

            if ($data->getCount()) {
                $this->_data = $data->getResults();
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getCollectiveParticipants($collectiveID = null) {
        if ($this->findCollectiveParticipants($collectiveID)) {
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function getParticipCollective(int $id) {
        if ($id) {
            $field = 'ID';
            $data = $this->_DB->get('participcollectives', array(array($field, '=', $id)), array(array("INNER", "collectives", "participcollectives.CollectiveID", "collectives.CollectiveID"), array("INNER", "participants", "participcollectives.ParticipantID", "participants.ParticipantID")));
            if ($data->getCount()) {
                $this->_data = $data->getResults();
                return $this->_data;
            } else {
                die('ParticipCollective retrieve failed.');
            }
        }
    }

    public function getAllParticipantsCollectives() {
        $data = $this->_DB->get('participcollectives', array(), array(array("INNER", "collectives", "participcollectives.CollectiveID", "collectives.CollectiveID"), array("INNER", "participants", "participcollectives.ParticipantID", "participants.ParticipantID")));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        }
        return FALSE;
    }

    public function updateParticipantsMainCollective(string $mainCollectiveID, int $userID = null) {
        if ($userID === null) {
            $user = new Participant();
            $userID = $user->getData()->ParticipantID;
        }
        $this->_DB->update('participcollectives', array(array('MainCollective' => 0)), array(array('ParticipantID', '=', $userID)));
        $this->_DB->update('participcollectives', array(array('MainCollective' => 1)), array(array('ParticipantID', '=', $userID), array('CollectiveID', '=', $mainCollectiveID)));
    }

    public function createParticipCollective(array $fields) {
        if ($this->_DB->insert('participcollectives', $fields)) {
            return TRUE;
        } else {
            die('Error creating participCollective connection.');
        }
    }

    public function updateParticipCollective(array $fields, int $id) {
        if ($id) {
            $this->_DB->update('participcollectives', $fields, array(array('ID', '=', $id)));
        } else {
            die('Error updating participCollective connection.');
        }
    }

    public function deleteParticipCollective(int $id) {
        if ($id) {
            $this->_DB->delete('participcollectives', array(array('ID', '=', $id)));
        } else {
            die('Error deleting participCollective connection.');
        }
    }

    public function getData() {
        return $this->_data;
    }
}