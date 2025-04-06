<?php

namespace Core;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class App
{
    /**
     * Bootstrap the application
     */
    public static function bootstrap(): void
    {
        // 1. Load environment variables
        loadEnv();

        // 2. Set the default timezone from the configuration
        date_default_timezone_set(config('app.timezone', 'Asia/Ho_Chi_Minh'));

        // 3. Enable Whoops if debug mode is enabled
        if (config('app.debug', true)) {
            self::enableWhoops();
        }

        // 4. Start the session
        Session::start();

        // 5. Load the event and route configuration files
        require_once BASE_PATH . '/app/events.php';
        require_once BASE_PATH . '/app/routes.php';
    }

    /**
     * Enable Whoops
     */
    public static function enableWhoops(): void
    {
        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}
