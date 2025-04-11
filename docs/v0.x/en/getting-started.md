# Getting Started with PHPure

This guide will help you set up and start using PHPure for your web application development.

## System Requirements

Before installing PHPure, make sure your environment meets the following requirements:

- **PHP**: Version 8.0 or higher
- **Composer**: Version 2.8.4 or higher
- **npm**: Version 11.0.0 or higher

Having these tools properly installed will ensure a smooth setup process and stable development experience.

## Installation

Open your terminal and run the following commands:

```bash
composer create-project mttk2004/phpure your-project-name
cd your-project-name
```

These commands download the PHPure framework and position you in your new project directory.

## Setting Up Your Project

### Installing Dependencies

Run these commands to install all required dependencies:

```bash
npm install
```

### Environment Configuration

PHPure uses a `.env` file to store configuration values that might change between environments or contain sensitive information.

Create your environment file by copying the example:

```bash
cp .env.example .env
```

Then open the `.env` file in your editor and update its values to match your needs.

Here's what each setting in the `.env` file means:

#### Application Settings

```env
# APP
APP_NAME=PHPure              # Your application's name
APP_ENV=development          # Environment: development, production, or testing
APP_TIMEZONE=Asia/Ho_Chi_Minh # Your application's timezone
APP_DEBUG=true               # Enable detailed error messages (set to false in production)
APP_URL=http://localhost:8000 # Your application's base URL
APP_HOST_PORT=localhost:8000  # Host and port for local development
```

#### Database Settings

```env
# DATABASE
DB_ADAPTER=mysql            # Database type (mysql, sqlite, etc.)
DB_HOST=127.0.0.1           # Database server address
DB_PORT=3306                # Database server port
DB_NAME=my_database         # Your database name
DB_USER=root                # Database username
DB_PASS=                    # Database password
DB_CHARSET=utf8mb4          # Character encoding for database connections
```

Remember that the `.env` file contains sensitive information and should never be committed to version control. PHPure automatically adds it to `.gitignore` for your security.

## Understanding Configuration Files

PHPure organizes its configuration in the `/config` directory. Each file handles a specific aspect of the framework:

### app.php

Contains core application settings:

- Application name
- Environment (development, production, testing)
- Debug mode
- Timezone settings
- Character encoding

These values are typically pulled from your `.env` file with sensible defaults.

### database.php

Manages database connections:

- Default connection type
- Connection parameters for different database systems
- Support for multiple connection configurations

This file reads from your `.env` settings but can be customized for complex setups.

### paths.php

Defines directory paths for:

- Application code
- Public assets
- Storage (cache, logs, uploads)
- Resources (views, CSS, JavaScript)
- Database files (migrations, seeds)

These paths help PHPure locate important files automatically.

### cache.php

Controls the caching system:

- Default cache duration
- Cache storage location
- Cache cleaning settings

Proper caching improves your application's performance.

### storage.php

Manages file storage:

- Upload directories
- File permissions
- Allowed file extensions
- Maximum file sizes

This helps secure file uploads in your application.

### phinx.php

Configures the Phinx database migration tool:

- Migration and seed file locations
- Environment-specific database connections

You generally won't need to edit this file directly as it reads from your database.php and .env settings.

## Database Setup with Phinx

PHPure uses Phinx for database migrations. After configuring your database connection in `.env`, you can use the following Composer script commands:

1. Create a migration:

   ```bash
   composer migrate:create MyFirstMigration
   ```

2. Run migrations:

   ```bash
   composer migrate
   ```

3. Check migration status:

   ```bash
   composer migrate:status
   ```

4. Rollback migrations:

   ```bash
   composer migrate:rollback
   ```

5. Create a seed file:

   ```bash
   composer seed:create MyFirstSeeder
   ```

6. Run seed files:
   ```bash
   composer seed
   ```

These convenient commands are shortcuts for the Phinx CLI tool, making database management easier.

## Starting the Application

Once configuration is complete, you can start the development environment:

```bash
# Start the Vite development server for frontend assets
npm run dev

# Start the PHP development server
npm run serve

# Or, start both servers concurrently
npm run dev:all
```

Then visit http://localhost:8000 in your browser to see your new PHPure application.

## Code Formatting

PHPure includes PHP-CS-Fixer for maintaining consistent code style. You can use these commands:

```bash
# Format all PHP files
composer format

# Check for code style issues without fixing them
composer format-check
```

## Next Steps

Now that you have PHPure up and running, you're ready to start building your web application! Check out the other documentation sections to learn about:

- Core concepts
- Building applications
- Directory structure
- Advanced techniques

Happy coding with PHPure! 🚀
