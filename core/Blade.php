<?php

namespace Core;


use Jenssegers\Blade\Blade as BladeEngine;


class Blade
{
	private static ?BladeEngine $instance = null;
	
	public static function getInstance(): BladeEngine
	{
		if (self::$instance === null) {
			$views = __DIR__ . '/../resources/views';
			$cache = __DIR__ . '/../storage/cache';
			
			self::$instance = new BladeEngine($views, $cache);
		}
		
		return self::$instance;
	}
}
