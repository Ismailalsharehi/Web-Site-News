<?php

namespace Core;

class Routers
{
    private array $routes = [];

    public function get(string $uri, string $controller): void
    {
        $this->addRoute('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): void
    {
        $this->addRoute('POST', $uri, $controller);
    }

    public function put(string $uri, string $controller): void
    {
        $this->addRoute('PUT', $uri, $controller);
    }

    public function delete(string $uri, string $controller): void
    {
        $this->addRoute('DELETE', $uri, $controller);
    }

    

    private function addRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];
    }

    public function route(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && strtoupper($method) === $route['method']) {
                if (file_exists($route['controller'])) {
                    require $route['controller'];
                    return;
                } else {
                    http_response_code(500);
                    echo "File not found: {$route['controller']}";
                    return;
                }
            }
        }

        // If no match found
        http_response_code(404);
        include __DIR__ . '/../View/errors/404.php';
    }
}
