<?php

namespace Core\Http;

class Request
{
    // Lấy dữ liệu từ input
    public static function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    // Lấy dữ liệu từ query string
    public static function query(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    // Lấy tất cả dữ liệu đã được gửi đến server
    public static function all(): array
    {
        return array_merge($_GET, $_POST);
    }

    // Lấy phương thức yêu cầu
    public static function method(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    // Lấy URI
    public static function uri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    // Lấy dữ liệu đã được lọc
    public static function sanitize(string $key, $default = null)
    {
        $value = self::input($key, $default);
        if (is_string($value)) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $value;
    }

    // Kiểm tra xem yêu cầu có phải là Ajax không
    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Lấy địa chỉ IP của người dùng
    public static function ip(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
}
