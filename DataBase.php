<?php

include_once 'DBConnectionInterface.php';


class DataBase implements DBConnectionInterface
{

    private static $instance;
    private static $dsn;
    private static $username;
    private static $password;
    private $pdo;

    private function __construct()
    {
        try {
            $this->pdo = new PDO(self::$dsn, self::$username, self::$password);
        } catch (PDOException $e) {
            echo 'Error connecting for database. ' . $e->getMessage();
        }
    }

    private function __clone()
    {

    }

    /**
     * Creates new instance representing a connection to a database
     * @param string $dsn The Data Source Name, or DSN, contains the information required to connect to the database.
     *
     * @param string $username The user name for the DSN string.
     * @param string $password The password for the DSN string.
     * @see http://www.php.net/manual/en/function.PDO-construct.php
     * @throws  PDOException if the attempt to connect to the requested database fails.
     *
     * @return $this DB
     */
    public static function connect($dsn, $username = '', $password = '')
    {
        // TODO: Implement connect() method.
        self::$dsn = $dsn;
        self::$username = $username;
        self::$password = $password;

        if (is_null(self::$instance)) {
            self::$instance = new self($dsn, $username = '', $password = '');
        }

        return self::$instance;
    }

    /**
     * Completes the current session connection, and creates a new.
     *
     * @return void
     */
    public function reconnect()
    {
        // TODO: Implement reconnect() method.
        $this->pdo = null;
        $this->pdo = new PDO(self::$dsn, self::$username, self::$password);
    }

    /**
     * Returns the PDO instance.
     *
     * @return PDO the PDO instance, null if the connection is not established yet
     */
    public function getPdoInstance()
    {
        // TODO: Implement getPdoInstance() method.

        return $this->pdo;
    }

    /**
     * Returns the ID of the last inserted row or sequence value.
     *
     * @param string $sequenceName name of the sequence object (required by some DBMS)
     *
     * @return string the row ID of the last row inserted, or the last value retrieved from the sequence object
     * @see http://www.php.net/manual/en/function.PDO-lastInsertId.php
     */
    public function getLastInsertID($sequenceName = '')
    {
        // TODO: Implement getLastInsertID() method.
        try {

            return $this->pdo->lastInsertId($sequenceName);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Closes the currently active DB connection.
     * It does nothing if the connection is already closed.
     *
     * @return void
     */
    public function close()
    {
        // TODO: Implement close() method.
        try {
            if (!is_null($this->pdo)) {
                $this->pdo = null;
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Sets an attribute on the database handle.
     * Some of the available generic attributes are listed below;
     * some drivers may make use of additional driver specific attributes.
     *
     * @param int $attribute
     * @param mixed $value
     *
     * @return bool
     * @see http://php.net/manual/en/pdo.setattribute.php
     */
    public function setAttribute($attribute, $value)
    {
        // TODO: Implement setAttribute() method.
        try {

            return $this->pdo->setAttribute($attribute, $value);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Returns the value of a database connection attribute.
     *
     * @param int $attribute
     *
     * @return mixed
     * @see http://php.net/manual/en/pdo.setattribute.php
     */
    public function getAttribute($attribute)
    {
        // TODO: Implement getAttribute() method.
        try {

            return $this->pdo->getAttribute($attribute);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }
}