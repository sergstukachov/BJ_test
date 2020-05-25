<?php

namespace controllers;

/**
 * Class HomeController
 * @package controllers
 */
class HomeController
{

    /**
     * @param $model
     * @param $alias
     * @return mixed
     */
    protected function loadModel($model, $alias)
    {
        $class = "\\models\\$model";
        
        return $this->{$alias} = new $class();
    }

    /**
     * @param $view
     */
    protected function display($view)
    {
        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/" . $view . ".phtml");
    }

    /**
     * @param $alias
     * @param $value
     */
    protected function data($alias, $value)
    {
        $this->{$alias} = $value;
    }

    /**
     * @param $template
     * @param array|null $data
     * @return string
     */
    public function generate($template, array $data = null)
    {
        if (!empty($data)) {
            extract($data);
        }
        ob_start();
        require_once($_SERVER["DOCUMENT_ROOT"] . "/views/" . $template . ".phtml");
        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }
}