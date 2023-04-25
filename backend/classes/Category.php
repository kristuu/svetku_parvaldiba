<?php

class Category
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findCategory($categoryID = null) {
        if($categoryID) {
            $field = 'CategoryID';
            $data = $this->_DB->get('categories', array(array($field, '=', $categoryID)), array(array('INNER', 'categorytypes', 'categories.TypeID', 'categorytypes.TypeID')));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getAllCategories() {
        $data = $this->_DB->get('categories', array(), array(array('INNER', 'categorytypes', 'categories.TypeID', 'categorytypes.TypeID')));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createCategory(array $fields) {
        if ($this->_DB->insert('categories', $fields)) {
            return TRUE;
        } else {
            die('Error creating category.');
        }
    }

    public function updateCategory(array $data, int $id) {
        if ($id) {
            $this->_DB->update('categories', $data, array(array('CategoryID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating category.');
        }
    }

    public function deleteCategory(int $id) {
        if ($id) {
            $this->_DB->delete('categories', array(array('CategoryID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting category.');
        }
    }

}