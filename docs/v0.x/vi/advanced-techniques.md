# Kỹ Thuật Nâng Cao

Phần này đề cập đến các tính năng và mẫu thiết kế nâng cao mà bạn có thể triển khai để mở rộng và cải thiện ứng dụng PHPure của mình. Những kỹ thuật này cho phép bạn xây dựng các ứng dụng phức tạp và giàu tính năng hơn trong khi vẫn duy trì kiến trúc mã nguồn sạch.

## Quan Hệ Cơ Sở Dữ Liệu Nâng Cao

### Quan Hệ Nhiều-Nhiều với Bảng Trung Gian Tùy Chỉnh

Trong khi các khái niệm cốt lõi đã đề cập đến các mối quan hệ cơ bản, đây là cách triển khai các mối quan hệ nhiều-nhiều nâng cao với các thuộc tính bảng trung gian bổ sung:

```php
// User Model
class User extends Model
{
    protected string $table = 'users';

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,      // Related model
            'user_roles',     // Pivot table
            'user_id',        // Foreign key of current table in pivot
            'role_id',        // Foreign key of related table in pivot
            'id',             // Primary key of current table
            'id'              // Primary key of related table
        );
    }

    // Get roles with assigned date
    public function getRolesWithAssignedDate()
    {
        // Custom query for pivot with additional data
        $sql = "SELECT `roles`.*, `user_roles`.`assigned_at`
                FROM `roles`
                INNER JOIN `user_roles` ON `roles`.`id` = `user_roles`.`role_id`
                WHERE `user_roles`.`user_id` = ?";

        return Database::raw($sql, [$this->id]);
    }
}
```

### Quan Hệ Đa Hình

Quan hệ đa hình cho phép một mô hình thuộc về nhiều mô hình khác trong một liên kết duy nhất:

```php
// Comment Model
class Comment extends Model
{
    protected string $table = 'comments';

    // Get the parent model (could be Post, Video, etc.)
    public function commentable()
    {
        $type = $this->commentable_type; // e.g., 'App\Models\Post'
        $id = $this->commentable_id;

        // Check if the type exists
        if (!class_exists($type)) {
            return null;
        }

        // Return the related model instance
        return (new $type())->find($id);
    }
}

// Post Model
class Post extends Model
{
    protected string $table = 'posts';

    // Get all comments for this post
    public function comments()
    {
        return Database::table('comments')
            ->where('commentable_type', '=', self::class)
            ->where('commentable_id', '=', $this->id)
            ->get();
    }
}

// Usage
$post = Post::find(1);
$comments = $post->comments();

// Adding a comment to a post
$comment = new Comment();
$comment->create([
    'content' => 'Great post!',
    'user_id' => 1,
    'commentable_type' => Post::class,
    'commentable_id' => $post->id,
    'created_at' => date('Y-m-d H:i:s')
]);
```

## Kỹ Thuật Middleware Nâng Cao

### Middleware Dựa Trên Vai Trò Có Tham Số

Tạo middleware tinh vi có thể chấp nhận tham số để kiểm soát quyền truy cập chi tiết:

```php
<?php

namespace App\Middlewares;

use Core\Http\Middleware;
use Core\Session;
use App\Models\User;

class RoleMiddleware extends Middleware
{
    private array $allowedRoles;

    public function __construct(string $roles)
    {
        // Convert comma-separated string to array
        $this->allowedRoles = explode(',', $roles);
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
// In app/routes.php or bootstrap process
Middleware::register('role', \App\Middlewares\RoleMiddleware::class);

// Use in route with parameters
$router->get('/admin', ['AdminController', 'index'])->middleware('role:admin,super_admin');
$router->get('/reports', ['ReportController', 'index'])->middleware('role:admin,analyst');
```

### Nhóm Middleware

Nhóm các middleware thường được sử dụng để dễ dàng áp dụng:

