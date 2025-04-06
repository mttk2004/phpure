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

Routing is an important part of determining how the application handles user requests. PHPure uses a router to map URLs to corresponding controllers and actions. All application routes are defined in the `app/routes.php` file. To define a route, you need to specify the URL, HTTP method, controller, and corresponding action. Here's an example:

```php
<?php

use Core\Http\Router;

$router = new Router();

// Define routes here
$router->get('', ['HomeController', 'index']);

$router->dispatch();
```

When the line `$router->get('', ['HomeController', 'index']);` is added, it maps the empty URL (`/`) to the `index` method of the `HomeController`. This means that when a user accesses the application's homepage, the `HomeController` will be called and the `index` method will be executed.

Other common routing methods integrated in PHPure include `post`, `put`, `patch`, `delete`, etc., to handle different HTTP requests. PHPure also supports defining routes with dynamic parameters, helping to handle dynamic URLs easily. For example, `'/posts/{id}'` will map URLs like `/posts/1`, `/posts/2`, etc., to the same controller and action but with different `id` parameters, so you can retrieve data based on that parameter.

### Database and ORM

PHPure provides the `Database` class to interact with the database simply and efficiently. This class is inspired by Laravel's Query Builder but simplified for easier understanding. Here are some examples of how to use it:

```php
// Get all records from the users table
$users = Database::table('users')->get();

// Get the user with id = 1
$user = Database::table('users')->where('id', '=', 1)->first();

// Add a new user
Database::table('users')->insert([
    'name' => 'New User',
    'email' => 'user@example.com',
    'password' => password_hash('password', PASSWORD_DEFAULT)
]);

// Update user information
Database::table('users')
        ->where('id', '=', 1)
        ->update(['name' => 'New Name']);

// Delete a user
Database::table('users')
        ->where('id', '=', 1)
        ->delete();
```

In addition, PHPure also provides the abstract `Model` class so you can create models corresponding to tables in the database.

### Controllers

Controllers in PHPure inherit from the base `Controller` class and are responsible for handling the business logic of the application. Here's an example of a simple controller:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $this->render('users/index', [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $this->render('users/show', [
            'user' => $user
        ]);
    }
}
```

### Validation

PHPure integrates the [Respect/Validation](https://respect-validation.readthedocs.io/) library to support input data validation in a simple and powerful way.

### Template Engine (Twig)

PHPure uses [Twig](https://twig.symfony.com/) as the default template engine. Twig provides a simple and powerful syntax for creating views.

### Migrations and Seeds

PHPure uses [Phinx](https://phinx.org/) to manage migrations and seeds. This is an effective way to manage database structure and sample data.

### Middleware

Middleware is an intermediate processing layer between request and response, which can be used to check access rights, authenticate users, and many other tasks.

### Events and Listeners

PHPure supports an event system and event listeners. This allows you to separate application components and increase maintainability.
