<?php

namespace Core;


use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;


class Logger
{
	private static ?MonologLogger $logger = null;
	
	public static function getInstance(): MonologLogger
	{
		if (self::$logger === null) {
			// Tạo một instance của Monolog
			$logger = new MonologLogger('app');
			
			// Thêm một StreamHandler để ghi log ra file
			$logPath = BASE_PATH . '/storage/logs/app.log';
			$logger->pushHandler(new StreamHandler($logPath, MonologLogger::DEBUG));
			
			self::$logger = $logger;
		}
		
		return self::$logger;
	}
	
	public static function debug(string $message, array $context = []): void
	{
		self::getInstance()->debug($message, $context);
	}
	
	public static function info(string $message, array $context = []): void
	{
		self::getInstance()->info($message, $context);
	}
	
	public static function warning(string $message, array $context = []): void
	{
		self::getInstance()->warning($message, $context);
	}
	
	public static function error(string $message, array $context = []): void
	{
		self::getInstance()->error($message, $context);
	}
}
