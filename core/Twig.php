<?php

namespace Core;

use Twig\Environment;
use Twig\TwigFunction;
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

            // Thêm các hàm tiện ích
            self::addHelpers();
        }

        return self::$instance;
    }

    private static function addHelpers(): void
    {
        $instance = self::$instance;

        // Thêm hàm asset
        $instance->addFunction(new TwigFunction('asset', function ($path) {
            return '/assets/' . ltrim($path, '/');
        }));

        // Thêm hàm url
        $instance->addFunction(new TwigFunction('url', function ($path) {
            return '/' . ltrim($path, '/');
        }));

        // Thêm hàm session
        $instance->addFunction(new TwigFunction('session', function ($key, $default = null) {
            return Session::get($key, $default);
        }));

        // Thêm hàm flash
        $instance->addFunction(new TwigFunction('flash', function ($key) {
            return Session::flash($key);
        }));
    }
}