```php
<?php
// Define middleware groups in your bootstrap process
$middlewareGroups = [
    'web' => [
        'csrf',
        'session'
    ],
    'api' => [
        'throttle',
        'json'
    ],
    'admin' => [
        'auth',
        'role:admin'
    ]
];

// Apply a middleware group to routes
$router->group(['middleware' => 'admin'], function($router) {
    $router->get('/admin/dashboard', ['AdminController', 'dashboard']);
    $router->get('/admin/users', ['AdminController', 'users']);
    $router->get('/admin/settings', ['AdminController', 'settings']);
});
```

## Giao Diện Dòng Lệnh (CLI)

Tạo các lệnh CLI tùy chỉnh cho ứng dụng PHPure của bạn để tự động hóa các tác vụ. Ví dụ này cho thấy cách tạo công cụ sinh mã:

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
        // Process form submission
    }

    public function edit(\$id)
    {
        \$this->render('{$name}s/edit', ['id' => \$id]);
    }

    public function update(\$id)
    {
        // Process form update
    }

    public function delete(\$id)
    {
        // Process deletion
    }
}
PHP;

    $filename = __DIR__ . "/../app/Controllers/{$name}Controller.php";
    file_put_contents($filename, $template);
    echo "Controller {$name}Controller has been created successfully!\n";
}

// Add to your composer.json scripts
// "scripts": {
//    "make:controller": "php commands/generate.php controller",
//    "make:model": "php commands/generate.php model",
//    "make:middleware": "php commands/generate.php middleware"
// }

// Usage: composer run make:controller Post
```

## Phát Triển RESTful API

PHPure có thể được sử dụng để xây dựng các API RESTful mạnh mẽ. Dưới đây là một ví dụ toàn diện:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Models\User;

class ApiController extends Controller
{
    protected function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return $this->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    protected function error($message = 'Error', $statusCode = 400, $errors = [])
    {
        return $this->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }

    protected function unauthorized($message = 'Unauthorized')
    {
        return $this->error($message, 401);
    }

    protected function notFound($message = 'Resource not found')
    {
        return $this->error($message, 404);
    }

    protected function validateToken()
    {
        $token = Request::header('Authorization');

        if (!$token) {
            return false;
        }

        // Remove "Bearer " prefix if present
        $token = str_replace('Bearer ', '', $token);

        // Verify token (simple example - use more robust solutions in production)
        // You might use JWT or another token verification system here
        $userData = Database::table('user_tokens')
            ->where('token', '=', $token)
            ->where('expires_at', '>', date('Y-m-d H:i:s'))
            ->first();

        if (!$userData) {
            return false;
        }

        return $userData;
    }
}

class UsersApiController extends ApiController
{
    public function __construct()
    {
        // Verify token for all requests except login
        if (Request::path() !== 'api/login') {
            $userData = $this->validateToken();

            if (!$userData) {
                $this->unauthorized();
                exit;
            }
        }
    }

    public function index()
    {
        $users = User::all();
        return $this->success($users);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->notFound();
        }

        return $this->success($user);
    }

    public function store()
    {
        $data = Request::json();

        // Validate input
        $validator = new Validation();
        $valid = $validator->validate($data, [
            'name' => v::notEmpty()->alpha()->length(2, 50),
            'email' => v::notEmpty()->email(),
            'password' => v::notEmpty()->length(8, null)
        ]);

        if (!$valid) {
            return $this->error('Validation failed', 422, $validator->errors());
        }

        // Create user
        $user = new User();
        $userId = $user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->success(['id' => $userId], 'User created successfully', 201);
    }

    public function login()
    {
        $data = Request::json();

        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->error('Email and password are required', 422);
        }

        // Find user by email
        $user = Database::table('users')
            ->where('email', '=', $data['email'])
            ->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return $this->error('Invalid credentials', 401);
        }

        // Generate token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Store token
        Database::table('user_tokens')->insert([
            'user_id' => $user['id'],
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->success([
            'token' => $token,
            'expires_at' => $expiresAt,
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ]
        ]);
    }
}

// In app/routes.php
$router->get('api/users', ['UsersApiController', 'index']);
$router->get('api/users/{id}', ['UsersApiController', 'show']);
$router->post('api/users', ['UsersApiController', 'store']);
$router->post('api/login', ['UsersApiController', 'login']);
```

