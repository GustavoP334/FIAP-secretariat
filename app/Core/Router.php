<?php

namespace App\Core;

class Router {
    protected $routes = [];

    public function get($uri, $controllerAction) {
        $this->routes['GET'][$uri] = $controllerAction;
    }

    public function dispatch($uri) {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($uri, PHP_URL_PATH);

        if (isset($this->routes[$method][$uri])) {
            [$controller, $action] = explode('@', $this->routes[$method][$uri]);
            $controller = "App\\Controllers\\{$controller}";
            (new $controller)->$action();
        } else {
            http_response_code(404);
            echo "Página não encontrada!";
        }
    }
}
