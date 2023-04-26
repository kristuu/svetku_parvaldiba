<?php

class Post
{
    private Dbh $_DB;
    private $_data;

    public function __construct($user = null)
    {
        $this->_DB = Dbh::getInstance();
    }

    public function findPostsByCollective($collectiveID = null) {
        if($collectiveID) {
            $field = 'CollectiveID';
            $data = $this->_DB->get('posts', array(array($field, '=', $collectiveID)));
            if ($data->getCount()) {
                $this->_data = $data->getResults()[0];
                return $this->_data;
            }
        }
        return FALSE;
    }

    public function getGlobalPosts() {
        $data = $this->_DB->get('posts', array(array('CollectiveID', '=', 0)));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function getAllPosts() {
        $data = $this->_DB->get('posts', array(), array(array('INNER', 'collectives', 'collectives.CollectiveID', 'posts.CollectiveID')));
        if ($data->getCount()) {
            $this->_data = $data->getResults();
            return $this->_data;
        } else {
            return 'None found.';
        }
    }

    public function createPost(array $fields) {
        if ($this->_DB->insert('posts', $fields)) {
            return TRUE;
        } else {
            die('Error creating a post.');
        }
    }

    public function updatePost(array $data, int $id) {
        if ($id) {
            $this->_DB->update('posts', $data, array(array('PostID', '=', $id)));
            return TRUE;
        } else {
            die('Error updating a post.');
        }
    }

    public function deletePost(int $id) {
        if ($id) {
            $this->_DB->delete('posts', array(array('PostID', '=', $id)));
            return TRUE;
        } else {
            die('Error deleting a post.');
        }
    }

}