<?php

class Dances
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findDance($danceID = null) {
        if($danceID) {
            $field = 'DanceID';
            $data = $this->_DB->get('dances', array(array($field, '=', $danceID)));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllDances() {
        $data = $this->_DB->get('dances');
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createDance(array $fields) {
        if ($this->_DB->insert('dances', $fields)) {
            return TRUE;
        } else {
            die('Error creating dance.');
        }
    }

    public function updateDance(array $data, int $id) {
        if ($id) {
            $this->_DB->update('dances', $data, array(array('DanceID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating dance.');
        }
    }

    public function deleteDance(int $id) {
        if ($id) {
            $this->_DB->delete('dances', array(array('DanceID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting dance.');
        }
    }

}