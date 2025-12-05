# Ultimate Starter Kit

A comprehensive Laravel package that provides rapid setup for Authentication, Dynamic Authorization (ACL), and a full-featured Admin Dashboard.

**Created by [Ahmed Hany](https://github.com/EngOREOO/)**

## Installation

### Step 1: Add Repository Configuration

**IMPORTANT:** This package is not yet published to Packagist. You must add the repository configuration to your `composer.json` file **BEFORE** running `composer require`.

Open your `composer.json` file and add the `repositories` section. Here's a complete example:

```json
{
    "name": "laravel/laravel",
    "type": "project",
    "require": {
        "php": "^8.2",
        "laravel/framework": "^12.0"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/EngOREOO/atomic-starter-kit.git"
        }
    ],
    "config": {
        "preferred-install": "dist",
        "sort-packages": true
    }
}
```

**Note:** Add the `repositories` section at the same level as `require`, `require-dev`, etc.

### Step 2: Install the Package

After adding the repository configuration, run:

```bash
composer require engoreoo/ultimate-starter-kit
php artisan ultimate:install
npm install && npm run build
```

**Important Notes:**
- The package name is **case-sensitive**. Use `engoreoo/ultimate-starter-kit` (all lowercase).
- You must add the repository configuration **before** running `composer require`.
- If you get a "Could not find a matching version" error, make sure you've added the repository configuration correctly.

### Troubleshooting

**Error: "Could not find a matching version"**

1. Make sure you've added the `repositories` section to your `composer.json` **before** running `composer require`.
2. Clear Composer cache: `composer clear-cache`
3. Make sure you're using the correct repository URL: `https://github.com/EngOREOO/atomic-starter-kit.git`
   (Note: The GitHub repository is named `atomic-starter-kit`, but the package name is `ultimate-starter-kit`)
4. Make sure you're using the correct package name: `engoreoo/ultimate-starter-kit` (all lowercase).

**GitHub API Rate Limit**

If you see a "GitHub API limit (60 calls/hr) is exhausted" error:

**Option 1: Create a GitHub Token (Recommended)**

1. Go to https://github.com/settings/tokens/new
2. Give it a name like "Composer"
3. **Don't select any scopes** (for public repos, no permissions needed)
4. Click "Generate token"
5. Copy the token
6. Run this command and paste your token when prompted:
   ```bash
   composer config --global github-oauth.github.com YOUR_TOKEN_HERE
   ```
   Or manually add it to `C:/Users/YourUsername/AppData/Roaming/Composer/auth.json`:
   ```json
   {
       "github-oauth": {
           "github.com": "YOUR_TOKEN_HERE"
       }
   }
   ```

**Option 2: Wait**

Simply wait for the rate limit to reset (usually 1 hour). The error message will show when it resets.

**Note:** Publishing to Packagist will eliminate this issue entirely.

## Features

- 🚀 One-Command Installation
- 🔐 Laravel Breeze Integration
- 👥 Dynamic Role & Permission System
- 🎨 Modern Admin Dashboard
- 🔑 Super Admin System
- 📊 User Management
- 🛡️ Permission Middleware
- ⚙️ Settings Management

## Documentation

See [INSTALLATION.md](INSTALLATION.md) for detailed installation instructions.

## Author

**Ahmed Hany** - Backend Web Developer

- 🌐 **GitHub**: [@EngOREOO](https://github.com/EngOREOO/)
- 💼 **LinkedIn**: [Ahmed Hany](https://www.linkedin.com/in/codebyoreoo/)
- 📧 **Email**: engoreoo@gmail.com

## License

MIT
