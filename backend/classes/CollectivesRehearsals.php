<?php

class CollectivesRehearsals
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findConnection($id = null) {
        if($id) {
            $field = 'colrehID';
            $data = $this->_DB->get('collectivesrehearsals', array(array($field, '=', $id)), array(array('INNER', 'rehearsals', 'rehearsals.RehearsalID', 'collectivesrehearsals.RehearsalID'), array('INNER', 'categories', 'collectivesrehearsals.CategoryID', 'categories.CategoryID')));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllConnections() {
        $data = $this->_DB->get('collectivesrehearsals', array(), array(array('INNER', 'rehearsals', 'rehearsals.RehearsalID', 'collectivesrehearsals.RehearsalID'), array('INNER', 'categories', 'collectivesrehearsals.CategoryID', 'categories.CategoryID'), array('LEFT', 'dances', 'dances.DanceID', 'rehearsals.DanceID')));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createConnection(array $fields) {
        if ($this->_DB->insert('collectivesrehearsals', $fields)) {
            return TRUE;
        } else {
            die('Error creating collectivesrehearsal connection.');
        }
    }

    public function updateConnection(array $data, int $id) {
        if ($id) {
            $this->_DB->update('collectivesrehearsals', $data, array(array('colrehID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating collectivesrehearsal connection.');
        }
    }

    public function deleteConnection(int $id) {
        if ($id) {
            $this->_DB->delete('collectivesrehearsals', array(array('colrehID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting collectivesrehearsal connection.');
        }
    }

}