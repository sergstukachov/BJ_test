<?php

namespace models;

use \database\Connect;

/**
 * Class Model
 * @package models
 */
abstract class Model
{
    /**
     * @var Connect
     */
    private $db;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $host = "localhost";
        $port = 3306;
        $user = "root";
        $password = "333";
        $nameDb = "tasks";
        $charset = "utf8";
        $this->db = Connect::getInstance($host, $port, $user, $password, $nameDb, $charset);
    }

    /**
     * @param $sql
     * @param array $prepared
     * @return array
     */
    public function sql($sql, $prepared = [])
    {
        for ($i = 0, $count = count($prepared); $i < $count; $i++) {
            $value = $this->db->realEscape($prepared[$i]["value"]);
            $sql = str_replace($prepared[$i]["statement"], $value, $sql);
        }

        return $this->db->query($sql);
    }

    /**
     * @return array
     */
    public function getList()
    {
        return $this->sql("SELECT * FROM `" . $this->tableName() . "`");
    }

    /**
     * @return mixed
     */
    abstract protected function tableName();
}