<?php

namespace Core\Http;

class Request
{
    /**
     * Get data from input
     */
    public static function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    /**
     * Get data from query string
     */
    public static function query(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get all data sent to the server
     */
    public static function all(): array
    {
        return array_merge($_GET, $_POST);
    }

    /**
     * Get the request method
     */
    public static function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    /**
     * Get the URI
     */
    public static function uri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    /**
     * Get the sanitized data
     */
    public static function sanitize(string $key, $default = null)
    {
        $value = self::input($key, $default);
        if (is_string($value)) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        return $value;
    }

    /**
     * Check if the request is an Ajax request
     */
    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Get the IP address of the user
     */
    public static function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
}
