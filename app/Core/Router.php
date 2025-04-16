<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controllerAction)
    {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            $controllerInfo = $this->routes[$method][$uri];
            $controller = new $controllerInfo[0]();
            $action = $controllerInfo[1];
    
            return $controller->$action();
        }
    
        // Página não encontrada
        http_response_code(404);
        echo "Página não encontrada";
    }
}
