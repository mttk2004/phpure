# Additional Features

PHPure offers numerous additional features beyond the core concepts to enhance your web development experience. These features are designed to solve common challenges and make your development workflow more efficient.

## Convenient Helper Functions

PHPure includes a set of global helper functions in `utils/helpers.php` that simplify common tasks:

```php
// Redirect to another URL
redirect('/dashboard');

// Get the current URL
$currentUrl = current_url();

// Generate a URL for a route
$url = url('/users/profile');

// Format a date
$formattedDate = format_date('2023-04-15', 'd/m/Y');

// Generate HTML escaped output
echo e('<script>alert("XSS")</script>'); // Outputs: &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;

// Check if the current environment is development
if (is_development()) {
    // Show debugging information
}
```

Using these helpers makes your code more concise and readable, especially for common operations.

## Flash Messages

Flash messages provide temporary feedback to users that persists for exactly one page request. They're perfect for displaying success, error, or information messages after form submissions or other actions:

```php
// In a controller action
Session::flash('success', 'Your profile has been updated!');
redirect('/dashboard');

// In your Twig template
{% if flash('success') %}
    <div class="alert alert-success">
        {{ flash('success') }}
    </div>
{% endif %}

{% if flash('error') %}
    <div class="alert alert-danger">
        {{ flash('error') }}
    </div>
{% endif %}
```

Flash messages automatically clear themselves after being retrieved once, ensuring users don't see outdated notifications.

## Form Security with CSRF Protection

Cross-Site Request Forgery (CSRF) is a common security vulnerability. PHPure's `Form` class provides built-in protection:

```php
// In your Twig template
<form method="post" action="{{ url('/users/update') }}">
    {{ csrf_field() }}

    <!-- Form fields -->
    <input type="text" name="name" value="{{ user.name }}">

    <button type="submit">Update</button>
</form>

// In your controller
public function update()
{
    // Verify CSRF token (automatically throws exception if invalid)
    Form::verifyCsrfToken();

    // Process form data
    $name = Request::input('name');
    // ...
}
```

The `csrf_field()` Twig function inserts a hidden input field with a secure token. PHPure automatically validates this token on form submission, protecting your application from CSRF attacks.

## Smart Pagination

When working with large datasets, pagination becomes essential. PHPure's pagination system is both powerful and easy to use:

```php
// In your controller
public function index()
{
    $page = (int) Request::query('page', 1);
    $perPage = 15;

    // Get total count
    $total = Database::table('articles')->count();

    // Create pagination object
    $pagination = new Pagination($total, $perPage, $page);

    // Get paginated data
    $articles = Database::table('articles')
        ->orderBy('created_at', 'DESC')
        ->limit($perPage)
        ->offset($pagination->offset())
        ->get();

    $this->render('articles/index', [
        'articles' => $articles,
        'pagination' => $pagination
    ]);
}

// In your Twig template
<div class="pagination">
    {% if pagination.hasPrevious() %}
        <a href="{{ url('/articles?page=' ~ pagination.previousPage()) }}">&laquo; Previous</a>
    {% endif %}

    {% for i in pagination.getPages() %}
        <a href="{{ url('/articles?page=' ~ i) }}"
           class="{{ i == pagination.currentPage ? 'active' : '' }}">
            {{ i }}
        </a>
    {% endfor %}

    {% if pagination.hasNext() %}
        <a href="{{ url('/articles?page=' ~ pagination.nextPage()) }}">Next &raquo;</a>
    {% endif %}
</div>
```

The `Pagination` class handles all the complex calculations for you, providing methods to determine:

- The current page
- Total pages
- Previous/next page numbers
- Whether previous/next pages exist
- Which page numbers to display in the navigation

## Performance-Boosting Cache System

Caching is vital for application performance. PHPure provides a flexible caching system:

```php
// Store data in cache for 60 minutes
Cache::put('homepage_data', $data, 60);

// Retrieve data from cache
$data = Cache::get('homepage_data');

// Store data forever (until manually removed)
Cache::forever('site_settings', $settings);

// Check if an item exists in cache
if (Cache::has('api_response')) {
    // Use cached data
}

// Remove an item from cache
Cache::delete('user_stats');

// Clear all cached data
Cache::flush();

// Remember pattern (get from cache or execute callback and store result)
$users = Cache::remember('active_users', 30, function() {
    return Database::table('users')
        ->where('status', '=', 'active')
        ->get();
});
```

