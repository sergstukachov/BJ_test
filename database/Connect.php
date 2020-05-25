<?php

namespace database;

/**
 * Class Connect
 * @package database
 */
class Connect
{
    /**
     * @var
     */
    private static $instance;
    /**
     * @var \mysqli
     */
    private $mysqli;

    /**
     * Connect constructor.
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $nameDb
     * @param $charset
     */
    private function __construct($host, $port, $user, $password, $nameDb, $charset)
    {
        $this->mysqli = new \mysqli($host . ":" . $port, $user, $password, $nameDb);
        $this->mysqli->set_charset($charset);
    }

    /**
     * @param $host
     * @param $port
     * @param $user
     * @param $password
     * @param $nameDb
     * @param $charset
     * @return Connect
     */
    public static function getInstance($host, $port, $user, $password, $nameDb, $charset)
    {
        if (self::$instance === null) {
            self::$instance = new self($host, $port, $user, $password, $nameDb, $charset);
        }

        return self::$instance;
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql)
    {
        $result = $this->mysqli->query($sql);


        return $result;
    }

    /**
     * @param $value
     * @return string
     */
    public function realEscape($value)
    {
        return $this->mysqli->real_escape_string($value);
    }
    
    public function __destruct()
    {
        $this->mysqli->close();
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }
}