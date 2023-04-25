<?php

class Categorytypes
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findType($typeID = null) {
        if($typeID) {
            $field = 'TypeID';
            $data = $this->_DB->get('categorytypes', array(array($field, '=', $typeID)));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllTypes() {
        $data = $this->_DB->get('categorytypes', array());
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createType(array $fields) {
        if ($this->_DB->insert('categorytypes', $fields)) {
            return TRUE;
        } else {
            die('Error creating type.');
        }
    }

    public function updateType(array $data, int $id) {
        if ($id) {
            $this->_DB->update('categorytypes', $data, array(array('TypeID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating type.');
        }
    }

}