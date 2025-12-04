<?php

namespace Vendor\UltimateStarterKit\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

class BreezeInstallerService
{
    /**
     * Check if Breeze is already installed.
     */
    public function isInstalled(): bool
    {
        // Check for Breeze routes file
        if (File::exists(base_path('routes/auth.php'))) {
            return true;
        }

        // Check for Breeze views
        if (File::exists(resource_path('views/auth'))) {
            return true;
        }

        // Check for Breeze in composer.json
        $composerJson = json_decode(File::get(base_path('composer.json')), true);
        if (isset($composerJson['require']['laravel/breeze'])) {
            return true;
        }

        return false;
    }

    /**
     * Install Laravel Breeze with Blade stack.
     */
    public function install(): bool
    {
        if ($this->isInstalled()) {
            return false;
        }

        // Install Breeze package
        $installPackage = Process::run('composer require laravel/breeze --dev');
        
        if (!$installPackage->successful()) {
            throw new \Exception('Failed to install Laravel Breeze package: ' . $installPackage->errorOutput());
        }

        // Run Breeze installation
        $installBreeze = Process::run('php artisan breeze:install blade --dark');
        
        if (!$installBreeze->successful()) {
            throw new \Exception('Failed to run Breeze installation: ' . $installBreeze->errorOutput());
        }

        return true;
    }
}

