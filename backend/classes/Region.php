<?php

class Region
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findRegion($categoryID = null) {
        if($categoryID) {
            $field = 'RegionID';
            $data = $this->_DB->get('regions', array(array($field, '=', $categoryID)));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllRegions() {
        $data = $this->_DB->get('regions');
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createRegion(array $fields) {
        if ($this->_DB->insert('regions', $fields)) {
            return TRUE;
        } else {
            die('Error creating region.');
        }
    }

    public function updateRegion(array $data, int $id) {
        if ($id) {
            $this->_DB->update('regions', $data, array(array('RegionID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating region.');
        }
    }

    public function deleteRegion(int $id) {
        if ($id) {
            $this->_DB->delete('regions', array(array('RegionID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting region.');
        }
    }

}