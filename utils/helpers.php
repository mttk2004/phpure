<?php

/**
 * Root path of the application
 */
function requireRoot($path): void
{
    require_once BASE_PATH . '/' . $path;
}

/**
 * Redirect to a URL
 */
function redirect($url): void
{
    header("Location: $url");
    exit;
}

/**
 * Dump data and stop the program (quick debug)
 */
function dd($data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit;
}

/**
 * Sanitize input data
 */
function sanitizeInput($input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Abort the program
 */
function abort($code = 403)
{
    http_response_code($code);
    echo "$code - Access Denied.";
    exit;
}

/**
 * Load environment variables
 */
function loadEnv(): void
{
    $envPath = BASE_PATH . '/.env';
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

/**
 * Get configuration from files in the config directory
 *
 * @param string $key Configuration key (e.g. app.name, database.connections.mysql)
 * @param mixed $default Default value if not found
 * @return mixed Configuration value
 */
function config(string $key, $default = null)
{
    static $config = [];

    // If configuration is loaded, return the value from the cache
    if (isset($config[$key])) {
        return $config[$key];
    }

    // Split the key into file parts and parameters
    $parts = explode('.', $key);
    $file = array_shift($parts);

    // Path to the configuration file
    $filePath = BASE_PATH . '/config/' . $file . '.php';

    // Check if the file does not exist
    if (! file_exists($filePath)) {
        return $default;
    }

    // Load configuration from file
    $configData = require $filePath;

    // If there is no sub-key, return the entire configuration
    if (empty($parts)) {
        $config[$key] = $configData;

        return $configData;
    }

    // Find the value based on the sub-key
    $value = $configData;
    foreach ($parts as $part) {
        if (! isset($value[$part])) {
            return $default;
        }
        $value = $value[$part];
    }

    // Save to the cache and return
    $config[$key] = $value;

    return $value;
}

/**
 * Throw an Exception when the condition is met
 * @throws Exception
 */
function throw_if(bool $condition, string $message): void
{
    if ($condition) {
        throw new \Exception($message);
    }
}

/**
 * Integrate Vite with the PHP environment
 * In the development environment, it will connect to the Vite dev server
 * In the production environment, it will use the built resources
 */
function vite_assets($entry = 'resources/js/app.js'): string
{
    $isDev = getenv('APP_ENV') === 'local' || getenv('APP_ENV') === 'development';
    $devServerIsRunning = false;

    // Check if the Vite dev server is running
    if ($isDev) {
        $handle = @fsockopen('localhost', 5173);
        $devServerIsRunning = $handle !== false;
        if ($handle) {
            fclose($handle);
        }
    }

    if ($isDev && $devServerIsRunning) {
        // Use the Vite dev server
        return <<<HTML
            <script type="module" src="http://localhost:5173/@vite/client"></script>
            <script type="module" src="http://localhost:5173/$entry"></script>
        HTML;
    } else {
        // Use the built resources (add a check to see if the file exists)
        $styles_path = BASE_PATH . '/public/assets/styles.css';
        $script_path = BASE_PATH . '/public/assets/app.js';

        // Check if the files have been built
        if (! file_exists($styles_path) || ! file_exists($script_path)) {
            return '<div style="color: red; padding: 20px; font-family: sans-serif;">
                <h2>Resource Error</h2>
                <p>The resource files have not been built. Please run <code>npm run build</code> before starting the server.</p>
                </div>';
        }

        $timestamp = time(); // Add timestamp to avoid cache

        return <<<HTML
            <link rel="stylesheet" href="/assets/styles.css?v=$timestamp">
            <script type="module" src="/assets/app.js?v=$timestamp"></script>
        HTML;
    }
}
