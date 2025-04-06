# Useful Features

In addition to the core features already presented, PHPure provides many other useful tools to help you develop applications quickly and easily. In this section, we'll explore some of these interesting features.

## Flash Messages

Flash messages are temporary notifications displayed once after page navigation, very useful for conveying the result of an action. PHPure provides the `flash()` method in the `Session` class to manage these notifications:

```php
// Set a flash message in the controller
Session::flash('success', 'User registration successful!');
redirect('/login');

// In the view, display the message (with Twig)
{% if flash('success') %}
    <div class="alert alert-success">
        {{ flash('success') }}
    </div>
{% endif %}
```

Flash messages are very useful in situations such as:

- Displaying success messages after adding, updating, or deleting data
- Displaying error messages after redirection
- Displaying temporary instructions or information to the user

## Form Management and CSRF Security

PHPure provides the `Form` class to support creating and securing HTML forms. In particular, this class provides methods to create CSRF (Cross-Site Request Forgery) tokens to protect your application from request forgery attacks.

```php
// In the controller, create view with form
public function create()
{
    $this->render('users/create');
}

// In the view (users/create.html.twig)
<form method="post" action="{{ url('/users/store') }}">
    <input type="hidden" name="csrf_token" value="{{ form_token() }}">

    <div class="form-group">
        <label for="name">Name:</label>
        {{ form_input('text', 'name', '', {'class': 'form-control', 'required': 'required'}) }}
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        {{ form_input('email', 'email', '', {'class': 'form-control', 'required': 'required'}) }}
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>

// In the controller processing the form
public function store()
{
    // Check CSRF token
    $token = Request::input('csrf_token');
    if (!Form::validateToken($token)) {
        Session::flash('error', 'Invalid token!');
        redirect('/users/create');
        return;
    }

    // Process form data
    // ...
}
```

## Pagination

Pagination is an important feature when displaying a large amount of data. PHPure provides the `Pagination` class to help you easily implement pagination in your application:

```php
// In the controller
public function index()
{
    $currentPage = (int) Request::query('page', 1);
    $perPage = 10;

    // Get total number of records
    $total = Database::table('users')->count();

    // Initialize Pagination object
    $pagination = new Pagination($total, $perPage, $currentPage);

    // Get data with pagination
    $users = Database::table('users')
                   ->orderBy('id', 'DESC')
                   ->limit($perPage)
                   ->offset($pagination->offset())
                   ->get();

    $this->render('users/index', [
        'users' => $users,
        'pagination' => $pagination->links()
    ]);
}

// In the view (users/index.html.twig)
{# Display user list #}
<ul>
    {% for user in users %}
        <li>{{ user.name }} - {{ user.email }}</li>
    {% else %}
        <li>No users found.</li>
    {% endfor %}
</ul>

{# Display pagination #}
<nav>
    <ul class="pagination">
        {% for link in pagination %}
            <li class="page-item {{ link.active ? 'active' : '' }}">
                <a class="page-link" href="{{ link.url }}">{{ link.page }}</a>
            </li>
        {% endfor %}
    </ul>
</nav>
```

## Caching

Caching helps increase application performance by storing temporary data, avoiding having to perform expensive operations like database queries multiple times. PHPure provides a simple but effective `Cache` class:

```php
// Save data to cache
Cache::put('users', $users, 60); // Store for 60 minutes

// Get data from cache
$users = Cache::get('users');

// Real example: Get user list from cache or database
public function index()
{
    // Try to get data from cache
    $users = Cache::get('users');

    // If not in cache, get from database and save to cache
    if (!$users) {
        $users = User::all();
        Cache::put('users', $users, 30); // Store for 30 minutes
    }

    $this->render('users/index', [
        'users' => $users
    ]);
}

// Delete cache
Cache::delete('users');

// Delete all cache
Cache::flush();
```

## Advanced Error Handling

PHPure provides the `ExceptionHandler` class to handle errors efficiently. This class automatically catches errors and exceptions, logs them, and displays appropriate error messages based on the environment:

```php
// Register exception handler in bootstrap file
ExceptionHandler::register();

// When an error occurs:
// - In development environment: Display detailed error
// - In production environment: Display user-friendly error page
```

To create custom error pages, you can create corresponding view files in the `resources/views/errors/` directory:

- `404.html.twig` - Page not found
- `500.html.twig` - Server error

## Safe Input Filtering

PHPure extends the `Request` class with the `sanitize()` method to filter input data, protecting the application from malicious code:

```php
// Get filtered input data
$name = Request::sanitize('name');
$email = Request::sanitize('email');

// Check if the request is Ajax
if (Request::isAjax()) {
    // Process Ajax request
}

// Get the user's IP address
$userIp = Request::ip();
```

## File Upload Handling

PHPure provides the `Storage` class to manage uploading and storing files. Here is a complete example of how to handle file uploads:

```php
// In the view (upload form)
<form method="post" action="{{ url('/upload') }}" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="{{ form_token() }}">

    <div class="form-group">
        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar">
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>
</form>

// In the controller
public function upload()
{
    // Check CSRF token
    $token = Request::input('csrf_token');
    if (!Form::validateToken($token)) {
        Session::flash('error', 'Invalid token!');
        redirect('/profile');
        return;
    }

    // Check uploaded file
    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        Session::flash('error', 'Error uploading file!');
        redirect('/profile');
        return;
    }

    // Create random filename
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;

    // Save file
    $storagePath = 'avatars/' . $filename;
    $filepath = Storage::put($storagePath, $_FILES['avatar']);

    // Update user profile
    $userId = Session::get('user_id');
    User::update(['avatar' => $storagePath], $userId);

    Session::flash('success', 'Avatar upload successful!');
    redirect('/profile');
}
```

With these features, PHPure provides you with a comprehensive set of tools to build modern web applications efficiently.
