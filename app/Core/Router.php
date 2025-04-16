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

    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
    }
    
    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
    
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }
    
        $uri = parse_url($uri, PHP_URL_PATH);
    
        if (isset($this->routes[$method][$uri])) {
            $controllerInfo = $this->routes[$method][$uri];
            
            $controller = new $controllerInfo[0]();
            
            $action = $controllerInfo[1];
            
            return $controller->$action();
        }
    
        foreach ($this->routes[$method] as $route => $controllerInfo) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
            
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                $controller = new $controllerInfo[0]();
                
                $action = $controllerInfo[1];
    
                array_shift($matches);
    
                return $controller->$action(...$matches);
            }
        }
    
        http_response_code(404);
        echo "Página não encontrada";
    }
    
}
