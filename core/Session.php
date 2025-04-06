<?php

namespace Core;

class Session
{
    /**
     * Start the session if it is not already started
     */
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session value
     */
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session value
     */
    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Check if a session exists
     */
    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session value
     */
    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy all sessions
     */
    public static function destroy(): void
    {
        session_destroy();
    }

    /**
     * Flash a message
     */
    public static function flash(string $key, $message = null)
    {
        // If only getting the value
        if ($message === null) {
            $value = self::get($key);
            self::remove($key);

            return $value;
        }

        // Set the value
        self::set($key, $message);
    }
}
