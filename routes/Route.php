<?php

namespace routes;

use \configs\Config;

/**
 * Class Route
 * @package routes
 */
class Route
{
    /**
     * @var
     */
    private static $instance;

    /**
     * Route constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return Route
     */
    public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Route();
        }

        return self::$instance;
    }
    
    public function routing()
    {

        $routes = Config::getRoutes();
        for ($i = 0, $count = count($routes); $i < $count; $i++) {
            if ($_SERVER["REQUEST_METHOD"] === $routes[$i]["method"]
                && parse_url($_SERVER["REQUEST_URI"])['path'] === $routes[$i]["uri"]) {
                $controllerName = new $routes[$i]["controller"];
                $action = $routes[$i]["action"];
                $response = $controllerName->$action();

                if ($response) {
                    echo $response;
                } else {
                    break;
                }
            }
        }
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