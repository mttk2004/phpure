<?php

namespace Core;

class Event
{
    private static array $listeners = [];

    /**
     * Đăng ký một listener cho sự kiện.
     */
    public static function listen(string $event, string $listenerClass): void
    {
        if (!class_exists($listenerClass)) {
            throw new \Exception("Listener class '$listenerClass' not found.");
        }

        self::$listeners[$event][] = $listenerClass;
    }

    /**
     * Kích hoạt sự kiện.
     */
    public static function dispatch(string $event, ...$payload): void
    {
        if (!isset(self::$listeners[$event])) {
            return; // Không có listener nào cho sự kiện
        }

        foreach (self::$listeners[$event] as $listenerClass) {
            $listener = new $listenerClass();

            if (!method_exists($listener, 'handle')) {
                throw new \Exception("Listener class '$listenerClass' must have a handle() method.");
            }

            $listener->handle(...$payload);
        }
    }

    /**
     * Liệt kê tất cả các sự kiện và listener đã đăng ký (debugging).
     */
    public static function list(): array
    {
        return self::$listeners;
    }
}
