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
            /*$allowedActions = array('SELECT', 'DELETE');
            $allowedOperators = array('=', '>', '<', '>=', '<=');

            if(in_array($operator, $allowedOperators)) {*/
                $value = array();
                $sql = "{$action} FROM {$table}";
                if(count($joins) > 0) {
                    foreach ($joins as $array) {
                        $sql .= " {$array[0]} JOIN {$array[1]} ON {$array[2]} = {$array[3]}";
                    }
                }
                if(count($where) > 0) {
                    $x = 1;
                    foreach($where as $array) {
                        if($x === 1) {
                            $sql .= " WHERE {$array[0]} {$array[1]} ?";
                        } elseif ($x > 1) {
                            $sql .= " AND {$array[0]} {$array[1]} ?";
                        }
                        $value[] = $array[2];
                        $x++;
                    }
                }
                if (!$this->query($sql, $value)->_error) {
                    return $this;
                }
            /*}*/
        return FALSE;
    }

    public function get($table, $where = array(), $joins = array())
    {
        return $this->action("SELECT *", $table, $where, $joins);
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
        $set = array();

        foreach($data as $array) {
            foreach ($array as $column => $value) {
                $set[] = "{$column} = '{$value}'";
            }
        }

        $bindValues = array();

        $set = implode(', ', $set);
        $sql = "UPDATE {$table} SET {$set}";
        if(count($where) > 0) {
            $x = 1;
            foreach($where as $array) {
                if($x === 1) {
                    $sql .= " WHERE {$array[0]} {$array[1]} ?";
                } elseif ($x > 1) {
                    $sql .= " AND {$array[0]} {$array[1]} ?";
                }
                $bindValues[] = $array[2];
                $x++;
            }
        }

        if (!$this->query($sql, $bindValues)->_error) {
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
