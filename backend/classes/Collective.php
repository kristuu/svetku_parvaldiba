<?php

class Collective
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function getTableHeaders() {
        $headers = $this->_DB->getAsocTablesHeaders('collectives');
        if ($headers) {
            return $headers;
        } else {
            return 'None found.';
        }
    }

    public function findCollective($collectiveID = null) {
        if($collectiveID) {
            $field = 'CollectiveID';
            $data = $this->_DB->get('collectives', array(array($field, '=', $collectiveID)));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return TRUE;
            }
        }
        return FALSE;
    }

    public function getCollective($collectiveID = null) {
        if ($this->findCollective($collectiveID)) {
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function getAllCollectives() {
        $data = $this->_DB->get('collectives');
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createCollective(array $fields) {
        if ($this->_DB->insert('collectives', $fields)) {
            throw new \mysql_xdevapi\Exception('There was a problem creating a collective.');
        }
    }

    public function updateCollective(array $data, int $id) {
        if ($id) {
            $this->_DB->update('collectives', $data, array(array('CollectiveID', '=', $id)));
        }
    }

}