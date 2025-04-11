# Core Concepts

To truly understand and maximize the use of PHPure, you need to understand some basic concepts and how the framework works. Let's start with the **request lifecycle**.

## Request Lifecycle

PHPure operates based on the MVC (Model-View-Controller) pattern, a popular architecture in web development that helps clearly separate different parts of the application. The **Model** is responsible for managing data and business logic, the **View** manages the user interface, and the **Controller** is the bridge between Model and View, handling user requests and returning appropriate responses.

### Request Reception

All requests from the browser are sent to the `index.php` file in the `public` directory. This is the main entry point of the application. Here, the framework is started through the `App::bootstrap()` method, where important components like the router, middleware, session, etc., are configured.

### Router Analysis

After startup, the router is responsible for mapping the URL from the request to pre-defined routes in the `routes.php` file. The router checks if the requested URL matches any registered route. If not found, it will return a 404 error.

### Middleware Processing

Before the router calls the controller, middleware is activated if the route has middleware attached. Middleware are intermediate processing layers, used to check or modify requests before forwarding. For example, middleware can check if a user is logged in (auth) or ensure that only guests who haven't logged in can access certain pages (guest). If middleware detects an error, the request will be stopped and a response returned right there.

### Controller Invocation

After passing through middleware, the router calls the specified controller along with the action (specific method). The controller receives information from the request, processes business logic, and prepares data to pass to the View. For example, a controller might retrieve user data from the database or check business conditions before proceeding.

### Connecting to View via Twig

After processing, the controller typically ends by calling a template to display the interface. PHPure uses Twig, a powerful template engine, to combine data from the controller and defined HTML templates. Twig provides many useful features such as loops, condition checking, and layout inheritance, making interface building easy and flexible.

### Returning the Response

After Twig creates the complete interface (HTML), the framework sends that content back to the browser as a response. The user will see the displayed web page, complete with data processed from the controller.

### Summary

The lifecycle of a request in PHPure includes steps from receiving the URL, analyzing and mapping the route, checking middleware, processing logic in the controller, and finally rendering the interface through Twig. The MVC architecture ensures that each part of the application has a clear task, making the code easy to understand, maintain, and extend. With this clear operation flow, even beginners can quickly understand how the application works and start developing new features.

## Core Features

### Routing

Routing maps URLs to controller actions and is a fundamental part of PHPure. All routes are defined in `app/routes.php`. The Router class provides a clean and intuitive syntax for defining different types of routes:

```php
<?php
use Core\Http\Router;

$router = new Router();

// Basic route: maps homepage to HomeController's index method
$router->get('', ['HomeController', 'index']);

// Route with parameters: Dynamic post ID in URL
$router->get('posts/{id}', ['PostController', 'show']);

// Route with middleware: Requires authentication
$router->get('dashboard', ['DashboardController', 'index'])
    ->middleware('auth');

// Different HTTP methods
$router->post('posts', ['PostController', 'store']);
$router->put('posts/{id}', ['PostController', 'update']);
$router->delete('posts/{id}', ['PostController', 'destroy']);

// Start routing
$router->dispatch();
```

The router automatically extracts parameters from URLs, making them available to your controller methods. For example, when a user visits `/posts/5`, the router passes `5` as the `$id` parameter to the `show` method of `PostController`.

### Middleware

Middleware acts as a filtering mechanism for HTTP requests in your application. It provides a convenient way to inspect and filter HTTP requests entering your application. Middleware can perform tasks such as:

- Authentication: Checking if a user is logged in
- Authorization: Verifying that a user has permission to access a resource
- CSRF protection: Guarding against cross-site request forgery
- Input sanitization: Cleaning user input before it reaches controllers

In PHPure, middleware is implemented through the `Middleware` class in the `Core\Http` namespace. You can apply middleware to routes as shown in the routing examples:

```php
// Apply auth middleware to a route
$router->get('dashboard', ['DashboardController', 'index'])
    ->middleware('auth');

// Apply multiple middleware to a route (in sequence)
$router->get('admin/settings', ['AdminController', 'settings'])
    ->middleware('auth')
    ->middleware('admin');
```

Creating a custom middleware is straightforward:

```php
<?php
namespace App\Middleware;

use Core\Http\Middleware;
use Core\Session;

class AuthMiddleware extends Middleware
{
    public function handle(): bool
    {
        // If the user is not logged in, redirect to login page
        if (!Session::has('user_id')) {
            redirect('/login');
            return false; // Stop request processing
        }

        return true; // Continue request processing
    }
}
```

To register your middleware, add it to the middleware resolver in your application's bootstrap process:

```php
// Register middleware
Middleware::register('auth', \App\Middleware\AuthMiddleware::class);
Middleware::register('admin', \App\Middleware\AdminMiddleware::class);
```

Middleware provides a clean way to separate cross-cutting concerns from your controllers, leading to more maintainable and modular code.

### Models and ORM

PHPure provides a lightweight ORM (Object-Relational Mapping) system that makes database operations more intuitive and object-oriented. Models extend the base `Model` class and represent database tables:

```php
<?php
namespace App\Models;

use Core\Model;

class User extends Model
{
    // Define the table associated with this model
    protected string $table = 'users';

    // Enable soft deletes if needed
    protected bool $softDelete = true;
}
```

With this simple model definition, you can perform various database operations:

```php
// Find a user by ID
$user = User::find(1);

// Get all users
$users = User::all();

// Create a new user
$user = new User();
$user->create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => password_hash('secret', PASSWORD_DEFAULT)
]);

// Update a user
$user->update(['name' => 'Jane Doe'], 1);

// Delete a user
$user->delete(1);

// With soft delete enabled, restore a user
$user->restore(1);

// Get only soft-deleted users
$deletedUsers = User::onlyTrashed();
```

