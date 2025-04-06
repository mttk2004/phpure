<?php

namespace Core;

class ExceptionHandler
{
    /**
     * Register the exception handler
     */
    public static function register(): void
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
    }

    /**
     * Handle exceptions
     */
    public static function handleException(\Throwable $exception): void
    {
        // Log the error
        Logger::error($exception->getMessage(), [
          'file' => $exception->getFile(),
          'line' => $exception->getLine(),
          'trace' => $exception->getTraceAsString(),
        ]);

        // Display the error page
        if (getenv('APP_ENV') === 'production') {
            http_response_code(500);
            echo Twig::getInstance()->render('errors/500.html.twig');
        } else {
            // Display the error details in the development environment
            http_response_code(500);
            echo '<h1>Error: ' . $exception->getMessage() . '</h1>';
            echo '<p>File: ' . $exception->getFile() . ' (' . $exception->getLine() . ')</p>';
            echo '<pre>' . $exception->getTraceAsString() . '</pre>';
        }
    }

    /**
     * Handle errors
     */
    public static function handleError($level, $message, $file, $line): bool
    {
        if (error_reporting() & $level) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }

        return true;
    }
}
