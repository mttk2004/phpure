# Getting Started with PHPure

This guide will help you set up and start using PHPure for your web application development.

## System Requirements

Before installing and using PHPure, make sure your working environment meets the following requirements:

- **PHP**: Minimum version 8.0.
- **Composer**: Minimum version 2.8.4.
- **npm**: Minimum version 11.0.0.

Ensuring that these tools are installed with the correct versions will help you avoid installation errors and ensure stable application operation.

## Installation

Start by opening your terminal or command prompt and running the following commands:

```bash
git clone https://github.com/mttk2004/phpure.git
cd phpure
```

- **`git clone`**: Downloads the entire PHPure source code from GitHub to your computer.
- **`cd phpure`**: Navigates to the directory containing the downloaded source code.

After completing this step, you're ready to proceed with project setup and dependency installation.

## Configuration

### Installing Dependencies

Use the following commands to install all the necessary dependencies:

```bash
composer install
npm install
```

- **`composer install`**: Downloads all required PHP libraries for the project to work.
- **`npm install`**: Installs front-end packages that support the interface or build tools.

These commands will ensure that you have all the tools needed to develop and operate the application.

### Configuring the `.env` File

The project uses the `.env` file to store important configuration information such as database information, application environment, and other parameters. To create the `.env` file, run the following command:

```bash
cp .env.example .env
```

Next, open the newly created `.env` file and update the parameters to suit your environment. Here's an example of database configuration:

```env
# APP
APP_ENV=development

# DATABASE
DB_ADAPTER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=my_database
DB_USER=root
DB_PASS=
DB_CHARSET=utf8mb4
```

Some important notes:

- The `.env` file contains sensitive information, such as database passwords, so you need to secure it and avoid sharing it publicly.
- PHPure automatically adds `.env` to `.gitignore`, preventing you from uploading this file to GitHub.

### Phinx Configuration

PHPure uses **Phinx**, a powerful database management tool, to perform tasks such as creating tables, adding columns, or modifying database structure.

Phinx configuration is stored in the `phinx.php` file. However, you don't need to edit this file directly as all information is automatically configured through the `.env` file.

Phinx is an important part of PHPure's database management. It helps automate the process, reduce manual operations, and ensure consistency.

After completing these steps, you're ready to start your development journey with PHPure! 🚀
