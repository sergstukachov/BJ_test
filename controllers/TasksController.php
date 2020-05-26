<?php


namespace controllers;

/**
 * Class TasksController
 * @package controllers
 */
class TasksController extends HomeController
{
    /**
     * @return string
     */
    public function list()
    {
        $tasks = $this->getModelTasks()->getList();
        return $this->generate("tasks", ["tasks" => $tasks]);
    }

    /**
     * @return mixed
     */
    public function getModelTasks()
    {
        return $this->loadModel("Tasks", "task");
    }


    /**
     * @param null $message
     * @return string
     */
    public function mainPage()
    {
                if (isset($_GET["page"]))
        {
            $page = $_GET["page"];
        } else
        {
            $page = 1;
        }
        $tasksModel = $this->loadModel("Tasks", "task");
        $countItems= $tasksModel->getCountItems();
        $tasks = $tasksModel->getPagination($page);
        return $this->generate("index", ['tasks' => $tasks, 'countItems' => $countItems]);
    }

    /**
     * @return bool|string
     */
    public function save()
    {
        try {
            $tasksModel = $this->getModelTasks();
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $task = trim($_POST['task']);
            
            $tasksModel->save($name, $email, $task);
            return true;
//            return $this->mainPage();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        

    }
}