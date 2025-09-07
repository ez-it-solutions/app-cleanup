# Laravel App Cleanup Command

![Ez IT Solutions](https://github.com/ez-it-solutions.png)

A powerful Laravel Artisan command for cleaning and optimizing your Laravel application with beautiful, informative console output.

## 📋 Overview

The `app:cleanup` command provides a comprehensive solution for clearing various Laravel caches and optimizing your application. It runs multiple optimization commands in sequence with visual feedback, progress tracking, and detailed execution statistics.

![Command Output Example](https://via.placeholder.com/800x400?text=Command+Output+Screenshot)

## ✨ Features

- **Beautiful Console Output**: Colorful, well-formatted console output with progress bars
- **Multiple Cache Clearing Operations**: Clears route, config, application, view, and event caches
- **Performance Optimization**: Rebuilds caches and optimizes the application
- **Execution Tracking**: Shows execution time for each command and total execution time
## 🚀 Installation

### Option 1: Install via Composer (Recommended)

```bash
composer require ez-it-solutions/app-cleanup
```

That's it! The package will automatically register the command with Laravel.

### Option 2: Manual Installation

1. Download the `AppCleanup.php` file from our [GitHub repository](https://github.com/ez-it-solutions/app-cleanup)
2. Place it in your Laravel project at `app/Console/Commands/AppCleanup.php`
3. Laravel's auto-discovery should automatically register the command

## 📦 Creating Your Own Package

If you want to create your own version of this package, follow these steps:

### 1. Set Up Package Structure

Create the following directory structure:

```
app-cleanup/
├── src/
│   └── Commands/
│       └── AppCleanup.php
├── composer.json
├── LICENSE
└── README.md
```

### 2. Create composer.json

```json
{
    "name": "ez-it-solutions/app-cleanup",
    "description": "A beautiful Laravel command for cleaning and optimizing your application",
    "type": "library",
    "license": "MIT",
    "authors": [
        {
            "name": "Ez IT Solutions",
            "email": "info@ez-it-solutions.com"
        }
    ],
    "require": {
        "php": "^7.3|^8.0",
        "illuminate/console": "^8.0|^9.0|^10.0",
        "illuminate/support": "^8.0|^9.0|^10.0"
    },
    "autoload": {
        "psr-4": {
            "Ez_IT_Solutions\\AppCleanup\\": "src/"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Ez_IT_Solutions\\AppCleanup\\AppCleanupServiceProvider"
            ]
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

### 3. Create Service Provider

Create a file at `src/AppCleanupServiceProvider.php`:

```php
<?php

namespace Ez_IT_Solutions\AppCleanup;

use Illuminate\Support\ServiceProvider;
use Ez_IT_Solutions\AppCleanup\Commands\AppCleanup;

class AppCleanupServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AppCleanup::class,
            ]);
        }
    }

    public function register()
    {
        //
    }
}
```

### 4. Update Namespace in Command

Update the namespace in your `AppCleanup.php` file to match your package:

```php
namespace Ez_IT_Solutions\AppCleanup\Commands;
```

### 5. Publish to GitHub

```bash
# Initialize Git repository
git init

# Add all files
git add .

# Commit the files
git commit -m "Initial commit"

# Create a new repository on GitHub at https://github.com/ez-it-solutions/app-cleanup
# Then push to GitHub
git remote add origin https://github.com/ez-it-solutions/app-cleanup.git
git branch -M main
git push -u origin main

# Tag a release
git tag -a v1.0.0 -m "Initial release"
git push origin v1.0.0
```

### 6. Register with Packagist

1. Visit [Packagist](https://packagist.org/packages/submit)
2. Submit your GitHub repository URL: `https://github.com/ez-it-solutions/app-cleanup`
3. Once approved, your package will be available via Composer

### 7. Set Up GitHub Webhooks for Packagist

To automatically update your package on Packagist when you push to GitHub:

1. Go to your GitHub repository settings
2. Click on "Webhooks" > "Add webhook"
3. Set Payload URL to: `https://packagist.org/api/github?username=your-packagist-username`
4. Set Content type to: `application/json`
5. Select "Just the push event"
6. Click "Add webhook"

### 8. Add GitHub Actions for Testing (Optional)

Create a file at `.github/workflows/tests.yml`:

```yaml
name: Tests

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  tests:
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php: [7.4, 8.0, 8.1, 8.2]
        laravel: [8.*, 9.*, 10.*]
        exclude:
          - php: 7.4
            laravel: 10.*

    name: PHP ${{ matrix.php }} - Laravel ${{ matrix.laravel }}

    steps:
      - name: Checkout code
        uses: actions/checkout@v3

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ matrix.php }}
          extensions: dom, curl, libxml, mbstring, zip
          coverage: none

      - name: Install dependencies
        run: |
          composer require "laravel/framework:${{ matrix.laravel }}" --no-interaction --no-update
          composer update --prefer-dist --no-interaction --no-progress
```

## 📝 Usage

### Basic Usage

```bash
php artisan app:cleanup
```

This will prompt for confirmation before running the cleanup process.

### Skip Confirmation

```bash
php artisan app:cleanup --force
```

This will run the cleanup process without asking for confirmation.

## 🔧 Customization

### Adding or Removing Commands

You can easily customize which commands are run by modifying the `$commands` array in the `handle()` method:

```php
$commands = [
    'Clear Route Cache' => 'route:clear',
    'Clear Configuration Cache' => 'config:clear',
    // Add or remove commands here
];
```

### Customizing the Output

You can customize the header and footer boxes by modifying the strings in the `handle()` method:

```php
$this->info('╔═════════════════════════════════════════════════╗');
$this->info('║                                                 ║');
$this->info('║         YOUR CUSTOM HEADER HERE                 ║');
$this->info('║                                                 ║');
$this->info('╚═════════════════════════════════════════════════╝');
```

### Changing the Command Name

If you want to change the command name, modify the `$signature` property:

```php
protected $signature = 'your:command-name {--force : Force the operation without confirmation}';
```

## 📊 Output Example

```
╔═════════════════════════════════════════════════╗
║                                                 ║
║         APPLICATION CLEANUP                     ║
║                                                 ║
╚═════════════════════════════════════════════════╝

[1/10] Running: Clear Route Cache (route:clear)
 100% [============================] ✓ Done
Time: 0.61s

[2/10] Running: Clear Configuration Cache (config:clear)
 100% [============================] ✓ Done
Time: 0.62s

...

Command Execution Summary:
+------+----------------+-----------------------------+--------------+---------+
| Step | Command        | Description                 | Duration (s) | Status  |
+------+----------------+-----------------------------+--------------+---------+
| 1    | route:clear    | Clear Route Cache           | 0.61         | Success |
| 2    | config:clear   | Clear Configuration Cache   | 0.62         | Success |
| ...  | ...            | ...                         | ...          | ...     |
+------+----------------+-----------------------------+--------------+---------+

Total execution time: 10.53 seconds

╔═════════════════════════════════════════════════╗
║                                                 ║
║         CLEANUP COMPLETED SUCCESSFULLY          ║
║                                                 ║
║             YOUR COMPANY © 2025                 ║
║                                                 ║
╚═════════════════════════════════════════════════╝
```

## 🤝 Contributing

Contributions are welcome! Feel free to submit a pull request or open an issue.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Ez IT Solutions**  
[https://github.com/ez-it-solutions](https://github.com/ez-it-solutions)

---

Made with ❤️ by Ez IT Solutions
