# Advanced Techniques

## Database Relations with Many-to-Many

To work with many-to-many relationships, you can use the `belongsToMany()` method in your model:

```php
// User Model
public function roles()
{
    return $this->belongsToMany(
        Role::class,    // Related model
        'user_roles',   // Pivot table
        'user_id',      // Foreign key of current table
        'role_id',      // Foreign key of related table
        'id',           // Primary key of current table
        'id'            // Primary key of related table
    );
}

// Usage
$user = User::find(1);
$roles = $user->roles();
```

## Role-based Middleware

Create middleware to check user roles:

```php
<?php

namespace App\Middlewares;

use Core\Http\Middleware;
use Core\Session;
use App\Models\User;

class RoleMiddleware extends Middleware
{
    private array $allowedRoles;

    public function __construct(array $allowedRoles)
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(): bool
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            redirect('/login');
            return false;
        }

        $user = User::find($userId);
        $userRoles = $user->roles();

        foreach ($userRoles as $role) {
            if (in_array($role->name, $this->allowedRoles)) {
                return true;
            }
        }

        abort(403); // Access denied
        return false;
    }
}

// Register middleware
Middleware::register('role', \App\Middlewares\RoleMiddleware::class);

// Use in route
$router->get('/admin', ['AdminController', 'index'])->middleware('role:admin,super_admin');
```

## Command Line Interface (CLI)

You can create CLI commands for PHPure to automate tasks:

```php
<?php
// commands/generate.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../utils/helpers.php';

// Process command line arguments
$command = $argv[1] ?? null;
$name = $argv[2] ?? null;

if (!$command || !$name) {
    echo "Usage: php commands/generate.php [controller|model|middleware] [name]\n";
    exit(1);
}

switch ($command) {
    case 'controller':
        generateController($name);
        break;
    case 'model':
        generateModel($name);
        break;
    case 'middleware':
        generateMiddleware($name);
        break;
    default:
        echo "Invalid command. Valid commands: controller, model, middleware\n";
        exit(1);
}

function generateController($name)
{
    $template = <<<PHP
<?php

namespace App\Controllers;

use Core\Controller;

class {$name}Controller extends Controller
{
    public function index()
    {
        \$this->render('{$name}s/index');
    }

    public function show(\$id)
    {
        \$this->render('{$name}s/show', ['id' => \$id]);
    }

    public function create()
    {
        \$this->render('{$name}s/create');
    }

    public function store()
    {
        // Process logic
    }
}
PHP;

    $filename = __DIR__ . "/../app/Controllers/{$name}Controller.php";
    file_put_contents($filename, $template);
    echo "Controller {$name}Controller has been created successfully!\n";
}

// Similarly for generateModel and generateMiddleware
```

## API Development

PHPure can be used to develop RESTful APIs:

```php
// API Controller
class ApiController extends Controller
{
    public function __construct()
    {
        // Set JSON content type
        header('Content-Type: application/json');
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function unauthorized()
    {
        return $this->json(['error' => 'Unauthorized'], 401);
    }

    protected function notFound()
    {
        return $this->json(['error' => 'Resource not found'], 404);
    }
}

// Example API endpoint
class UsersApiController extends ApiController
{
    public function index()
    {
        $users = User::all();
        return $this->json(['data' => $users]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->notFound();
        }

        return $this->json(['data' => $user]);
    }
}

// Routes for API
$router->get('api/users', ['UsersApiController', 'index']);
$router->get('api/users/{id}', ['UsersApiController', 'show']);
```

## Creating Custom Helpers

You can extend PHPure by creating your own helper functions:

```php
// utils/helpers.php

if (!function_exists('asset')) {
    /**
     * Generate a URL for an asset
     *
     * @param string $path The path to the asset
     * @return string The full URL to the asset
     */
    function asset($path)
    {
        $baseUrl = rtrim(getenv('APP_URL') ?: '', '/');
        return $baseUrl . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('config')) {
    /**
     * Get a configuration value
     *
     * @param string $key The configuration key (dot notation)
     * @param mixed $default The default value if the key is not found
     * @return mixed The configuration value
     */
    function config($key, $default = null)
    {
        static $config = null;

        if ($config === null) {
            $config = require_once __DIR__ . '/../config/app.php';
        }

        $keys = explode('.', $key);
        $value = $config;

        foreach ($keys as $segment) {
            if (!isset($value[$segment])) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}
```

## Custom Service Providers

For larger applications, you might want to implement a service provider pattern to register and bootstrap services:

```php
<?php

// core/ServiceProvider.php
namespace Core;

abstract class ServiceProvider
{
    abstract public function register();

    public function boot()
    {
        // By default, do nothing
    }
}

// Example service provider
class MailServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the mail service
        App::bind('mail', function() {
            return new MailService(
                getenv('MAIL_HOST'),
                getenv('MAIL_PORT'),
                getenv('MAIL_USERNAME'),
                getenv('MAIL_PASSWORD')
            );
        });
    }

    public function boot()
    {
        // Configure mail templates
        $mailService = App::resolve('mail');
        $mailService->setTemplatesPath(__DIR__ . '/../resources/views/emails');
    }
}

// Register service providers in App.php
public static function bootstrap()
{
    // Register service providers
    $providers = [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
        \App\Providers\MailServiceProvider::class,
    ];

    foreach ($providers as $provider) {
        $instance = new $provider();
        $instance->register();
    }

    // Boot service providers
    foreach ($providers as $provider) {
        $instance = new $provider();
        $instance->boot();
    }

    // Continue with bootstrap...
}
```

With these advanced techniques, you'll be able to scale and extend your PHPure applications to meet more complex requirements.