## Container Dịch Vụ và Dependency Injection

Triển khai container dịch vụ đơn giản để quản lý phụ thuộc:

```php
<?php

namespace Core;

class Container
{
    protected static array $bindings = [];
    protected static array $instances = [];

    public static function bind(string $abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }

        static::$bindings[$abstract] = $concrete;
    }

    public static function singleton(string $abstract, $concrete = null)
    {
        static::bind($abstract, $concrete);
        static::$instances[$abstract] = null;
    }

    public static function resolve(string $abstract)
    {
        // Check if we need to return a singleton instance
        if (isset(static::$instances[$abstract])) {
            return static::$instances[$abstract] ?? static::instantiate($abstract);
        }

        return static::instantiate($abstract);
    }

    protected static function instantiate(string $abstract)
    {
        $concrete = static::$bindings[$abstract] ?? $abstract;

        // If the concrete is a closure, execute it
        if ($concrete instanceof \Closure) {
            $instance = $concrete();
        } else {
            $instance = new $concrete();
        }

        // Store singleton instance if needed
        if (isset(static::$instances[$abstract])) {
            static::$instances[$abstract] = $instance;
        }

        return $instance;
    }
}

// Usage
Container::bind('logger', function() {
    return new Logger();
});

Container::singleton('database', function() {
    return new Database([
        'host' => getenv('DB_HOST'),
        'name' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'pass' => getenv('DB_PASS')
    ]);
});

$logger = Container::resolve('logger');
$db = Container::resolve('database');
```

## Nhà Cung Cấp Dịch Vụ (Service Providers)

Nhà cung cấp dịch vụ là một cách để tổ chức việc đăng ký các dịch vụ trong ứng dụng của bạn. Dưới đây là cách triển khai chúng:

```php
<?php

namespace Core;

abstract class ServiceProvider
{
    protected Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    // Must be implemented by child classes
    abstract public function register();

    // Optional boot method
    public function boot()
    {
        // By default, do nothing
    }
}

// Example mail service provider
namespace App\Providers;

use Core\ServiceProvider;
use App\Services\MailService;

class MailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('mail', function() {
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
        $mailService = $this->app->resolve('mail');
        $mailService->setTemplatesPath(__DIR__ . '/../../resources/views/emails');
    }
}

// Application bootstrap
public static function bootstrap()
{
    $app = new Container();

    // Register service providers
    $providers = [
        \App\Providers\AppServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
        \App\Providers\MailServiceProvider::class,
    ];

    // Two-phase initialization: register then boot
    $providerInstances = [];

    // Phase 1: Register
    foreach ($providers as $provider) {
        $instance = new $provider($app);
        $instance->register();
        $providerInstances[] = $instance;
    }

    // Phase 2: Boot (after all services are registered)
    foreach ($providerInstances as $instance) {
        $instance->boot();
    }

    return $app;
}
```

## Giao Dịch Cơ Sở Dữ Liệu Nâng Cao

Quản lý các thao tác cơ sở dữ liệu phức tạp với giao dịch để đảm bảo tính toàn vẹn dữ liệu:

