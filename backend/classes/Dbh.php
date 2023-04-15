<?php

class Dbh
{
    private static Dbh $instance; // The single instance
    private PDO $connection; // PDO connection
    private PDOStatement $_query; // The query that's been prepared
    private bool $_error = false; // Whether there's an error
    private array $_results; // The results array with objects inside
    private int $_count = 0; // The number of results

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=svetku_parvaldiba', 'root', ''
            );
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Dbh();
        }
        return self::$instance;
    }

    private function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->connection->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = TRUE;
            }
        }
        return $this;
    }

    private function action($action, $table, $where = array(), $joins = array())
    {
        if (count($where) === 3) {
            $allowedActions = array('SELECT', 'DELETE');
            $allowedOperators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $allowedOperators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->_error) {
                    return $this;
                }
            }
        }
        return FALSE;
    }

    public function get($table, $where = array(), $joins = array())
    {
        return $this->action("SELECT *", $table, $where);
    }

    public function delete($table, $where = array())
    {
        return $this->action("DELETE", $table, $where);
    }

    public function insert($table, $data = array())
    {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        if (!$this->query($sql)->_error) {
            return $this;
        } else {
            return FALSE;
        }
    }

    public function update($table, $data = array(), $where = array()) {
        $set = [];

        foreach ($data as $column => $value) {
            $set[] = "{$column} = '{$value}'";
        }

        $set = implode(', ', $set);
        $sql = "UPDATE {$table} SET {$set} WHERE {$where[0]} = {$where[1]}";

        if (!$this->query($sql)->_error) {
            return $this;
        } else {
            return FALSE;
        }
    }

    public function getResults()
    {
        return $this->_results;
    }

    public function getError()
    {
        return $this->_error;
    }

    public function getCount()
    {
        return $this->_count;
    }

}
