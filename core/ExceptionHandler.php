<?php

namespace Core;

use Exception;

class ExceptionHandler
{
    public static function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
    }

    public static function handleException(\Throwable $exception): void
    {
        // Ghi log lỗi
        Logger::error($exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ]);

        // Hiển thị trang lỗi
        if (getenv('APP_ENV') === 'production') {
            http_response_code(500);
            echo Twig::getInstance()->render('errors/500.html.twig');
        } else {
            // Hiển thị chi tiết lỗi trong môi trường phát triển
            http_response_code(500);
            echo '<h1>Lỗi: ' . $exception->getMessage() . '</h1>';
            echo '<p>File: ' . $exception->getFile() . ' (' . $exception->getLine() . ')</p>';
            echo '<pre>' . $exception->getTraceAsString() . '</pre>';
        }
    }

    public static function handleError($level, $message, $file, $line): bool
    {
        if (error_reporting() & $level) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }

        return true;
    }
}
