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

    public function getPagination($page)
    {
       $count = 3;// Количество записей на странице

        $shift = $count * ($page - 1);// Смещение в LIMIT. Те записи, порядковый номер которого больше этого числа, будут выводиться.
        $result_set = $this->sql("SELECT * FROM `tasks` LIMIT $shift, $count");// Делаем выборку $count записей, начиная с $shift + 1.

return $result_set;
    }

}