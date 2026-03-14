<?php
/**
 * Router — Simple URL Routing
 */

class Router
{
    private array $routes = [];

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Trailing Slash entfernen (ausser Root)
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];
            [$controller, $action] = explode('::', $handler);

            // Controller-Klasse laden
            $controllerFile = __DIR__ . "/Controllers/{$controller}.php";
            if (!file_exists($controllerFile)) {
                $this->sendNotFound();
                return;
            }
            require_once $controllerFile;

            // Namespace-freier Klassenname
            $className = basename(str_replace('\\', '/', $controller));
            if (class_exists($className) && method_exists($className, $action)) {
                $className::$action();
            } else {
                $this->sendNotFound();
            }
        } else {
            $this->sendNotFound();
        }
    }

    private function sendNotFound(): void
    {
        http_response_code(404);

        if (str_starts_with($_SERVER['REQUEST_URI'], '/api/')) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Not Found']);
        } else {
            echo '<h1>404 — Seite nicht gefunden</h1>';
        }
    }
}
