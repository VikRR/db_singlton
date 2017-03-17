<?php

include 'DBQueryInterface.php';

class DBQuery implements DBQueryInterface
{

    private $pdo;
    public static $stamp = 0;
    //private $timestamp;

    /**
     * Create new instance DBQuery.
     *
     * @param DBConnectionInterface $DBConnection
     */
    public function __construct(DBConnectionInterface $DBConnection)
    {
        //parent::__construct($DBConnection);
        $this->pdo = $DBConnection;
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
        $this->pdo = $DBConnection;
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
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $res = $sttm->execute($params);
            } else {
                $res = $sttm->execute();
            }
            self::$stamp = time();

            return $res;
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
        try {
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $sttm->execute($params);
            } else {
                $sttm->execute();
            }
            $row = $sttm->fetchAll(PDO::FETCH_ASSOC);
            self::$stamp = time();

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
        $data = array();
        try {
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $sttm->execute($params);
            } else {
                $sttm->execute();
            }
            $row = $sttm->fetch(PDO::FETCH_ASSOC);
            $data[] = $row;
            self::$stamp = time();

            return $data;
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
        $data = array();
        try {
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $sttm->execute($params);
            } else {
                $sttm->execute();
            }
            while ($row = $sttm->fetchColumn()) {
                $data[] = $row;
            }
            self::$stamp = time();

            return $data;
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
        try {
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $sttm->execute($params);
            } else {
                $sttm->execute();
            }
            $row = $sttm->fetchColumn();
            self::$stamp = time();

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
        try {
            $sttm = $this->pdo->prepare($query);
            if ($params) {
                $sttm->execute($params);
            } else {
                $sttm->execute();
            }
            $count = $sttm->rowCount();
            self::$stamp = time();

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
        $sec = time() - self::$stamp = time();

        return $sec;
    }

}