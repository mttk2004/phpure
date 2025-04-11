# Building Applications with PHPure

In this section, we'll walk through building a complete Todo List application to demonstrate how PHPure works in practice. By following along, you'll get hands-on experience with the framework's core features and understand how different components work together.

## Todo List Application

Our Todo application will allow users to:

- View a list of tasks
- Add new tasks
- Mark tasks as complete or incomplete
- Delete tasks

Let's start building!

### Step 1: Project Setup

First, make sure your PHPure project is properly set up and running:

```bash
# Install PHP dependencies
composer install

# Install frontend dependencies
npm install

# Start the development server
npm run dev:all
```

The `dev:all` script will start both the PHP server and Vite for asset compilation.

### Step 2: Set Up the Database

Let's create a migration for our `todos` table using the predefined script in `composer.json`:

```bash
# Create a new migration
composer run migrate:create CreateTodosTable
```

This will create a new migration file in the `database/migrations` directory. Open it and define the table structure:

```php
<?php

use Phinx\Migration\AbstractMigration;

class CreateTodosTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('todos');
        $table->addColumn('title', 'string', ['limit' => 255])
              ->addColumn('completed', 'boolean', ['default' => false])
              ->addColumn('user_id', 'integer', ['null' => true])
              ->addColumn('created_at', 'datetime')
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addIndex(['user_id'])
              ->create();
    }
}
```

Now run the migration using the script from `composer.json`:

```bash
# Run the migration
composer run migrate
```

You can check the migration status with:

```bash
# Check migration status
composer run migrate:status
```

### Step 3: Create the Model

Create a new file `app/Models/Todo.php`:

```php
<?php

namespace App\Models;

use Core\Model;

class Todo extends Model
{
    // Define the table associated with this model
    protected string $table = 'todos';
}
```

This simple class gives us all the functionality we need to interact with the `todos` table, thanks to PHPure's ORM system.

### Step 4: Create the Controller

Create the file `app/Controllers/TodoController.php`:

```php
<?php

namespace App\Controllers;

use Core\Controller;
use Core\Http\Request;
use Core\Session;
use Core\Validation;
use App\Models\Todo;
use Respect\Validation\Validator as v;

class TodoController extends Controller
{
    /**
     * Display a list of all todos
     */
    public function index()
    {
        // Get all todos, ordered by creation date (newest first)
        $todos = Todo::query()
            ->orderBy('created_at', 'DESC')
            ->get();

        // Render the view with todos data
        $this->render('todos/index', [
            'todos' => $todos,
            'title' => 'Todo List'
        ]);
    }

    /**
     * Show the form to create a new todo
     */
    public function create()
    {
        $this->render('todos/create', [
            'title' => 'Create New Todo'
        ]);
    }

    /**
     * Store a new todo
     */
    public function store()
    {
        // Verify CSRF token
        Form::verifyCsrfToken();

        // Validate form input
        $validator = new Validation();
        $valid = $validator->validate([
            'title' => v::notEmpty()->length(3, 255)
        ]);

        if (!$valid) {
            // If validation fails, redirect back with errors
            Session::flash('errors', $validator->errors());
            Session::flash('old_input', Request::all());
            redirect('/todos/create');
            return;
        }

        // Create new todo
        $todo = new Todo();
        $todo->create([
            'title' => Request::sanitize('title'),
            'completed' => false,
            'user_id' => Session::get('user_id') ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // Redirect with success message
        Session::flash('success', 'Todo added successfully!');
        redirect('/todos');
    }

    /**
     * Toggle todo completion status
     */
    public function toggle($id)
    {
        // Find the todo by ID
        $todo = Todo::find($id);

        // Check if todo exists
        if (!$todo) {
            Session::flash('error', 'Todo not found!');
            redirect('/todos');
            return;
        }

        // Toggle the completed status and update
        $todo->update([
            'completed' => !$todo->completed,
            'updated_at' => date('Y-m-d H:i:s')
        ], $id);

        // Redirect back to the list
        redirect('/todos');
    }

    /**
     * Delete a todo
     */
    public function delete($id)
    {
        // Find the todo by ID
        $todo = Todo::find($id);

        // Check if todo exists
        if (!$todo) {
            Session::flash('error', 'Todo not found!');
            redirect('/todos');
            return;
        }

        // Delete the todo
        $todo->delete($id);

        // Redirect with success message
        Session::flash('success', 'Todo deleted successfully!');
        redirect('/todos');
    }
}
```

This controller provides all the functionality we need for our Todo application.

### Step 5: Define Routes

Now let's set up the routes in `app/routes.php`:

```php
<?php

use Core\Http\Router;

$router = new Router();

// Home route
$router->get('', ['HomeController', 'index']);

// Todo routes
$router->get('todos', ['TodoController', 'index']);
$router->get('todos/create', ['TodoController', 'create']);
$router->post('todos', ['TodoController', 'store']);
$router->get('todos/{id}/toggle', ['TodoController', 'toggle']);
$router->get('todos/{id}/delete', ['TodoController', 'delete']);

// Start the router
$router->dispatch();
```

These routes define the URLs that users can access to interact with our Todo application.

### Step 6: Create the Views

Let's create the necessary Twig templates for our Todo application.

