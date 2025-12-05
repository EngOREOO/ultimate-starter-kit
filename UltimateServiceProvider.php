<?php

namespace Vendor\UltimateStarterKit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Vendor\UltimateStarterKit\Commands\InstallCommand;
use Vendor\UltimateStarterKit\Commands\ScanRoutesCommand;
use Vendor\UltimateStarterKit\Middleware\CheckPermission;
use Vendor\UltimateStarterKit\Controllers\DashboardController;

class UltimateServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/ultimate.php',
            'ultimate'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/Config/ultimate.php' => config_path('ultimate.php'),
        ], 'ultimate-config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations'),
        ], 'ultimate-migrations');

        // Publish views
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/ultimate'),
        ], 'ultimate-views');

        // Load views
        $this->loadViewsFrom(__DIR__.'/Views', 'ultimate');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                ScanRoutesCommand::class,
            ]);
        }

        // Register middleware
        $this->app['router']->aliasMiddleware('ultimate.permission', CheckPermission::class);

        // Register admin routes
        $this->registerRoutes();
    }

    /**
     * Register the admin routes.
     */
    protected function registerRoutes(): void
    {
        Route::middleware(['web', 'auth', 'ultimate.permission'])
            ->prefix(config('ultimate.route_prefix', 'admin'))
            ->name('admin.')
            ->group(function () {
                require __DIR__.'/Routes/admin.php';
            });

        // Override Breeze's dashboard route to use our dashboard and layout
        Route::middleware(['web', 'auth', 'ultimate.permission'])
            ->get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
    }
}