The cache system supports different drivers (file, array), and you can configure this in `config/cache.php`.

## Advanced Error Handling

PHPure includes a robust exception handling system that helps you gracefully manage errors:

```php
// Register the exception handler (done automatically in bootstrap)
ExceptionHandler::register();
```

Once registered, the exception handler will:

- Catch all PHP errors and exceptions
- Log detailed error information
- Display appropriate error messages based on environment:
  - In development: detailed error information with stack traces
  - In production: user-friendly error pages

To customize error pages, create Twig templates in `resources/views/errors/`:

- `404.html.twig` - For "not found" errors
- `403.html.twig` - For "forbidden" errors
- `500.html.twig` - For server errors

## File Storage System

The `Storage` class provides a clean interface for file operations:

```php
// Store a file (from an upload)
$path = Storage::put('avatars/user123.jpg', $_FILES['avatar']);

// Check if a file exists
if (Storage::exists('documents/report.pdf')) {
    // File exists
}

// Get the contents of a file
$content = Storage::get('config/settings.json');

// Get the size of a file (in bytes)
$size = Storage::size('uploads/large-file.zip');

// Delete a file
Storage::delete('temp/old-file.txt');

// Generate a public URL for a file
$url = Storage::url('images/logo.png');
```

The storage system is configured in `config/storage.php`, where you can define storage paths and permissions.

## Request Information and Input Filtering

PHPure extends the basic request handling with useful methods for common tasks:

```php
// Get sanitized input (prevents XSS)
$name = Request::sanitize('name');
$email = Request::sanitize('email', FILTER_VALIDATE_EMAIL);

// Get JSON input from request body
$data = Request::json();

// Check request method
if (Request::isMethod('POST')) {
    // Handle POST request
}

// Check if request is an AJAX request
if (Request::isAjax()) {
    // Return JSON instead of HTML
}

// Get client IP address
$ip = Request::ip();

// Get user agent
$userAgent = Request::userAgent();

// Get request headers
$token = Request::header('Authorization');
```

These methods make it easy to work with request data while maintaining security best practices.

## Event System

PHPure includes a simple but powerful event system for decoupling components:

```php
// Register an event listener
Event::listen('user.registered', function($user) {
    // Send welcome email
    Mailer::send('welcome', $user->email, [
        'name' => $user->name
    ]);
});

// Fire an event
Event::fire('user.registered', $user);

// Class-based listener
class WelcomeEmailListener
{
    public function handle($user)
    {
        // Send welcome email
    }
}

// Register class-based listener
Event::listen('user.registered', [WelcomeEmailListener::class, 'handle']);
```

The event system is perfect for:

- Sending emails after certain actions
- Logging important activities
- Updating related data when a record changes
- Any task that shouldn't directly be the responsibility of your controller

## Vite Integration for Asset Management

PHPure seamlessly integrates with Vite for modern frontend asset management:

```php
// In your layout.html.twig
<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    {{ vite_assets() }}
</head>
<body>
    <!-- Content -->
</body>
</html>
```

The `vite_assets()` function automatically includes the necessary scripts and styles processed by Vite, giving you:

- Hot Module Replacement during development
- Automatic CSS extraction
- Asset fingerprinting for cache busting
- JavaScript module bundling and optimization

Configuration is handled in `vite.config.js` at the root of your project.

## Complete Code Examples

### Working with Flash Messages and Forms

```php
// UserController.php
public function showLoginForm()
{
    $this->render('auth/login');
}

public function login()
{
    // Validate CSRF token
    Form::verifyCsrfToken();

    // Get inputs
    $email = Request::sanitize('email');
    $password = Request::input('password');

    // Validate credentials
    $user = Database::table('users')
        ->where('email', '=', $email)
        ->first();

    if (!$user || !password_verify($password, $user['password'])) {
        Session::flash('error', 'Invalid email or password');
        redirect('/login');
        return;
    }

    // Log user in
    Session::set('user_id', $user['id']);
    Session::set('user_name', $user['name']);

    Session::flash('success', 'Welcome back, ' . $user['name'] . '!');
    redirect('/dashboard');
}

// login.html.twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <h1>Login</h1>

    {% if flash('error') %}
        <div class="alert alert-danger">
            {{ flash('error') }}
        </div>
    {% endif %}

    <form method="post" action="{{ url('/login') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
{% endblock %}
```

By combining these additional features, PHPure provides you with everything needed to build sophisticated web applications that are both performant and maintainable.
