<?php

namespace Core;


use Exception;


class ExceptionHandler
{
	public static function handle(
			bool $condition,
			string $message,
			string $exceptionClass = Exception::class,
	): void {
		if ($condition) {
			// Nếu cần, ghi log tại đây trước khi ném Exception
			Logger::error($message); // Yêu cầu Logger đã được tích hợp
			throw new $exceptionClass($message);
		}
	}
}
