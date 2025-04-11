# Directory Structure

The directory structure of **PHPure** is designed with clarity and purpose in mind. It follows the MVC (Model-View-Controller) pattern to help separate concerns in your application, making it easier to understand, maintain, and expand as your project grows.

## Overview

Here's a comprehensive look at the PHPure directory structure:

```plaintext
phpure/
├── app/                        # Application-specific code
│   ├── Controllers/            # Controller classes that handle application logic
│   ├── Listeners/              # Event listener classes
│   ├── Middlewares/            # HTTP request middleware classes
│   ├── Models/                 # Model classes for database interaction (if present)
│   ├── events.php              # Event registration and configuration
│   ├── routes.php              # Application route definitions
├── config/                     # Configuration files
│   ├── app.php                 # Main application settings
│   ├── cache.php               # Cache configuration
│   ├── database.php            # Database connection settings
│   ├── paths.php               # Application path definitions
│   ├── phinx.php               # Database migration configuration
│   ├── storage.php             # File storage settings
├── core/                       # Framework core components
│   ├── Http/
│   │   ├── Middleware.php      # Middleware management
│   │   ├── Request.php         # HTTP request handling
│   │   ├── Response.php        # HTTP response creation
│   │   ├── ResponseCode.php    # HTTP status code definitions
│   │   ├── Router.php          # URL to controller mapping
│   ├── App.php                 # Application bootstrap
│   ├── Cache.php               # Cache management
│   ├── Controller.php          # Base controller class
│   ├── Database.php            # Database connection and query building
│   ├── Event.php               # Event management system
│   ├── ExceptionHandler.php    # Error and exception handling
│   ├── Form.php                # Form processing utilities
│   ├── Logger.php              # Application logging
│   ├── Model.php               # Base model with ORM features
│   ├── Pagination.php          # Data pagination helper
│   ├── Session.php             # Session management
│   ├── Storage.php             # File storage system
│   ├── Twig.php                # Template engine integration
│   ├── Validation.php          # Data validation utilities
├── database/                   # Database-related files
│   ├── migrations/             # Database structure migrations
│   ├── seeds/                  # Database seeding scripts
├── public/                     # Web-accessible files
│   ├── assets/                 # Compiled assets (CSS, JS, images)
│   ├── index.php               # Application entry point
│   ├── .htaccess               # URL rewriting rules
├── resources/                  # Raw resource files
│   ├── css/                    # CSS source files
│   ├── js/                     # JavaScript source files
│   ├── views/                  # Twig templates
├── storage/                    # Application storage
│   ├── cache/                  # Cache files
│   ├── logs/                   # Log files
│   ├── uploads/                # User uploads (if configured)
├── utils/                      # Utility functions
│   ├── helpers.php             # Global helper functions
├── .env                        # Environment variables
├── .env.example                # Example environment configuration
├── .gitignore                  # Git ignored files and directories
├── composer.json               # PHP dependencies and project metadata
├── package.json                # Frontend dependencies and scripts
├── phinx.php                   # Root Phinx configuration (redirects to config/phinx.php)
├── postcss.config.js           # PostCSS configuration
├── tailwind.config.js          # Tailwind CSS configuration
├── vite.config.js              # Vite build tool configuration
```

## Key Directories Explained

### The App Directory

The `app/` directory is where most of your custom application code will live. This is where you'll spend the majority of your development time:

- **Controllers/**: Contains classes that handle HTTP requests and control the flow of your application. Each controller typically groups related functionality, like a `UserController` for user-related actions.

- **Listeners/**: Contains event listener classes that respond to events triggered throughout your application, allowing you to execute code when specific actions occur.

- **Middlewares/**: Contains middleware classes that process HTTP requests before they reach controllers. Middlewares are perfect for tasks like authentication, input validation, or CORS handling.

- **Models/**: Contains model classes that interact with your database tables. Models represent your data structure and provide methods to manipulate that data.

- **events.php**: A configuration file where you register event listeners with the event system.

- **routes.php**: Defines all your application's URL routes, mapping them to specific controller actions.

### The Config Directory

The `config/` directory holds configuration files that define how your application behaves:

- **app.php**: Core application settings like application name, environment, debugging options, and more.

- **cache.php**: Configuration for the caching system, including which driver to use and cache lifetime settings.

- **database.php**: Database connection parameters including host, database name, username, password, and connection options.

- **paths.php**: Defines important file paths used throughout the application for consistency.

- **phinx.php**: Configuration for the Phinx database migration tool, defining how migrations are executed.

- **storage.php**: Settings for the file storage system, including paths and permissions.

### The Core Directory

The `core/` directory contains the PHPure framework itself. While you typically won't modify these files, understanding them helps you use the framework effectively:

- **Http/**: Contains classes for HTTP processing:

  - **Middleware.php**: Manages the middleware queue and execution.
  - **Request.php**: Handles incoming HTTP request data.
  - **Response.php**: Creates and sends HTTP responses.
  - **ResponseCode.php**: Defines standard HTTP status codes.
  - **Router.php**: Matches URLs to controller actions.

- **App.php**: The main class that bootstraps the application.

- **Cache.php**: Provides methods for storing and retrieving cached data.

- **Controller.php**: The base controller class that your controllers extend from.

- **Database.php**: Database connection and query builder functionality.

- **Event.php**: Event dispatching and handling system.

- **Model.php**: Base model class with ORM (Object-Relational Mapping) capabilities.

- **Session.php**: Manages user sessions securely.

- **Validation.php**: Provides methods to validate input data.

### The Public Directory

The `public/` directory is the only folder that should be web-accessible. It serves as the document root for your web server:

- **assets/**: Contains compiled and optimized assets ready for production use.

- **index.php**: The entry point for all HTTP requests to your application.

- **.htaccess**: Contains rules for Apache to enable clean URLs (URL rewriting).

### The Resources Directory

The `resources/` directory contains raw, uncompiled assets that will be processed:

- **css/**: CSS source files, possibly using Tailwind CSS.

- **js/**: JavaScript source files that will be processed by Vite.

- **views/**: Twig template files that define your application's HTML structure.

### The Storage Directory

The `storage/` directory holds files generated by your application:

- **cache/**: File-based cache storage.

- **logs/**: Application log files for debugging and monitoring.

- **uploads/**: A place to store user-uploaded files (if you configure this feature).

### Other Important Files

- **.env**: Contains environment-specific configuration variables like database credentials and API keys. This file should not be committed to version control.

- **composer.json**: Defines PHP dependencies, autoloading settings, and scripts.

- **package.json**: Defines JavaScript dependencies and build scripts for the frontend.

- **tailwind.config.js**: Configuration for Tailwind CSS, if you're using it for styling.

- **vite.config.js**: Configuration for Vite, which builds and optimizes your frontend assets.

## Best Practices

When working with the PHPure directory structure, keep these practices in mind:

1. **Keep Controllers Thin**: Controllers should coordinate between models and views, not contain complex business logic.

2. **Use Models for Business Logic**: Place data manipulation and business rules in your models.

3. **Don't Modify Core Files**: Instead of changing core files, extend the functionality through your own classes.

4. **Organize Routes Logically**: Group related routes together in your routes.php file.

5. **Use Environment Variables**: Place sensitive or environment-specific configuration in your .env file.

By understanding and following PHPure's directory structure, you'll be able to develop applications more efficiently and maintain them more easily over time.
