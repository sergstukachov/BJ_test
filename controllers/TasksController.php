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
    public function mainPage($message= null)
    {
                if (isset($_GET["pa"]))
        {
            $page = $_GET["pa"];
        } else
        {
            $page = 1;
        }

        var_dump($_GET);
        $tasksModel = $this->loadModel("Tasks", "task");
        $tasks = $tasksModel->getFullList($page);
        return $this->generate("index", ['tasks' => $tasks, 'message'=> $message]);
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