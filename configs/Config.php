<?php

namespace configs;

/**
 * Class Config
 * @package configs
 */
class Config
{
    /**
     * @return array
     */
    public static function getRoutes()
    {
        return [
            [

                "uri" => "/test",
                "controller" => "\controllers\TasksController",
                "action" => "mainPage",
                "method" => "GET",
            ], [
                "uri" => "/list/tasks/",
                "controller" => "\controllers\TasksController",
                "action" => "list",
                "method" => "GET",
            ],[
                "uri" => "/save/tasks/",
                "controller" => "\controllers\TasksController",
                "action" => "save",
                "method" => "POST",
            ]
        ];
    }
}