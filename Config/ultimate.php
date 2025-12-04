<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Super Admin Role Name
    |--------------------------------------------------------------------------
    |
    | The name of the role that will have access to everything.
    |
    */
    'super_admin_role' => 'Super Admin',

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | The prefix for all admin routes.
    |
    */
    'route_prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Middleware Group
    |--------------------------------------------------------------------------
    |
    | The middleware group to apply to admin routes.
    |
    */
    'middleware_group' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Scan Routes on Install
    |--------------------------------------------------------------------------
    |
    | Whether to automatically scan routes during installation.
    |
    */
    'scan_on_install' => true,

    /*
    |--------------------------------------------------------------------------
    | Module Labels
    |--------------------------------------------------------------------------
    |
    | Custom labels for modules. Keys should match the module names
    | extracted from route names.
    |
    */
    'modules' => [
        'hr' => 'HR',
        'admin' => 'Admin',
        'general' => 'General',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Module for Routes Without Dots
    |--------------------------------------------------------------------------
    |
    | When a route name doesn't contain dots, it will be assigned to this module.
    |
    */
    'default_module' => 'General',

    /*
    |--------------------------------------------------------------------------
    | Default Feature for Routes Without Dots
    |--------------------------------------------------------------------------
    |
    | When a route name doesn't contain dots, it will be assigned to this feature.
    |
    */
    'default_feature' => 'System',
];

