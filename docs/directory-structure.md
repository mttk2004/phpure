# Directory Structure

The directory structure of **PHPure** is designed to ensure **consistency, comprehensibility, and optimal extensibility**. The MVC (Model-View-Controller) pattern is applied as a foundation, helping to clearly separate the components that handle logic, interface, and data. This not only helps manage the project effectively but also creates a premise for expansion when the application grows.

## Overview

Here's an overview of the PHPure directory structure:

```plaintext
phpure/
├── app/                        # Application-specific code
│   ├── Controllers/            # Contains classes that handle application logic
│   ├── Listeners/              # Contains classes that listen for and handle events
│   ├── Middlewares/            # Contains middleware classes to process HTTP requests
│   ├── Models/                 # Contains model classes to interact with the database
│   ├── events.php              # File to register and manage application events
│   ├── routes.php              # File defining application routes
├── config/                     # Configuration files
│   ├── app.php                 # Main application configuration
│   ├── cache.php               # Cache configuration
│   ├── database.php            # Database connection configuration
│   ├── paths.php               # Application paths configuration
│   ├── phinx.php               # Phinx migration tool configuration
│   ├── storage.php             # File storage configuration
├── core/                       # Framework core components
│   ├── Http/
│   │   ├── Middleware.php      # Middleware management class
│   │   ├── Request.php         # Class for processing HTTP requests
│   │   ├── Response.php        # Class for creating and sending HTTP responses
│   │   ├── ResponseCode.php    # HTTP status codes definitions
│   │   ├── Router.php          # Routing class for mapping URLs to controllers
│   ├── App.php                 # Core framework class that bootstraps the application
│   ├── Cache.php               # Cache management class
│   ├── Controller.php          # Base controller class
│   ├── Database.php            # Database query builder and connection manager
│   ├── Event.php               # Event management system
│   ├── ExceptionHandler.php    # Exception and error handler
│   ├── Form.php                # Form handling utilities
│   ├── Logger.php              # Logging functionality
│   ├── Model.php               # Base model class with ORM functionality
│   ├── Pagination.php          # Pagination helper for data lists
│   ├── Session.php             # Session management
│   ├── Storage.php             # File storage management
│   ├── Twig.php                # Twig template engine integration
│   ├── Validation.php          # Data validation utilities
├── database/                   # Database migrations and seeds
│   ├── migrations/             # Database structure change files
│   ├── seeds/                  # Sample data generation files
├── docs/                       # Documentation files
│   ├── index.md                # Documentation home page
│   ├── introduction.md         # Framework introduction
│   ├── getting-started.md      # Getting started guide
│   ├── directory-structure.md  # This file - directory structure overview
│   ├── core-concepts.md        # Core concepts explanation
│   ├── features.md             # Features documentation
│   ├── building-applications.md # Guide for building applications
│   ├── advanced-techniques.md  # Advanced usage techniques
├── public/                     # Publicly accessible files
│   ├── assets/                 # Compiled assets (CSS, JS, images)
│   ├── index.php               # Entry point file that bootstraps the application
│   ├── .htaccess               # Apache server configuration for URL rewriting
├── resources/                  # Raw resource files
│   ├── css/                    # CSS source files
│   ├── js/                     # JavaScript source files
│   ├── views/                  # Twig template files
├── storage/                    # Application storage
│   ├── cache/                  # Cache storage
│   ├── logs/                   # Log files
│   ├── uploads/                # User uploaded files
├── utils/                      # Utility functions and helpers
│   ├── helpers.php             # Global helper functions
├── vendor/                     # Composer dependencies
├── .env                        # Environment-specific configuration
├── .env.example                # Example environment configuration
├── .gitignore                  # Git ignore rules
├── composer.json               # Composer dependencies and project metadata
├── LICENSE                     # License file
├── package.json                # npm dependencies and scripts
├── phinx.php                   # Phinx configuration file in root (redirect to config/phinx.php)
├── postcss.config.js           # PostCSS configuration
├── README.md                   # Project readme
├── tailwind.config.js          # Tailwind CSS configuration
├── vite.config.js              # Vite bundler configuration
```

## Key Directories and Files

### App Directory

The `app/` directory contains the main application code that you will work with most often:

- **Controllers/**: Contains the controllers that handle HTTP requests, process input, and return responses. Each controller typically corresponds to a specific resource or section of your application.
- **Listeners/**: Contains event listeners that respond to events triggered throughout the application.
- **Middlewares/**: Contains middleware classes that process HTTP requests before they reach controllers. Middlewares are useful for tasks like authentication, input sanitization, and CSRF protection.
- **Models/**: Contains model classes that interact with the database and represent application data.
- **events.php**: Registers event listeners with the event system.
- **routes.php**: Defines the routes for your application, mapping URLs to controller actions.

### Config Directory

The `config/` directory contains all configuration files for the application:

- **app.php**: Main application configuration including environment settings, error handling, and other global options.
- **cache.php**: Cache configuration including drivers and storage paths.
- **database.php**: Database connection settings.
- **paths.php**: Defines important filesystem paths used throughout the application.
- **phinx.php**: Configuration for the Phinx database migration tool.
- **storage.php**: File storage configuration settings.

### Core Directory

The `core/` directory contains the framework's core components that power your application:

- **Http/**: Contains HTTP-related classes for handling requests and responses.
- **App.php**: The main bootstrap class that initializes and runs the application.
- **Cache.php**: Provides caching functionality to improve application performance.
- **Controller.php**: Base controller class with common controller functionality.
- **Database.php**: Database query builder and connection manager.
- **Model.php**: Base model class with ORM (Object-Relational Mapping) capabilities.
- **Twig.php**: Integration with the Twig template engine for rendering views.
- **Validation.php**: Data validation utilities to ensure input data is valid.

### Public Directory

The `public/` directory is the document root for your application. It contains the files that are directly accessible from the web:

- **assets/**: Contains compiled assets such as CSS, JavaScript, and images.
- **index.php**: The entry point for all HTTP requests to your application.
- **.htaccess**: Apache server configuration for URL rewriting.

### Resources Directory

The `resources/` directory contains raw, uncompiled assets:

- **css/**: CSS source files, possibly using Tailwind or other CSS frameworks.
- **js/**: JavaScript source files.
- **views/**: Twig templates for rendering HTML responses.

### Storage Directory

The `storage/` directory contains files generated by the application:

- **cache/**: File-based cache storage.
- **logs/**: Application log files.
- **uploads/**: User-uploaded files.

### Other Important Files

- **.env**: Contains environment-specific configuration variables.
- **composer.json**: Defines PHP dependencies and autoloading settings.
- **package.json**: Defines JavaScript dependencies and build scripts.
- **tailwind.config.js**: Configuration for Tailwind CSS.
- **vite.config.js**: Configuration for the Vite front-end build tool.
