<?php

namespace Core;


class Event
{
	private static array $listeners = [];
	
	/**
	 * Đăng ký một listener cho sự kiện
	 */
	public static function listen(string $event, callable|array $listener): void
	{
		self::$listeners[$event][] = $listener;
	}
	
	/**
	 * Kích hoạt sự kiện
	 */
	public static function dispatch(string $event, ...$payload): void
	{
		if (!isset(self::$listeners[$event])) {
			return; // Không có listener nào cho sự kiện
		}
		
		foreach (self::$listeners[$event] as $listener) {
			if (is_callable($listener)) {
				call_user_func($listener, ...$payload);
			} else if (is_array($listener) && count($listener) === 2) {
				[$class, $method] = $listener;
				(new $class())->$method(...$payload);
			}
		}
	}
}
