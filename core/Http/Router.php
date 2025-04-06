<?php

namespace Core\Http;

class Router
{
    protected array $routes = [];
    protected array $middlewares = [];
    protected string $currentRoute = '';

    /**
     * Define HTTP methods
     */
    public function get(string $path, array $handler): self
    {
        return $this->add('GET', $path, $handler);
    }

    /**
     * Define POST method
     */
    public function post(string $path, array $handler): self
    {
        return $this->add('POST', $path, $handler);
    }

    /**
     * Define PUT method
     */
    public function put(string $path, array $handler): self
    {
        return $this->add('PUT', $path, $handler);
    }

    /**
     * Define DELETE method
     */
    public function delete(string $path, array $handler): self
    {
        return $this->add('DELETE', $path, $handler);
    }

    /**
     * Add a route
     */
    private function add(string $method, string $path, array $handler): self
    {
        $this->currentRoute = $path; // Mark the current route
        $this->routes[] = [
          'method' => strtoupper($method),
          'path' => $path,
          'handler' => $handler,
        ];

        return $this; // Allow chaining
    }

    /**
     * Add middleware
     */
    public function middleware(string $middleware): self
    {
        $this->middlewares[$this->currentRoute] = $middleware;

        return $this;
    }

    /**
     * Dispatch request
     */
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        foreach ($this->routes as $route) {
            if ($this->match($route['path'], $requestUri) && $route['method'] === $requestMethod) {
                // Process middleware
                if (isset($this->middlewares[$route['path']])) {
                    $middleware = $this->middlewares[$route['path']];
                    if (! Middleware::resolve($middleware)) {
                        return;
                    }
                }

                // Process controller and action
                $this->callHandler($route['handler'], $this->extractParams($route['path'], $requestUri));

                return;
            }
        }

        http_response_code(404);
        echo "404 - Page not found.";
    }

    /**
     * Match the route
     */
    private function match(string $routePath, string $requestUri): bool
    {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $routePath);

        return preg_match('#^' . $routeRegex . '$#', $requestUri);
    }

    /**
     * Extract parameters from the route
     */
    private function extractParams(string $routePath, string $requestUri): array
    {
        $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_]+)', $routePath);
        preg_match('#^' . $routeRegex . '$#', $requestUri, $matches);

        return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    }

    /**
     * Call the handler
     */
    private function callHandler(array $handler, array $params)
    {
        [$controller, $action] = $handler;
        $controller = 'App\\Controllers\\' . $controller;

        if (class_exists($controller)) {
            $controllerObject = new $controller();
            if (method_exists($controllerObject, $action)) {
                call_user_func_array([$controllerObject, $action], $params);
            } else {
                echo "Action '$action' does not exist.";
            }
        } else {
            echo "Controller '$controller' does not exist.";
        }
    }
}
