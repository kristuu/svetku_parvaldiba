<?php

class Collective
{
    private Dbh $_DB;
    public $_data;

    public function __construct() {
        $this->_DB = Dbh::getInstance();
    }

    public function findCollectiveParticipants($collectiveID = null) {
        if($collectiveID) {
            $field = 'CollectiveID';
            $data = $this->_DB->get('participcollectives', array($field => $collectiveID), 'participants.FName, participants.LName', 'INNER JOIN collectives ON participcollectives.CollectiveID = collectives.ID INNER JOIN participants ON participcollectives.ParticipantID = participants.UserID');

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

}