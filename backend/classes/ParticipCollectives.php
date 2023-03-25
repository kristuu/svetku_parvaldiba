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
            $field = 'ParticipantID';
            $data = $this->_DB->get('participcollectives', array($field => $participantID), 'collectives.CollectiveID, collectives.CollectiveName, participcollectives.MainCollective', 'INNER JOIN collectives ON participcollectives.CollectiveID = collectives.CollectiveID INNER JOIN participants ON participcollectives.ParticipantID = participants.UserID');

            if ($data->count()) {
                $this->_data = $data->_results;
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
            $field = 'CollectiveID';
            $data = $this->_DB->get('participcollectives', array($field => $collectiveID), 'participants.FName, participants.LName', 'INNER JOIN collectives ON participcollectives.CollectiveID = collectives.CollectiveID INNER JOIN participants ON participcollectives.ParticipantID = participants.UserID');

            if ($data->count()) {
                $this->_data = $data->_results;
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

    public function updateParticipantsMainCollective(string $mainCollectiveID) {
        $this->_DB->update('participcollectives', array('MainCollective' => 0), array('ParticipantID' => $_SESSION["user_id"]));
        $this->_DB->update('participcollectives', array('MainCollective' => 1), array('ParticipantID' => $_SESSION["user_id"], 'CollectiveID' => $mainCollectiveID));
    }

    public function getData() {
        return $this->_data;
    }
}