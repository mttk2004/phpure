<?php

namespace Core;

class Session
{
    // Bắt đầu session nếu chưa có
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Đặt giá trị session
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    // Lấy giá trị session
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    // Kiểm tra tồn tại session
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    // Xóa session
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    // Hủy toàn bộ session
    public static function destroy(): void
    {
        session_destroy();
    }

    // Flash message
    public static function flash(string $key, $message = null)
    {
        // Nếu chỉ lấy giá trị
        if ($message === null) {
            $value = self::get($key);
            self::remove($key);

            return $value;
        }

        // Nếu thiết lập giá trị
        self::set($key, $message);
    }
}
