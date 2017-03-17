<?php

include 'DBConnectionInterface.php';

class DB extends PDO implements DBConnectionInterface
{

    private static $instance;

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
        if (is_null(self::$instance)) {
            try {
                self::$instance = new self($dsn, $username, $password);
            } catch (PDOException $e) {
                echo 'Error connecting for database. ' . $e->getMessage();
            }

            return self::$instance;
        } else {

            return self::$instance;
        }
    }

    /**
     * Completes the current session connection, and creates a new.
     *
     * @return void
     */
    public function reconnect()
    {
        // TODO: Implement reconnect() method.
        session_destroy();
        session_name('function reconnect');
        session_start();
        $_SESSION['name'] = 'Petya';
        session_status();
    }

    /**
     * Returns the PDO instance.
     *
     * @return PDO the PDO instance, null if the connection is not established yet
     */
    public function getPdoInstance()
    {
        // TODO: Implement getPdoInstance() method.
        if (is_null(self::$instance)) {
            return null;
        }
        return self::$instance;
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
        if ($sequenceName) {
            self::$instance->lastInsertId($sequenceName);
        } else {
            self::$instance->lastInsertId();
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
        if (!is_null(self::$instance)) {
            self::$instance = null;
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
            self::$instance->setAttribute($attribute, $value);
        } catch (PDOException $e) {
            echo 'Error get attribute. ' . $e->getMessage();
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

            return self::$instance->getAttribute($attribute);
        } catch (PDOException $e) {
            echo 'Error get attribute. ' . $e->getMessage();
        }
    }
}