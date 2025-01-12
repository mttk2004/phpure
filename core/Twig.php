<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Twig
{
    private static ?Environment $instance = null;

    public static function getInstance(): Environment
    {
        if (self::$instance === null) {
            $loader = new FilesystemLoader(BASE_PATH . '/resources/views');
            self::$instance = new Environment($loader, [
                    'cache' => BASE_PATH . '/storage/cache',
                    'auto_reload' => true,
            ]);
        }

        return self::$instance;
    }
}
