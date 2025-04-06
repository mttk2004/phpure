<?php

namespace Core;

class Event
{
    private static array $listeners = [];

    /**
     * Register a listener for an event.
     */
    public static function listen(string $event, string $listenerClass): void
    {
        if (! class_exists($listenerClass)) {
            throw new \Exception("Listener class '$listenerClass' not found.");
        }

        self::$listeners[$event][] = $listenerClass;
    }

    /**
     * Dispatch an event.
     */
    public static function dispatch(string $event, ...$payload): void
    {
        if (! isset(self::$listeners[$event])) {
            return; // No listener for the event
        }

        foreach (self::$listeners[$event] as $listenerClass) {
            $listener = new $listenerClass();

            if (! method_exists($listener, 'handle')) {
                throw new \Exception("Listener class '$listenerClass' must have a handle() method.");
            }

            $listener->handle(...$payload);
        }
    }

    /**
     * List all events and listeners (debugging).
     */
    public static function list(): array
    {
        return self::$listeners;
    }
}
