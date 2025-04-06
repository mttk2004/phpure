<?php

namespace Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;

class Logger
{
    private static ?MonologLogger $logger = null;

    /**
     * Get the instance of Monolog
     */
    public static function getInstance(): MonologLogger
    {
        if (self::$logger === null) {
            // Create an instance of Monolog
            $logger = new MonologLogger('app');

            // Add a StreamHandler to write logs to a file
            $logPath = BASE_PATH . '/storage/logs/app.log';
            $logger->pushHandler(new StreamHandler($logPath, MonologLogger::DEBUG));

            self::$logger = $logger;
        }

        return self::$logger;
    }

    /**
     * Log a debug message
     */
    public static function debug(string $message, array $context = []): void
    {
        self::getInstance()->debug($message, $context);
    }

    /**
     * Log an info message
     */
    public static function info(string $message, array $context = []): void
    {
        self::getInstance()->info($message, $context);
    }

    /**
     * Log a warning message
     */
    public static function warning(string $message, array $context = []): void
    {
        self::getInstance()->warning($message, $context);
    }

    /**
     * Log an error message
     */
    public static function error(string $message, array $context = []): void
    {
        self::getInstance()->error($message, $context);
    }
}
