<?php

include 'DBQueryInterface.php';

class DBQuery implements DBQueryInterface
{

    private $pdo;
    public $stamp = 0;
    //private $timestamp;

    /**
     * Create new instance DBQuery.
     *
     * @param DBConnectionInterface $DBConnection
     */
    public function __construct(DBConnectionInterface $DBConnection)
    {
        //parent::__construct($DBConnection);
        $this->pdo = $DBConnection->pdo;
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
        $this->pdo = $DBConnection->pdo;
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $stmt->execute($params);
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $row;
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $row;
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $row = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $row;
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $row = $stmt->fetchColumn();

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $row;
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        $time_start = $this->queryTime();
        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute($params);

            $count = $stmt->rowCount();

            $time_stop = $this->queryTime();

            $this->stamp = $time_stop - $time_start;

            return $count;
        } catch (PDOException $e) {

            return 'Error query: ' . $e->getMessage();
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
        //$sec = time() - $this->stamp;

        return $this->stamp;
    }

    /**
     * Returns time in milliseconds
     *
     * @return mixed
     */
    public function queryTime()
    {

        return $time = microtime(true);
    }

}