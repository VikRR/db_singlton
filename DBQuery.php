<?php

include 'DBQueryInterface.php';

class DBQuery implements DBQueryInterface
{
    public $stamp = 0;
    private $pdo;

    /**
     * Create new instance DBQuery.
     *
     * @param DBConnectionInterface $DBConnection
     */
    public function __construct(DBConnectionInterface $DBConnection)
    {
        $this->pdo = $DBConnection->getPDO();
    }

    /**
     * Returns the DBConnection instance.
     *
     * @return DBConnectionInterface
     */
    public function getDBConnection()
    {
        // TODO: Implement getDBConnection() method.
        return $this->pdo;
    }

    /**
     * Change DBConnection.
     *
     * @param DBConnectionInterface $DBConnection
     *
     * @return void
     */
    public function setDBConnection(DBConnectionInterface $DBConnection)
    {
        // TODO: Implement setDBConnection() method.
        $this->pdo = $DBConnection->getPDO();
    }

    /**
     * Executes the SQL statement and returns query result.
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return mixed if successful, returns a PDOStatement on error false
     */
    public function query($query, $params = null)
    {
        // TODO: Implement query() method.
        try {
            $time_start = microtime(true);

            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $this->queryTime($time_start);

            return $stmt;
        } catch (PDOException $e) {
            throw $e;
        }

    }

    /**
     * Executes the SQL statement and returns all rows of a result set as an associative array
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return array
     */
    public function queryAll($query, array $params = null)
    {
        // TODO: Implement queryAll() method.
        try {

            $stmt = $this->query($query, $params);

            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $row;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Executes the SQL statement returns the first row of the query result
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return array
     */
    public function queryRow($query, array $params = null)
    {
        // TODO: Implement queryRow() method.
        try {

            $stmt = $this->query($query, $params);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Executes the SQL statement and returns the first column of the query result.
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return array
     */
    public function queryColumn($query, array $params = null)
    {
        // TODO: Implement queryColumn() method.
        try {

            $stmt = $this->query($query, $params);

            $row = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            return $row;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Executes the SQL statement and returns the first field of the first row of the result.
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return mixed  column value
     */
    public function queryScalar($query, array $params = null)
    {
        // TODO: Implement queryScalar() method.
        try {

            $stmt = $this->query($query, $params);

            $row = $stmt->fetchColumn();

            return $row;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Executes the SQL statement.
     * This method is meant only for executing non-query SQL statement.
     * No result set will be returned.
     *
     * @param string $query sql query
     * @param array $params input parameters (name=>value) for the SQL execution
     *
     * @return integer number of rows affected by the execution.
     */
    public function execute($query, array $params = null)
    {
        // TODO: Implement execute() method.
        try {

            $stmt = $this->query($query, $params);

            $count = $stmt->rowCount();

            return $count;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * Returns the last query execution time in seconds
     *
     * @return float query time in seconds
     */
    public function getLastQueryTime()
    {
        // TODO: Implement getLastQueryTime() method.

        return $this->stamp;
    }

    /**
     * Returns time in milliseconds
     *
     * @param $time_start
     *
     * @return mixed
     */
    public function queryTime($time_start)
    {
        $this->stamp = microtime(true) - $time_start;

        return true;
    }

}