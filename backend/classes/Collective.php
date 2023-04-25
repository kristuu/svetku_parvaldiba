<?php

class Collective
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findCollective($collectiveID = null) {
        if($collectiveID) {
            $field = 'CollectiveID';
            $data = $this->_DB->get('collectives', array(array($field, '=', $collectiveID)), array(array('INNER', 'regions', 'collectives.RegionID', 'regions.RegionID'), array('INNER', 'categories', 'collectives.CategoryID', 'categories.CategoryID')));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllCollectives() {
        $data = $this->_DB->get('collectives', array(), array(array('INNER', 'regions', 'collectives.RegionID', 'regions.RegionID'), array('INNER', 'categories', 'collectives.CategoryID', 'categories.CategoryID')));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createCollective(array $fields) {
        if ($this->_DB->insert('collectives', $fields)) {
            return TRUE;
        } else {
            die('Error creating collective.');
        }
    }

    public function updateCollective(array $data, int $id) {
        if ($id) {
            $this->_DB->update('collectives', $data, array(array('CollectiveID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating collective.');
        }
    }

}