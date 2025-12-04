<?php

namespace Vendor\UltimateStarterKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Vendor\UltimateStarterKit\Services\BreezeInstallerService;
use Vendor\UltimateStarterKit\Services\RouteScannerService;
use Vendor\UltimateStarterKit\Models\Role;
use Vendor\UltimateStarterKit\Models\Permission;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ultimate:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Ultimate Starter Kit with Breeze and ACL system';

    /**
     * Execute the console command.
     */
    public function handle(
        BreezeInstallerService $breezeInstaller,
        RouteScannerService $routeScanner
    ): int {
        $this->info('🚀 Installing Ultimate Starter Kit...');
        $this->newLine();

        // Step A: Install Breeze
        $this->info('Step A: Checking Laravel Breeze installation...');
        if (!$breezeInstaller->isInstalled()) {
            if ($this->confirm('Laravel Breeze is not installed. Would you like to install it now?', true)) {
                $this->info('Installing Laravel Breeze...');
                try {
                    $breezeInstaller->install();
                    $this->info('✅ Laravel Breeze installed successfully!');
                } catch (\Exception $e) {
                    $this->error('❌ Failed to install Breeze: ' . $e->getMessage());
                    return Command::FAILURE;
                }
            } else {
                $this->warn('⚠️  Skipping Breeze installation. Please install it manually.');
            }
        } else {
            $this->info('✅ Laravel Breeze is already installed.');
        }
        $this->newLine();

        // Step B: Interactive ACL Setup
        if (!$this->confirm('Do you want to enable the Dynamic Role & Permission System?', true)) {
            $this->info('Skipping ACL system installation.');
            return Command::SUCCESS;
        }

        $this->info('Installing ACL system...');
        $this->newLine();

        // Publish migrations
        $this->info('Publishing migrations...');
        Artisan::call('vendor:publish', ['--tag' => 'ultimate-migrations', '--force' => true]);
        $this->info('✅ Migrations published.');

        // Run migrations
        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);
        $this->info('✅ Migrations completed.');
        $this->newLine();

        // Patch User model with HasRoles trait FIRST
        $this->patchUserModel();

        // Create Super Admin role
        $this->info('Creating Super Admin role...');
        $superAdminRole = Role::firstOrCreate(
            ['slug' => 'super-admin'],
            [
                'name' => config('ultimate.super_admin_role', 'Super Admin'),
                'description' => 'Has access to everything',
                'is_super_admin' => true,
            ]
        );
        $this->info('✅ Super Admin role created.');
        $this->newLine();

        // Prompt for Super Admin credentials
        $this->info('Create Super Admin User:');
        $email = $this->ask('Email');
        $password = $this->secret('Password');
        $name = $this->ask('Name', 'Super Admin');

        $userModel = config('auth.providers.users.model', \App\Models\User::class);
        $user = $userModel::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        // Assign Super Admin role - use direct DB insert since trait might not be loaded yet
        DB::table('user_role')->insert([
            'user_id' => $user->id,
            'role_id' => $superAdminRole->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->info('✅ Super Admin user created.');
        $this->newLine();

        // Update Tailwind config
        $this->updateTailwindConfig();

        // Scan routes
        if (config('ultimate.scan_on_install', true)) {
            $this->info('Scanning routes...');
            $result = $routeScanner->scanAndSync();
            $this->info("✅ Scanned {$result['total']} routes and created {$result['created']} permissions.");
            $this->newLine();
        }

        // Register middleware (for Laravel 12)
        $this->registerMiddleware();

        $this->newLine();
        $this->info('🎉 Ultimate Starter Kit installed successfully!');
        $this->info('You can now access the admin dashboard at: /admin');
        $this->info('Super Admin credentials:');
        $this->line("  Email: {$email}");
        $this->line("  Password: [hidden]");

        return Command::SUCCESS;
    }

    /**
     * Patch the User model to include HasRoles trait.
     */
    protected function patchUserModel(): void
    {
        $userModelPath = app_path('Models/User.php');
        
        if (!File::exists($userModelPath)) {
            $this->warn('⚠️  User model not found. Please manually add the HasRoles trait.');
            return;
        }

        $userModelContent = File::get($userModelPath);

        // Check if trait is already added
        if (Str::contains($userModelContent, 'HasRoles')) {
            $this->info('✅ User model already has HasRoles trait.');
            return;
        }

        // Add use statement
        $traitUse = "use Vendor\\UltimateStarterKit\\Traits\\HasRoles;";
        if (!Str::contains($userModelContent, $traitUse)) {
            // Find the namespace declaration and add after it
            $userModelContent = preg_replace(
                '/(namespace\s+[^;]+;)/',
                "$1\n\n{$traitUse}",
                $userModelContent
            );
        }

        // Add trait to class - insert after opening brace, before any existing use statements
        $traitUsage = "use HasRoles;";
        if (!Str::contains($userModelContent, $traitUsage)) {
            // Find the class opening brace
            if (preg_match('/(class\s+User\s+extends[^{]*\{)/', $userModelContent, $matches, PREG_OFFSET_CAPTURE)) {
                $classStart = $matches[0][0];
                $pos = $matches[0][1] + strlen($classStart);
                
                // Skip any whitespace/newlines after the brace
                $afterBrace = substr($userModelContent, $pos);
                $whitespace = '';
                if (preg_match('/^(\s*)/', $afterBrace, $wsMatches)) {
                    $whitespace = $wsMatches[1];
                }
                
                // Insert the trait with proper indentation
                $indent = $whitespace ?: "\n    ";
                $userModelContent = substr_replace($userModelContent, "{$indent}{$traitUsage}", $pos, 0);
            }
        }

        File::put($userModelPath, $userModelContent);
        $this->info('✅ User model patched with HasRoles trait.');
    }

    /**
     * Update Tailwind config to include package views.
     */
    protected function updateTailwindConfig(): void
    {
        $tailwindConfigPath = base_path('tailwind.config.js');

        if (!File::exists($tailwindConfigPath)) {
            $this->warn('⚠️  tailwind.config.js not found. Please manually add the package views path.');
            $this->line('Add this to your content array:');
            $this->line("  './vendor/vendor/ultimate-starter-kit/src/Views/**/*.blade.php',");
            return;
        }

        $configContent = File::get($tailwindConfigPath);
        // Get the actual vendor path - this will be set when package is installed
        $packagePath = "./vendor/*/*/src/Views/**/*.blade.php";
        // For development, also include local src path
        $localPath = "./src/Views/**/*.blade.php";

        // Check if already added
        if (Str::contains($configContent, 'src/Views') || Str::contains($configContent, 'vendor')) {
            $this->info('✅ Tailwind config already includes package views.');
            return;
        }

        // Try to add to content array
        // Match content array pattern
        if (preg_match('/content:\s*\[([^\]]*)\]/s', $configContent, $matches)) {
            $contentArray = $matches[1];
            $newContent = rtrim($contentArray);
            if (!empty($newContent) && !Str::endsWith($newContent, ',')) {
                $newContent .= ',';
            }
            $newContent .= "\n        '{$packagePath}',";
            $newContent .= "\n        '{$localPath}',";
            $configContent = str_replace($matches[0], "content: [{$newContent}\n    ]", $configContent);
            File::put($tailwindConfigPath, $configContent);
            $this->info('✅ Tailwind config updated with package views path.');
        } else {
            $this->warn('⚠️  Could not automatically update tailwind.config.js.');
            $this->line('Please manually add these to the content array:');
            $this->line("  '{$packagePath}',");
            $this->line("  '{$localPath}',");
        }
    }

    /**
     * Register middleware for Laravel 12.
     */
    protected function registerMiddleware(): void
    {
        $bootstrapPath = base_path('bootstrap/app.php');

        if (!File::exists($bootstrapPath)) {
            return;
        }

        $bootstrapContent = File::get($bootstrapPath);

        // Check if middleware is already registered
        if (Str::contains($bootstrapContent, 'ultimate.permission')) {
            $this->info('✅ Middleware already registered.');
            return;
        }

        // Add middleware alias in the withMiddleware callback
        $middlewareCode = "        \$middleware->alias(['ultimate.permission' => \\Vendor\\UltimateStarterKit\\Middleware\\CheckPermission::class]);";
        
        if (preg_match('/->withMiddleware\(function\s*\(Middleware\s+\$middleware\)[^}]*\{/', $bootstrapContent, $matches)) {
            $bootstrapContent = str_replace(
                $matches[0],
                $matches[0] . "\n" . $middlewareCode,
                $bootstrapContent
            );
            File::put($bootstrapPath, $bootstrapContent);
            $this->info('✅ Middleware registered in bootstrap/app.php.');
        } else {
            $this->warn('⚠️  Could not automatically register middleware.');
            $this->line('Please manually add this to bootstrap/app.php in the withMiddleware callback:');
            $this->line($middlewareCode);
        }
    }
}

