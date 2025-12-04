<?php

namespace Vendor\UltimateStarterKit\Services;

use Illuminate\Support\Facades\Route;
use Vendor\UltimateStarterKit\Models\Permission;

class RouteScannerService
{
    /**
     * Scan all named routes and sync them to the permissions table.
     */
    public function scanAndSync(): array
    {
        $routes = Route::getRoutes();
        $scanned = [];
        $created = 0;
        $updated = 0;

        foreach ($routes as $route) {
            $routeName = $route->getName();

            // Only process named routes
            if (!$routeName) {
                continue;
            }

            $parsed = $this->parseRouteName($routeName);
            
            if ($parsed) {
                $permission = Permission::updateOrCreate(
                    ['name' => $routeName],
                    [
                        'module' => $parsed['module'],
                        'feature' => $parsed['feature'],
                        'action' => $parsed['action'],
                        'description' => $this->generateDescription($parsed),
                    ]
                );

                if ($permission->wasRecentlyCreated) {
                    $created++;
                } else {
                    $updated++;
                }

                $scanned[] = [
                    'name' => $routeName,
                    'module' => $parsed['module'],
                    'feature' => $parsed['feature'],
                    'action' => $parsed['action'],
                ];
            }
        }

        return [
            'scanned' => $scanned,
            'created' => $created,
            'updated' => $updated,
            'total' => count($scanned),
        ];
    }

    /**
     * Parse a route name into module, feature, and action.
     * 
     * Handles routes with dot notation (e.g., "hr.employees.index")
     * and routes without dots (e.g., "dashboard") using fallback logic.
     */
    protected function parseRouteName(string $routeName): ?array
    {
        $parts = explode('.', $routeName);

        // Fallback for routes without dots
        if (count($parts) === 1) {
            return [
                'module' => config('ultimate.default_module', 'General'),
                'feature' => config('ultimate.default_feature', 'System'),
                'action' => $parts[0], // Use the route name itself as the action
            ];
        }

        // Handle routes with dots
        if (count($parts) === 2) {
            // e.g., "admin.dashboard" -> Module: "admin", Feature: "System", Action: "dashboard"
            return [
                'module' => $this->formatModule($parts[0]),
                'feature' => config('ultimate.default_feature', 'System'),
                'action' => $parts[1],
            ];
        }

        // Standard case: module.feature.action (3+ parts)
        // e.g., "hr.employees.index" or "api.v1.products.store"
        if (count($parts) >= 3) {
            // Take first part as module
            $module = $this->formatModule($parts[0]);
            
            // Take second part as feature
            $feature = $this->formatFeature($parts[1]);
            
            // Take last part as action
            $action = end($parts);

            return [
                'module' => $module,
                'feature' => $feature,
                'action' => $action,
            ];
        }

        return null;
    }

    /**
     * Format module name (capitalize, handle special cases).
     */
    protected function formatModule(string $module): string
    {
        $module = strtolower($module);
        
        // Check if there's a custom label in config
        $modules = config('ultimate.modules', []);
        if (isset($modules[$module])) {
            return $module; // Return the key, not the label
        }

        return $module;
    }

    /**
     * Format feature name.
     */
    protected function formatFeature(string $feature): string
    {
        return strtolower($feature);
    }

    /**
     * Generate a human-readable description for a permission.
     */
    protected function generateDescription(array $parsed): string
    {
        $moduleLabel = config("ultimate.modules.{$parsed['module']}", ucfirst($parsed['module']));
        $featureLabel = ucfirst(str_replace('_', ' ', $parsed['feature']));
        $actionLabel = ucfirst($parsed['action']);

        return "{$actionLabel} {$featureLabel} in {$moduleLabel}";
    }
}

