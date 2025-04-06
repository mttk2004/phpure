<?php

namespace Core\Http;

use App\Middlewares\Auth;
use App\Middlewares\Guest;

class Middleware
{
    /**
     * List of middleware classes that can be registered
     */
    private const array MAP
        = [
          'auth' => Auth::class,
          'guest' => Guest::class,
          // TODO: Add more middleware here as needed
        ];

    /**
     * Process Middleware
     */
    public static function resolve(string $key): bool
    {
        // Check if the middleware exists in the MAP
        if (! isset(self::MAP[$key])) {
            throw new \Exception("Middleware '$key' does not exist!");
        }

        // Use a variable to store the middleware class
        $middlewareClass = self::MAP[$key];   // Extract the class from the MAP
        $middleware = new $middlewareClass(); // Initialize the middleware

        return $middleware->handle();         // Execute the middleware
    }
}