First, create a layout file at `resources/views/layouts/app.html.twig`:

```twig
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title ?? 'Todo App' }} - PHPure</title>
    {{ vite_assets() }}
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">PHPure Todo App</a>
            <ul class="flex space-x-4">
                <li><a href="{{ url('/') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ url('/todos') }}" class="hover:underline">Todos</a></li>
            </ul>
        </div>
    </nav>

    <main class="container mx-auto p-4 mt-6">
        {% block content %}{% endblock %}
    </main>

    <footer class="bg-gray-200 p-4 mt-10">
        <div class="container mx-auto text-center text-gray-600">
            &copy; {{ "now"|date("Y") }} PHPure Todo App
        </div>
    </footer>
</body>
</html>
```

Next, create the todos index page at `resources/views/todos/index.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">My Todo List</h1>
            <a href="{{ url('/todos/create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Add New Todo
            </a>
        </div>

        {% if flash('success') %}
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 my-4 rounded" role="alert">
                {{ flash('success') }}
            </div>
        {% endif %}

        {% if flash('error') %}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-4 rounded" role="alert">
                {{ flash('error') }}
            </div>
        {% endif %}
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        {% if todos|length > 0 %}
            <ul class="divide-y divide-gray-200">
                {% for todo in todos %}
                    <li class="p-4 flex justify-between items-center {% if todo.completed %}bg-gray-50{% endif %}">
                        <div class="flex items-center">
                            <span class="{% if todo.completed %}line-through text-gray-500{% endif %}">
                                {{ todo.title }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ url('/todos/' ~ todo.id ~ '/toggle') }}"
                               class="{% if todo.completed %}bg-yellow-500 hover:bg-yellow-600{% else %}bg-green-500 hover:bg-green-600{% endif %} text-white px-3 py-1 rounded text-sm">
                                {% if todo.completed %}
                                    Mark Incomplete
                                {% else %}
                                    Mark Complete
                                {% endif %}
                            </a>
                            <a href="{{ url('/todos/' ~ todo.id ~ '/delete') }}"
                               class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                               onclick="return confirm('Are you sure you want to delete this todo?')">
                                Delete
                            </a>
                        </div>
                    </li>
                {% endfor %}
            </ul>
        {% else %}
            <div class="p-6 text-center text-gray-500">
                <p>No todos found. Create your first todo!</p>
            </div>
        {% endif %}
    </div>
{% endblock %}
```

Finally, create the form to add a new todo at `resources/views/todos/create.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-6">Create New Todo</h1>

        {% if flash('errors') %}
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded" role="alert">
                <ul class="list-disc pl-5">
                    {% for field, errors in flash('errors') %}
                        {% for error in errors %}
                            <li>{{ error }}</li>
                        {% endfor %}
                    {% endfor %}
                </ul>
            </div>
        {% endif %}

        <form action="{{ url('/todos') }}" method="post">
            {{ csrf_field() }}

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Todo Title</label>
                <input type="text"
                       name="title"
                       id="title"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ flash('old_input')['title'] ?? '' }}"
                       required>
                <p class="text-gray-600 text-sm mt-1">Enter a descriptive title for your todo item</p>
            </div>

            <div class="flex justify-between">
                <a href="{{ url('/todos') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Save Todo
                </button>
            </div>
        </form>
    </div>
{% endblock %}
```

### Step 7: Adding Styles with Tailwind CSS

PHPure comes with Tailwind CSS integration. Let's set up some basic styles for our Todo app. Create or edit the file `resources/css/app.css`:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom styles can be added here */
```

### Step 8: Start the Application

Now let's run our application:

```bash
# Start the development server with hot reloading
npm run dev:all
```

Visit `http://localhost:8000` in your browser to see your Todo application in action.

## How It All Works Together

Let's take a moment to understand how the different parts of our application work together:

1. **Request Lifecycle**: When a user visits a URL, the request flows through PHPure's routing system, which maps it to the appropriate controller action.

2. **Controllers**: Our `TodoController` handles the business logic, such as retrieving todos from the database, validating form input, and rendering views.

3. **Models**: The `Todo` model provides an object-oriented interface to the database, allowing us to easily create, read, update, and delete records.

4. **Views**: The Twig templates define the HTML structure of our application and display dynamic data passed from the controllers.

5. **CSS Styling**: Tailwind CSS provides utility classes for styling our application without writing custom CSS.

6. **Form Handling**: We use PHPure's form handling and validation features to process user input securely.

7. **Flash Messages**: Session flash messages allow us to display feedback to users after form submissions or other actions.

## Extending the Application

From here, you could extend the application in various ways:

- Add user authentication to allow each user to manage their own todos
- Implement todo categories or tags
- Add due dates and priority levels
- Create a search or filter function
- Add sorting options

PHPure's flexible architecture makes it easy to add these features as your application grows.

## Conclusion

Through this simple Todo application, you've seen how PHPure provides a clean, organized structure for building web applications. The framework's components work together seamlessly, allowing you to focus on building features rather than worrying about infrastructure.

As you continue to work with PHPure, you'll discover that its straightforward design makes it easy to understand what's happening at each step, making it an excellent learning tool for PHP development.
