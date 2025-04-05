<?php

namespace Core\Http;

class Router
{
    protected array $routes = [];
    protected array $middlewares = [];
    protected string $currentRoute = '';

    // Định nghĩa các phương thức HTTP
    public function get(string $path, array $handler): self
    {
        return $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): self
    {
        return $this->add('POST', $path, $handler);
    }

    public function put(string $path, array $handler): self
    {
        return $this->add('PUT', $path, $handler);
    }

    public function delete(string $path, array $handler): self
    {
        return $this->add('DELETE', $path, $handler);
    }

    private function add(string $method, string $path, array $handler): self
    {
        $this->currentRoute = $path; // Đánh dấu route hiện tại
        $this->routes[] = [
                'method' => strtoupper($method),
                'path' => $path,
                'handler' => $handler,
        ];

        return $this; // Cho phép chaining
    }

    // Thêm middleware
    public function middleware(string $middleware): self
    {
        $this->middlewares[$this->currentRoute] = $middleware;

        return $this;
    }

    // Dispatch request
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        foreach ($this->routes as $route) {
            if ($this->match($route['path'], $requestUri) && $route['method'] === $requestMethod) {
                // Xử lý middleware
                if (isset($this->middlewares[$route['path']])) {
                    $middleware = $this->middlewares[$route['path']];
                    if (! Middleware::resolve($middleware)) {
                        return;
                    }
                }

                // Xử lý controller và action
                $this->callHandler($route['handler'], $this->extractParams($route['path'], $requestUri));

                return;
            }
        }

        http_response_code(404);
        echo "404 - Không tìm thấy trang.";
    }

    private function match(string $routePath, string $requestUri): bool
    {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $routePath);

        return preg_match('#^' . $routeRegex . '$#', $requestUri);
    }

    private function extractParams(string $routePath, string $requestUri): array
    {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_]+)', $routePath);
        preg_match('#^' . $routeRegex . '$#', $requestUri, $matches);

        return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    private function callHandler(array $handler, array $params)
    {
        [$controller, $action] = $handler;
        $controller = 'App\\Controllers\\' . $controller;

        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (method_exists($controllerObject, $action)) {
                call_user_func_array([$controllerObject, $action], $params);
            } else {
                echo "Action '$action' không tồn tại.";
            }
        } else {
            echo "Controller '$controller' không tồn tại.";
        }
    }
}