The Model class also provides relationship methods to define connections between tables:

```php
// One-to-One relationship
$profile = $user->hasOne(Profile::class, 'user_id');

// One-to-Many relationship
$posts = $user->hasMany(Post::class, 'user_id');

// Many-to-Many relationship
$roles = $user->belongsToMany(
    Role::class,
    'user_roles',
    'user_id',
    'role_id'
);
```

### Database Query Builder

For more complex queries, PHPure offers a fluent query builder through the `Database` class:

```php
use Core\Database;

// Basic select
$users = Database::table('users')->get();

// With conditions
$activeUsers = Database::table('users')
    ->where('status', '=', 'active')
    ->where('created_at', '>', '2023-01-01')
    ->orderBy('name')
    ->limit(10)
    ->get();

// First record only
$user = Database::table('users')
    ->where('email', '=', 'john@example.com')
    ->first();

// Count records
$count = Database::table('users')
    ->where('status', '=', 'active')
    ->count();

// Insert record
Database::table('users')->insert([
    'name' => 'John Doe',
    'email' => 'john@example.com'
]);

// Update records
Database::table('users')
    ->where('id', '=', 1)
    ->update(['status' => 'inactive']);

// Delete records
Database::table('users')
    ->where('status', '=', 'inactive')
    ->delete();

// Raw SQL when needed
$results = Database::raw(
    "SELECT * FROM users WHERE email LIKE ?",
    ['%@example.com']
);
```

### Controllers

Controllers handle requests and coordinate the application logic. PHPure controllers extend the base `Controller` class:

```php
<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\Post;
use Core\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Get all posts
        $posts = Post::all();

        // Pass data to view
        $this->render('posts/index', [
            'posts' => $posts,
            'title' => 'All Posts'
        ]);
    }

    public function show($id)
    {
        // Find post by ID
        $post = Post::find($id);

        // Handle not found
        if (!$post) {
            return $this->renderError(404, 'Post not found');
        }

        // Render view with post data
        $this->render('posts/show', [
            'post' => $post,
            'title' => $post->title
        ]);
    }

    public function store(Request $request)
    {
        // Create new post
        $post = new Post();
        $result = $post->create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => $request->session('user_id')
        ]);

        // Redirect after successful creation
        if ($result) {
            $this->redirect('/posts');
        }
    }
}
```

### Views with Twig

PHPure uses the powerful Twig templating engine to render views. Twig provides features like template inheritance, automatic escaping, filters, and more:

```twig
{# layout.twig #}
<!DOCTYPE html>
<html>
<head>
    <title>{% block title %}PHPure{% endblock %}</title>
    {{ vite_assets() }}
</head>
<body>
    <header>
        {% include 'partials/navigation.twig' %}
    </header>

    <main>
        {% block content %}{% endblock %}
    </main>

    <footer>
        {% include 'partials/footer.twig' %}
    </footer>
</body>
</html>

{# posts/index.twig #}
{% extends 'layout.twig' %}

{% block title %}{{ title }}{% endblock %}

{% block content %}
    <h1>All Posts</h1>

    {% for post in posts %}
        <article>
            <h2>{{ post.title }}</h2>
            <p>{{ post.content|slice(0, 200) }}...</p>
            <a href="{{ url('posts/' ~ post.id) }}">Read more</a>
        </article>
    {% else %}
        <p>No posts found.</p>
    {% endfor %}
{% endblock %}
```

PHPure extends Twig with several useful functions:

- `asset()`: Generates URL for static assets
- `url()`: Creates application URLs
- `session()`: Accesses session data
- `flash()`: Retrieves and clears flash messages
- `vite_assets()`: Includes assets processed by Vite

### Form Validation

PHPure leverages Respect/Validation, a powerful validation library, to validate form inputs:

```php
use Core\Validation;
use Respect\Validation\Validator as v;

$validator = new Validation();
$valid = $validator->validate($_POST, [
    'name' => v::notEmpty()->alpha()->length(2, 50),
    'email' => v::notEmpty()->email(),
    'password' => v::notEmpty()->length(8, null)
]);

if (!$valid) {
    // Get validation errors
    $errors = $validator->errors();
    // Handle errors (e.g., display to user)
}
```

### Session Management

The `Session` class provides a clean interface for working with PHP sessions:

```php
use Core\Session;

// Start session (automatically called by framework)
Session::start();

// Store data
Session::set('user_id', 123);

// Retrieve data
$userId = Session::get('user_id');

// Check if session key exists
if (Session::has('user_id')) {
    // Do something
}

// Remove a specific session value
Session::remove('user_id');

// Destroy the entire session
Session::destroy();

// Flash messages (temporary data for next request)
Session::flash('success', 'Your profile was updated');

// Later, retrieve and clear the flash message
$message = Session::flash('success');
```

### Logging

The `Logger` class, built on Monolog, provides robust logging capabilities:

```php
use Core\Logger;

// Log messages at different levels
Logger::debug('Detailed debug information');
Logger::info('User logged in', ['id' => 123]);
Logger::warning('Suspicious activity detected');
Logger::error('Failed to connect to database');
```

### Migrations and Seeds with Phinx

PHPure integrates Phinx for database migrations and seeding:

```php
// Example migration file
use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $this->table('users')
            ->addColumn('name', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('password', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}

// Example seeder
use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->table('users')->insert($data)->save();
    }
}
```

These core features form the foundation of PHPure, providing the essential tools you need for effective web development while maintaining simplicity and clarity.
