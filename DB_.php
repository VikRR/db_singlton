<?php

class DB_
{
    private static $connect = null;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function getConnect()
    {
        $dns = 'mysql:host=' . HOST . '; dbname=' . DBNAME . '; charset=utf8;';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8',
        ];

        if (is_null(self::$connect)) {
            try {
                self::$connect = new PDO($dns, USER, PASS, $options);

            } catch (PDOException $e) {
                echo 'Error connecting to database' . $e->getMessage();

                return false;
            }

            return self::$connect;
        } else {

            return self::$connect;
        }
    }
}
