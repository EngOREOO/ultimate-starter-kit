# Installation Guide - Ultimate Starter Kit

This guide will help you install the Ultimate Starter Kit package in a new Laravel project.

## Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 12.x
- Node.js and npm (for frontend assets)

## Installation Methods

### Method 1: Local Development (Path Repository)

If you're developing the package locally or want to test it before publishing:

1. **In your new Laravel project**, add the package as a path repository in `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "../StraterKit/src"
        }
    ],
    "require": {
        "vendor/ultimate-starter-kit": "*"
    }
}
```

2. **Install the package**:
```bash
composer require vendor/ultimate-starter-kit
```

3. **Run the installation command**:
```bash
php artisan ultimate:install
```

### Method 2: Git Repository (Development)

If the package is in a Git repository:

1. **Add the repository** to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/your-username/ultimate-starter-kit.git"
        }
    ],
    "require": {
        "vendor/ultimate-starter-kit": "dev-main"
    }
}
```

2. **Install the package**:
```bash
composer require vendor/ultimate-starter-kit:dev-main
```

3. **Run the installation command**:
```bash
php artisan ultimate:install
```

### Method 3: Packagist (Production)

Once published to Packagist:

1. **Install via Composer**:
```bash
composer require vendor/ultimate-starter-kit
```

2. **Run the installation command**:
```bash
php artisan ultimate:install
```

## Installation Steps

When you run `php artisan ultimate:install`, the package will:

1. **Check for Laravel Breeze** - If not installed, it will automatically install Breeze (Blade/Tailwind stack)

2. **Interactive Setup** - You'll be prompted:
   - Enable Dynamic Role & Permission System? (yes/no)
   - Super Admin email
   - Super Admin password

3. **Automatic Setup**:
   - Run migrations
   - Create Super Admin role
   - Create Super Admin user
   - Scan routes and create permissions
   - Register middleware
   - Update Tailwind configuration

## Post-Installation

After installation, you should:

1. **Build frontend assets** (if not done automatically):
```bash
npm install
npm run build
# or for development
npm run dev
```

2. **Access the admin panel**:
   - Navigate to `/admin` in your browser
   - Login with the Super Admin credentials you provided

3. **Optional: Publish package assets** (if you want to customize):
```bash
# Publish config
php artisan vendor:publish --tag=ultimate-config

# Publish views
php artisan vendor:publish --tag=ultimate-views

# Publish migrations (already loaded, but you can republish to customize)
php artisan vendor:publish --tag=ultimate-migrations
```

## Configuration

The package configuration is located at `config/ultimate.php`. You can customize:

- `super_admin_role`: Name of the super admin role (default: "Super Admin")
- `route_prefix`: Admin route prefix (default: "admin")
- `middleware_group`: Middleware group (default: "web")
- `scan_on_install`: Automatically scan routes on install (default: true)
- `modules`: Custom module labels for route parsing

## Available Commands

- `php artisan ultimate:install` - Install and set up the package
- `php artisan ultimate:scan-routes` - Manually scan routes and sync permissions

## Troubleshooting

### Service Provider Not Found

If you get an error about the service provider not being found:

1. Make sure the package is properly installed via Composer
2. Run `composer dump-autoload`
3. Check that `bootstrap/providers.php` includes the service provider (should be auto-discovered)

### Routes Not Working

1. Make sure you've run `php artisan ultimate:install`
2. Check that migrations have been run: `php artisan migrate`
3. Verify middleware is registered in `bootstrap/app.php`

### Views Not Found

1. Make sure views are published or the package views are accessible
2. Check that `resources/views/vendor/ultimate` exists (if views were published)
3. Verify the service provider is loading views correctly

### Tailwind Styles Not Applied

1. Make sure you've run `npm run build` or `npm run dev`
2. Check that `tailwind.config.js` includes the package view paths
3. Verify `resources/css/app.css` imports Tailwind

## Package Structure

```
src/
├── Commands/          # Artisan commands
├── Config/            # Configuration files
├── Controllers/       # Admin controllers
├── Database/          # Migrations and seeders
├── Middleware/        # Permission middleware
├── Models/            # Eloquent models
├── Routes/            # Route definitions
├── Services/          # Service classes
├── Traits/            # HasRoles trait
├── Views/             # Blade templates
└── UltimateServiceProvider.php
```

## Support

For issues or questions, please check:
- Package documentation
- Laravel documentation
- Create an issue on the repository

