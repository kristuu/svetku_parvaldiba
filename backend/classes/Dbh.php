<?php

class Dbh
{
    private static Dbh $instance;
    public array $_results;

    // most recent query statement
    private PDO $connection;

    // result of the most recent query
    private PDOStatement $_query;

    // error state of the most recent query
    private bool $_error = FALSE;

    // count of rows affected by the most recent query
    private int $_count = 0;

    private function __construct()
    {
        $username = "root";
        $password = "";
        $this->connection = new PDO('mysql:host=localhost;dbname=svetku_parvaldiba', $username, $password);
    }

    public static function getInstance(): Dbh
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function insert(string $table, array $data): Dbh
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table ($keys) VALUES ($values)";

        $parameters = array_values($data);

        $this->query($sql, $parameters);

        return $this;
    }

    protected function query(string $sql, $conditions = array()): Dbh
    {
        $this->_error = FALSE;

        // prepare the query, lowering the risk of a possible SQL injection
        if ($this->_query = $this->connection->prepare($sql)) {
            $count = 1;

            // bind the query parameters
            if (count($conditions)) {
                foreach ($conditions as $condition) {
                    $this->_query->bindValue($count, $condition);
                    $count++;
                }
            }
        }
        if ($this->_query->execute()) {
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
        } else {
            $this->_error = TRUE;
        }

        return $this;
    }

    public function get(string $table, string $column = '*', array $conditions = array())
    {
        $where = '';

        if (count($conditions)) {
            $where = 'WHERE ';

            foreach ($conditions as $key => $value) {
                $where .= "$key = ? AND ";
            }

            $where = substr($where, 0, -5); // remove the last 'AND '
        }

        $sql = "SELECT $column FROM $table $where";

        $parameters = array_values($conditions);

        $this->query($sql, $parameters);

        return $this;
    }

    public function update(string $table, array $data, array $conditions): Dbh
    {
        $set = '';

        foreach ($data as $key => $value) {
            $set .= "$key = ?, ";
        }

        $set = substr($set, 0, -2); // remove the last ', '

        $where = '';

        foreach ($conditions as $key => $value) {
            $where .= "$key = ? AND ";
        }

        $where = substr($where, 0, -5); // remove the last 'AND '

        $parameters = array_merge(array_values($data), array_values($conditions));

        $sql = "UPDATE $table SET $set WHERE $where";

        $this->query($sql, $parameters);

        return $this;
    }

    public function delete(string $table, array $conditions): Dbh
    {
        $where = '';

        foreach ($conditions as $key => $value) {
            $where .= "$key = ? AND ";
        }

        $where = substr($where, 0, -5); // remove the last 'AND '

        $parameters = array_values($conditions);

        $sql = "DELETE FROM $table WHERE $where";

        $this->query($sql, $parameters);

        return $this;
    }


}
