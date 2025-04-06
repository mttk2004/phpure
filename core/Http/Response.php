<?php

namespace Core\Http;

class Response
{
    /**
     * Send a JSON response
     */
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Redirect to a URL
     */
    public static function redirect(string $url, int $status = 302): void
    {
        http_response_code($status);
        header("Location: $url");
        exit;
    }

    /**
     * Send a response
     */
    public static function send(string $content, int $status = 200): void
    {
        http_response_code($status);
        echo $content;
    }

    /**
     * Set a header
     */
    public static function setHeader(string $name, string $value): void
    {
        header("$name: $value");
    }
}
