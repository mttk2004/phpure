# PHPure

PHPure is a lightweight MVC framework inspired by Laravel, designed to help beginners learn and explore how a web application works under the MVC pattern.

## Overview

PHPure provides a clean, simple, and elegant structure to build PHP applications. It includes essential features like routing, database ORM, template engine, middleware, validation, and more, while keeping the codebase easy to understand and maintain.

This framework is perfect for:

- Learning the MVC architecture
- Understanding how web frameworks work under the hood
- Building small to medium-sized applications
- Gaining a solid foundation before moving to larger frameworks like Laravel

## Documentation

Detailed documentation is available in the [docs](docs) directory:

- [Introduction](docs/introduction.md)
- [Getting Started](docs/getting-started.md)
- [Directory Structure](docs/directory-structure.md)
- [Core Concepts](docs/core-concepts.md)
- [Features](docs/features.md)
- [Building Applications](docs/building-applications.md)
- [Advanced Techniques](docs/advanced-techniques.md)

## Quick Start

```bash
# Create new phpure project
composer create-project mttk2004/phpure <project_name>
cd <project_name>

# Install dependencies
composer install
npm install

# Configure your environment
cp .env.example .env

# Run the development server
npm run dev:all
```

Open http://localhost:8000 to see the result!

## Notice

This project includes Twig, a template engine licensed under the BSD-3-Clause license, not MIT. All other components of PHPure are licensed under MIT.

## License

PHPure is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

Created by [Mai Trần Tuấn Kiệt](https://github.com/mttk2004).

---

_Last updated: April 05, 2025_