```php
<?php

// Start a transaction
Database::beginTransaction();

try {
    // Create a new order
    $orderId = Database::table('orders')->insertGetId([
        'user_id' => $userId,
        'total' => $cartTotal,
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s')
    ]);

    // Add order items
    foreach ($cartItems as $item) {
        Database::table('order_items')->insert([
            'order_id' => $orderId,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Update product inventory
        Database::table('products')
            ->where('id', '=', $item['product_id'])
            ->decrement('stock', $item['quantity']);
    }

    // If everything is successful, commit the transaction
    Database::commit();

    return ['success' => true, 'order_id' => $orderId];
} catch (\Exception $e) {
    // If an error occurs, roll back the transaction
    Database::rollBack();

    Logger::error('Order creation failed', [
        'error' => $e->getMessage(),
        'user_id' => $userId
    ]);

    return ['success' => false, 'message' => 'Order could not be processed'];
}
```

## Bộ Lọc Hành Động Tùy Chỉnh

Tạo bộ lọc hành động để chạy mã trước hoặc sau các hành động của controller:

```php
<?php

namespace Core;

class ActionFilter
{
    protected static array $beforeFilters = [];
    protected static array $afterFilters = [];

    public static function before(string $controllerAction, callable $callback)
    {
        static::$beforeFilters[$controllerAction][] = $callback;
    }

    public static function after(string $controllerAction, callable $callback)
    {
        static::$afterFilters[$controllerAction][] = $callback;
    }

    public static function runBefore(string $controllerAction, ...$params)
    {
        if (!isset(static::$beforeFilters[$controllerAction])) {
            return true;
        }

        foreach (static::$beforeFilters[$controllerAction] as $callback) {
            if ($callback(...$params) === false) {
                return false;
            }
        }

        return true;
    }

    public static function runAfter(string $controllerAction, ...$params)
    {
        if (!isset(static::$afterFilters[$controllerAction])) {
            return;
        }

        foreach (static::$afterFilters[$controllerAction] as $callback) {
            $callback(...$params);
        }
    }
}

// Usage in a controller
ActionFilter::before('UserController@update', function($userId) {
    $currentUser = Session::get('user_id');

    if ($currentUser != $userId && !hasRole('admin')) {
        return false; // Stop execution
    }

    return true; // Continue execution
});

ActionFilter::after('UserController@update', function($userId) {
    Logger::info('User updated', ['user_id' => $userId]);
    Event::dispatch('user.updated', User::find($userId));
});
```

## Cấu Hình Đa Môi Trường

Thiết lập cấu hình nâng cao cho các môi trường cụ thể:

```php
<?php

// config/environments/development.php
return [
    'app' => [
        'debug' => true,
        'url' => 'http://localhost:8000',
    ],
    'database' => [
        'default' => 'mysql',
        'connections' => [
            'mysql' => [
                'host' => '127.0.0.1',
                'database' => 'phpure_dev',
                'username' => 'root',
                'password' => '',
            ],
        ],
    ],
    'mail' => [
        'driver' => 'array', // Store emails in array for inspection
    ],
];

// config/environments/production.php
return [
    'app' => [
        'debug' => false,
        'url' => 'https://example.com',
    ],
    'database' => [
        'default' => 'mysql',
        'connections' => [
            'mysql' => [
                'host' => 'production-db.example.com',
                'database' => 'phpure_prod',
                'username' => getenv('DB_USER'),
                'password' => getenv('DB_PASS'),
            ],
        ],
    ],
    'mail' => [
        'driver' => 'smtp',
        'host' => 'smtp.mailprovider.com',
        // other SMTP settings
    ],
];

// config/app.php
$env = getenv('APP_ENV') ?: 'development';
$envConfig = require_once __DIR__ . "/environments/{$env}.php";

return array_merge([
    // Default configuration
    'name' => getenv('APP_NAME') ?: 'PHPure',
    'timezone' => 'UTC',
    'locale' => 'en',
    // ...more default settings
], $envConfig['app'] ?? []);
```

Với các kỹ thuật nâng cao này, bạn sẽ có thể mở rộng và phát triển các ứng dụng PHPure của mình để đáp ứng các yêu cầu phức tạp hơn. Những mẫu thiết kế này duy trì tính đơn giản của framework trong khi cung cấp cho bạn các công cụ để xây dựng các ứng dụng tinh vi.
