<?php

namespace Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Twig
{
    private static ?Environment $instance = null;

    /**
     * Get the instance of Twig
     */
    public static function getInstance(): Environment
    {
        if (self::$instance === null) {
            $loader = new FilesystemLoader(BASE_PATH . '/resources/views');
            self::$instance = new Environment($loader, [
              'cache' => BASE_PATH . '/storage/cache',
              'auto_reload' => true,
            ]);

            // Add the helper functions
            self::addHelpers();
        }

        return self::$instance;
    }

    /**
     * Add the helper functions
     */
    private static function addHelpers(): void
    {
        $instance = self::$instance;

        // Add the asset function
        $instance->addFunction(new TwigFunction('asset', function ($path) {
            return '/assets/' . ltrim($path, '/');
        }));

        // Add the url function
        $instance->addFunction(new TwigFunction('url', function ($path) {
            return '/' . ltrim($path, '/');
        }));

        // Add the session function
        $instance->addFunction(new TwigFunction('session', function ($key, $default = null) {
            return Session::get($key, $default);
        }));

        // Add the flash function
        $instance->addFunction(new TwigFunction('flash', function ($key) {
            return Session::flash($key);
        }));

        // Add the vite_assets function
        $instance->addFunction(new TwigFunction('vite_assets', function ($entry = 'resources/js/app.js') {
            return vite_assets($entry);
        }));
    }
}
