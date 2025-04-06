# Building Applications with PHPure

In this section, we'll build a simple Todo List application to better understand how to use PHPure in practice.

## Todo List Application

### Step 1: Set Up the Database

First, create a migration to create the `todos` table:

```bash
vendor/bin/phinx create CreateTodosTable
```

Then, define the table in the migration file:

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

Execute the migration:

```bash
vendor/bin/phinx migrate
```

### Step 2: Create the Model

Create the file `app/Models/Todo.php`:

```php
<?php

namespace App\Models;

use Core\Model;

class Todo extends Model
{
    protected string $table = 'todos';
}
```

### Step 3: Create the Controller

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
    public function index()
    {
        $todos = Todo::all();

        $this->render('todos/index', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        $this->render('todos/create');
    }

    public function store()
    {
        $validation = new Validation();
        $validation->validate([
            'title' => v::notEmpty()->length(3, 255)
        ]);

        if ($validation->failed()) {
            Session::flash('errors', $validation->errors());
            redirect('/todos/create');
            return;
        }

        $todo = new Todo();
        $todo->create([
            'title' => Request::sanitize('title'),
            'completed' => false,
            'user_id' => Session::get('user_id') ?? null,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('success', 'Todo added successfully!');
        redirect('/todos');
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            abort(404);
        }

        $todo->update([
            'completed' => !$todo->completed,
            'updated_at' => date('Y-m-d H:i:s')
        ], $id);

        redirect('/todos');
    }

    public function delete($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            abort(404);
        }

        $todo->delete($id);

        Session::flash('success', 'Todo deleted successfully!');
        redirect('/todos');
    }
}
```

### Step 4: Define Routes

In the file `app/routes.php`:

```php
<?php

use Core\Http\Router;

$router = new Router();

// Homepage
$router->get('', ['HomeController', 'index']);

// Routes for Todo
$router->get('todos', ['TodoController', 'index']);
$router->get('todos/create', ['TodoController', 'create']);
$router->post('todos', ['TodoController', 'store']);
$router->get('todos/{id}/toggle', ['TodoController', 'toggle']);
$router->get('todos/{id}/delete', ['TodoController', 'delete']);

$router->dispatch();
```

### Step 5: Create Views

Create the file `resources/views/todos/index.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="container mt-5">
        <h1 class="mb-4">Todo List</h1>

        {% if flash('success') %}
            <div class="alert alert-success">
                {{ flash('success') }}
            </div>
        {% endif %}

        <a href="{{ url('/todos/create') }}" class="btn btn-primary mb-3">Add New Todo</a>

        <div class="list-group">
            {% for todo in todos %}
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        {% if todo.completed %}
                            <s>{{ todo.title }}</s>
                        {% else %}
                            {{ todo.title }}
                        {% endif %}
                    </div>
                    <div>
                        <a href="{{ url('/todos/' ~ todo.id ~ '/toggle') }}" class="btn btn-sm btn-info">
                            {% if todo.completed %}
                                Mark as Incomplete
                            {% else %}
                                Mark as Complete
                            {% endif %}
                        </a>
                        <a href="{{ url('/todos/' ~ todo.id ~ '/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                    </div>
                </div>
            {% else %}
                <div class="alert alert-info">No todos found.</div>
            {% endfor %}
        </div>
    </div>
{% endblock %}
```

Create the file `resources/views/todos/create.html.twig`:

```twig
{% extends 'layouts/app.html.twig' %}

{% block content %}
    <div class="container mt-5">
        <h1 class="mb-4">Add New Todo</h1>

        {% if flash('errors') %}
            <div class="alert alert-danger">
                <ul>
                    {% for field, errors in flash('errors') %}
                        {% for error in errors %}
                            <li>{{ error }}</li>
                        {% endfor %}
                    {% endfor %}
                </ul>
            </div>
        {% endif %}

        <form action="{{ url('/todos') }}" method="post">
            <input type="hidden" name="csrf_token" value="{{ form_token() }}">

            <div class="form-group">
                <label for="title">Todo Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add</button>
            <a href="{{ url('/todos') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
{% endblock %}
```

Create the file `resources/views/layouts/app.html.twig`:

```twig
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Todo App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/todos') }}">Todos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {% block content %}{% endblock %}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

With this practical example, you've seen how PHPure works in a fully functional application. You can extend this application by adding login functionality, user management, or any other features you like!
