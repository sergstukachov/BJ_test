<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 19.05.20
 * Time: 13:24
 */

namespace models;

use \database\Connect;

class Tasks extends Model
{
    protected $count = 3;// Number of records per page

    /**
     * Tasks constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    protected function tableName()
    {
        return "tasks";
    }

    /**
     * @return array
     */
    public function getFullList()
    {
        return $this->sql("SELECT * FROM tasks JOIN tasks_status ON tasks.status_id = tasks_status.id");
    }

    /**
     * @param $name
     * @param $email
     * @param $task
     * @return array
     */
    public function save($name, $email, $task)
    {
        return $this->sql("INSERT INTO tasks ( name,email,task ) VALUES (' " . $name . "  ',' " . $email . " ',' " . $task . "')");
    }

    /**
     * @param $page
     * @return array
     */
    public function getPagination($page)
    {

//        return $this->sql("SELECT * FROM tasks JOIN tasks_status ON tasks.status_id = tasks_status.id");
        $shift = $this->count * ($page - 1);
        $result_set = $this->sql("SELECT * FROM `tasks` JOIN tasks_status ON tasks.status_id = tasks_status.id LIMIT $shift, $this->count");

        return $result_set;
    }

    /**
     * @return array
     */
    public function getCountItems()
    {
        $itemsTemp = $this->sql('SELECT * FROM tasks');
        $items =  mysqli_num_rows(  $itemsTemp);
        $countItems = ceil($items / $this->count);

        return $countItems;

    }

}